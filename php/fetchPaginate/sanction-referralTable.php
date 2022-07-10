<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$connect = new PDO("mysql:host=localhost; dbname=vpsdasdata", "root", "");

$limit = '10';
$page = 1;
if ($_POST['page'] > 1) {
    $start = (($_POST['page'] - 1) * $limit);
    $page = $_POST['page'];
} else {
    $start = 0;
}

$query = "
SELECT
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
";

if ($_POST['query'] != '') {
    $query .= '
    WHERE students.student_no LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
    OR students.first_name LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
    OR students.middle_name LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
    OR students.last_name LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
    OR violations.code LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
    OR sanction_referrals.complainer_name LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"
  ';
}

$query .= 'ORDER BY id DESC ';

$filter_query = $query . 'LIMIT ' . $start . ', ' . $limit . '';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

if ($statement->rowCount() == 0) {
    echo '<h1>NO DATA</h1>';
} else {

    $statement = $connect->prepare($filter_query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_filter_data = $statement->rowCount();

    $output = '
<table id="programTable" class="table table-hover table-responsive" style="text-align: center;">
<thead >
    <tr>
        <th>ID</th>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Section</th>
        <th>Course</th>
        <th>Type</th>
        <th>Description</th>
        <th>Complainer</th>
        <th>Date Issued</th>
        <th>Remarks</th>
        <th>Actions</th>
    </tr>
</thead>

   <tbody >';
    if ($total_data > 0) {
        foreach ($result as $row) {
            $output .= '
        <tr>
            <td>' . $row["id"] . '</td>
            <td>' . $row["student_no"] . '</td>
            <td>' . $row["first_name"]  . '  ' . $row["middle_name"] . '  ' .  $row["last_name"] . '</td>
            <td>' . $row["section"] . '</td>
            <td>' . $row["abbreviation"] . '</td>
            <td>' . $row["offense"] . '</td>
            <td style="width:15%;">' . $row["violation"] . '</td>
            <td>' . $row["complainer_name"] . '</td>
            <td>' . $row["date"] . '</td>
            <td>' . $row["remark"] . '</td>
            <td>
                <a href="../forms/sanction-referral.php" style="text-decoration: none;"> <button class="sanction-referralEditButton btn btn-success" value="' . $row["id"] . '"  type="button">Edit Button</button> </a>
                <button class="referralDeleteButton btn btn-danger" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#ReferralDeleteModal">Delete Button</button>
            </td>
        </tr>
   ';
        }
        $output .= '</tbody>';
    } else {
        $output .= '
    <tbody>
        <tr>
            <td colspan="2" align="center">No Data Found</td>
        </tr>
    </tbody>
  ';
    }

    $output .= '
</table>
<label class="mb-2 ps-4">Total Records - ' . $total_data . '</label>
  <ul class="pagination">
';

    $total_links = ceil($total_data / $limit);
    $previous_link = '';
    $next_link = '';
    $page_link = '';

    //echo $total_links;

    if ($total_links > 4) {
        if ($page < 5) {
            for ($count = 1; $count <= 5; $count++) {
                $page_array[] = $count;
            }
            $page_array[] = '...';
            $page_array[] = $total_links;
        } else {
            $end_limit = $total_links - 5;
            if ($page > $end_limit) {
                $page_array[] = 1;
                $page_array[] = '...';
                for ($count = $end_limit; $count <= $total_links; $count++) {
                    $page_array[] = $count;
                }
            } else {
                $page_array[] = 1;
                $page_array[] = '...';
                for ($count = $page - 1; $count <= $page + 1; $count++) {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            }
        }
    } else {
        for ($count = 1; $count <= $total_links; $count++) {
            $page_array[] = $count;
        }
    }

    for ($count = 0; $count < count($page_array); $count++) {
        if ($page == $page_array[$count]) {
            $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">' . $page_array[$count] . ' <span class="sr-only">(current)</span></a>
    </li>
    ';

            $previous_id = $page_array[$count] - 1;
            if ($previous_id > 0) {
                $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Previous</a></li>';
            } else {
                $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
            }
            $next_id = $page_array[$count] + 1;
            if ($next_id >= $total_links) {
                $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
            } else {
                $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '">Next</a></li>';
            }
        } else {
            if ($page_array[$count] == '...') {
                $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
            } else {
                $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>
      ';
            }
        }
    }

    $output .= $previous_link . $page_link . $next_link;
    $output .= '
  </ul>

';


    echo $output;
}