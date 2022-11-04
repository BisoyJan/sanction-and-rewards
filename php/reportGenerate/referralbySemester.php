<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require '../../database/database.php';

$semester = $_GET['semester'];

$semester_id =  $_SESSION['semester_id'];

$query = "SELECT * FROM `semesters` WHERE id = '$semester_id'";
$query_run = mysqli_query($con, $query);

if (mysqli_num_rows($query_run) == 1) {

    while ($row = mysqli_fetch_array($query_run)) {

        $first_semester = array($row['first_starting'], $row['first_ending']);
        $second_semester = array($row['second_starting'], $row['second_ending']);
    }
}


$connect = new PDO("mysql:host=localhost; dbname=vpsdasdata", "root", "");

if ($semester == "1st") {
    $query = "SELECT
    sanction_referrals.*,
    students.student_no,
    students.first_name,
    students.middle_name,
    students.last_name,
    students.section,
    programs.abbreviation,
    programs.program_name,
    offenses.offense,
    violations.code,
    violations.violation
    FROM
    sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations on sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    WHERE
       sanction_referrals.date BETWEEN '$first_semester[0]' AND '$first_semester[1]'";
} else {
    $query = "SELECT
    sanction_referrals.*,
    students.student_no,
    students.first_name,
    students.middle_name,
    students.last_name,
    students.section,
    programs.abbreviation,
    programs.program_name,
    offenses.offense,
    violations.code,
    violations.violation
    FROM
    sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations on sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    WHERE
         sanction_referrals.date BETWEEN '$second_semester[0]' AND '$second_semester[1]'";
}


$query .= 'ORDER BY id ASC ';


$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

$path = '../../assets/images/logo.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

$output = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/gutenberg-css@0.6">

    <style>
    #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    font-size: 15px;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #dcdde1;}

    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #0097e6;
    color: white;
    }

    .center {
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        }
</style>
</head>

<body>

';
$output .= '

<div class="center" 
<h3>Leyte Normal University</h3>
<p>All Referred Students</p>
</div>
';

$output .= '
<table id="customers" style="text-align: center; ">
<thead >
    <tr>
        <th>#</th>
        <th>ID</th>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Section</th>
        <th>Course</th>
        <th>Code</th>
        <th>Type</th>
        <th>Description</th>
        <th>Complainer</th>
        <th>Date Issued</th>
    </tr>
</thead>

   <tbody >';
if ($total_data > 0) {
    $count = 1;
    foreach ($result as $row) {
        $output .= '
        <tr>
        <td>' . $count . '</td>
        <td>' . $row["id"] . '</td>
        <td>' . $row["student_no"] . '</td>
        <td>' . $row["first_name"]  . '  ' . $row["middle_name"] . '  ' .  $row["last_name"] . '</td>
        <td>' . $row["section"] . '</td>
        <td>' . $row["abbreviation"] . '</td>
        <td>' . $row["code"] . '</td>
        <td>' . $row["offense"] . '</td>
        <td style="width:15%;">' . $row["violation"] . '</td>
        <td>' . $row["complainer_name"] . '</td>
        <td>' . $row["date"] . '</td>
        </tr>
   ';
        $count++;
    }

    $output .= '
    </tbody>
    </table>
   
    </body>

</html>
    ';
} else {
    $output .= '
    <tbody>
        <tr>
            <td colspan="12" align="center"><h1>No Data Found</h1></td>
        </tr>
    </tbody>
    </table>
    </div>
    </body>
</html>
  ';
}

require '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf;
/**
 * Set the Dompdf options
 */
$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);
/**
 * Set the paper size and orientation
 */
$dompdf->setPaper("LEGAL", "landscape");
$dompdf->loadHtml($output);

$dompdf->render();

$dompdf->addInfo("Title", "All Students Referred by Semester");
$dompdf->stream("List_Student_Referred_by_Semester.pdf", ["Attachment" => 0]);
