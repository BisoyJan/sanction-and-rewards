<?php
require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = array();

$sql = "SELECT
    sanction_disciplinary_action.id,
    students.student_no,
    students.first_name,
    students.middle_name,
    students.last_name,
    students.section,
    programs.abbreviation,
    violations.code,
    sanction_disciplinary_action.committed_date,
    sanction_disciplinary_action.committed_time,
    sanction_disciplinary_action.counselling_date,
    sanction_disciplinary_action.counselling_time,
    sanction_disciplinary_action.issual_date,
    sanction_referrals.complainer_name,
    sanction_disciplinary_action.remarks
FROM
    sanction_disciplinary_action
JOIN sanction_referrals ON sanction_disciplinary_action.sanction_referral_id = sanction_referrals.id
JOIN students ON sanction_referrals.student_id = students.id
JOIN violations ON sanction_referrals.violation_id = violations.id
JOIN offenses ON violations.offenses_id = offenses.id
JOIN programs ON students.program_id = programs.id";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    "sanction_disciplinary_action.id",
    "students.student_no",
    "students.first_name students.middle_name students.last_name",
    "students.section",
    "programs.abbreviation",
    "violations.code",
    "violations.code",
    "sanction_disciplinary_action.committed_date",
    "sanction_disciplinary_action.committed_time",
    "sanction_disciplinary_action.counselling_date",
    "sanction_disciplinary_action.counselling_time",
    "sanction_disciplinary_action.issual_date",
    "sanction_referrals.complainer_name",
    "sanction_disciplinary_action.remarks"
);

$sql .= " WHERE ";

if (isset($_POST["category"]) != '') {
    if ($_POST['category'] == 3) {
        $sql .= "(sanction_disciplinary_action.remarks IS NULL OR sanction_disciplinary_action.remarks = 'For Formal Investigation'
        OR sanction_disciplinary_action.remarks = 'For Continuing Hearing' OR sanction_disciplinary_action.remarks = 'Closed/Resolved') AND";
    } elseif ($_POST['category'] == 2) {
        $sql .= "(sanction_disciplinary_action.remarks = 'For Formal Investigation' OR sanction_disciplinary_action.remarks = 'For Continuing Hearing' OR sanction_disciplinary_action.remarks = 'Closed/Resolve') AND ";
    } else {
        $sql .= "sanction_disciplinary_action.remarks IS NULL AND ";
    }
}

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " (students.student_no LIKE '%" . $search_value . "%'";
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
    $sql .= " ORDER BY sanction_disciplinary_action.id desc";
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
    $sub_array[] = $row["first_name"]  . '  ' . $row["middle_name"] . '  ' .  $row["last_name"];
    $sub_array[] = $row['section'];
    $sub_array[] = $row['abbreviation'];
    $sub_array[] = $row['code'];
    $sub_array[] = date("M/d/Y H:i A", strtotime($row["committed_date"] . '' . $row["committed_time"]));
    $sub_array[] = date("M/d/Y H:i A", strtotime($row["counselling_date"] . '' . $row["counselling_time"]));
    $sub_array[] = date("M/d/Y", strtotime($row["issual_date"]));
    $sub_array[] = $row["complainer_name"];
    $sub_array[] = $row["remarks"];


    if ($_SESSION['type'] == 'Admin') {
        if ($row['remarks'] == NULL) {
            $sub_array[] = ' 
            <button class="viewPDFButton btn btn-warning m-1" value="' . $row["id"] . '"  type="button" >View PDF</button>
            <button class="sanction-counselAddButton btn btn-success m-1" value="' . $row["id"] . '"  type="button">Counsel</button>
            <a href="../forms/sanction-action.php" style="text-decoration: none;"> <button class="sanction-actionEditButton btn btn-info m-1" value="' . $row["id"] . '"  type="button">Update</button> </a>
            <button class="actionDeleteButton btn btn-danger m-1" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#ActionDeleteModal">Delete</button>';
        } else {
            $sub_array[] = ' 
            <button class="viewPDFButton btn btn-warning m-1" value="' . $row["id"] . '"  type="button" >View PDF</button>
            <button class="sanction-counselAddButton btn btn-success disabled m-1" value="' . $row["id"] . '"  type="button">Counsel</button>
            <a href="../forms/sanction-action.php" style="text-decoration: none;"> <button class="sanction-actionEditButton btn btn-info m-1" value="' . $row["id"] . '"  type="button">Update</button> </a>
            <button class="actionDeleteButton btn btn-danger disabled m-1" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#ActionDeleteModal">Delete</button>';
        }
    } else {
        if ($row['remarks'] == NULL) {
            $sub_array[] = ' 
            <button class="viewPDFButton btn btn-warning m-1" value="' . $row["id"] . '"  type="button" >View PDF</button>
            <a href="../forms/sanction-action.php" style="text-decoration: none;"> <button class="sanction-actionEditButton btn btn-info m-1" value="' . $row["id"] . '"  type="button">Update</button> </a>
            <button class="actionDeleteButton btn btn-danger m-1" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#ActionDeleteModal">Delete</button>';
        } else {
            $sub_array[] = ' 
            <button class="viewPDFButton btn btn-warning m-1" value="' . $row["id"] . '"  type="button" >View PDF</button>
            <a href="../forms/sanction-action.php" style="text-decoration: none;"> <button class="sanction-actionEditButton btn btn-info m-1" value="' . $row["id"] . '"  type="button">Update</button> </a>
            <button class="actionDeleteButton btn btn-danger disabled m-1" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#ActionDeleteModal">Delete</button>';
        }
    }



    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' =>   $total_all_rows,
    'data' => $data,
);
echo  json_encode($output);
