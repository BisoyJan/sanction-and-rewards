<?php
require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = array();

$sql = "SELECT
    sanction_cases.id,
    students.student_no,
    students.first_name,
    students.middle_name,
    students.last_name,
    students.section,
    programs.abbreviation,
    violations.code,
    sanction_cases.recommend,
    sanction_cases.hearing_date,
    sanction_cases.date_issued,
    sanction_cases.chairman
FROM
    sanction_cases
JOIN sanction_disciplinary_action ON sanction_cases.sanction_disciplinary_action_id = sanction_disciplinary_action.id
JOIN sanction_referrals ON sanction_disciplinary_action.sanction_referral_id = sanction_referrals.id
JOIN students ON sanction_referrals.student_id = students.id
JOIN violations ON sanction_referrals.violation_id = violations.id
JOIN offenses ON violations.offenses_id = offenses.id
JOIN programs ON students.program_id = programs.id";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    "sanction_cases.id",
    "students.student_no",
    "students.first_name",
    "students.section",
    "students.age",
    "students.gender",
    "programs.program_name",
    "programs.abbreviation",
    "violations.code",
    "sanction_cases.recommend",
    "sanction_cases.hearing_date",
    "sanction_cases.date_issued",
    "sanction_cases.chairman"
);

$sql .= " WHERE ";

if (isset($_POST["category"]) != '') {
    if ($_POST['category'] == 4) {
        $sql .= "(sanction_cases.recommend = 'Closed/Resolved' OR 
        sanction_cases.recommend = 'For Formal Investigation' OR 
        sanction_cases.recommend = 'For Continuing Hearing') AND (";
    } elseif ($_POST['category'] == 3) {
        $sql .= "(sanction_cases.recommend = 'Closed/Resolved') AND (";
    } elseif ($_POST['category'] == 2) {
        $sql .= "(sanction_cases.recommend = 'For Formal Investigation') AND (";
    } elseif ($_POST['category'] == 1) {
        $sql .= "(sanction_cases.recommend = 'For Continuing Hearing') AND (";
    }
}

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " students.student_no LIKE '%" . $search_value . "%'";
    $sql .= " OR students.first_name LIKE '%" . $search_value . "%'";
    $sql .= " OR students.middle_name LIKE '%" . $search_value . "%'";
    $sql .= " OR students.last_name LIKE '%" . $search_value . "%'";
    $sql .= " OR violations.code LIKE '%" . $search_value . "%'";
    $sql .= " OR sanction_referrals.complainer_name LIKE '%" . $search_value . "%')";
}

if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} else {
    $sql .= " ORDER BY sanction_cases.id desc";
}

if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT  " . $start . ", " . $length;
}

$query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['id'];
    $sub_array[] = $row['student_no'];
    $sub_array[] = $row['first_name']  . '  ' . $row['middle_name'] . '  ' .  $row['last_name'];
    $sub_array[] = $row['section'];
    $sub_array[] = $row['abbreviation'];
    $sub_array[] = $row['code'];
    $sub_array[] = $row['recommend'];

    if ($row['hearing_date'] != '0000-00-00') {
        $sub_array[] = 'No Date';
    } else {
        $sub_array[] = date("M/d/Y", strtotime($row['hearing_date']));
    }

    $sub_array[] = date("M/d/Y", strtotime($row['date_issued']));
    $sub_array[] = $row['chairman'];
    $sub_array[] = '<button class="viewPDFButton btn btn-warning m-1" value="' . $row["id"] . '"  type="button" >View PDF</button>
    <a href="../forms/sanction-counselling.php" style="text-decoration: none;"> <button class="sanction-counsellingEditButton btn btn-info m-1" value="' . $row["id"] . '"  type="button">Update</button> </a>
    <button class="counselDeleteButton btn btn-danger m-1" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#CounselDeleteModal">Delete</button>';


    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' =>   $total_all_rows,
    'data' => $data,
);
echo  json_encode($output);
