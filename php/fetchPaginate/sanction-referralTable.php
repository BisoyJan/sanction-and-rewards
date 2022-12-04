<?php
require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = array();

$sql = "SELECT
    sanction_referrals.id,
    students.student_no,
    students.first_name,
    students.middle_name,
    students.last_name,
    students.section,
    programs.abbreviation,
    violations.code,
    offenses.offense,
    violations.violation,
    sanction_referrals.complainer_name,
    sanction_referrals.date,
    sanction_referrals.remark
FROM
    sanction_referrals
JOIN students ON sanction_referrals.student_id = students.id
JOIN violations on sanction_referrals.violation_id = violations.id
JOIN offenses ON violations.offenses_id = offenses.id
JOIN programs ON students.program_id = programs.id";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'sanction_referrals.id',
    1 => 'students.student_no',
    2 => 'violation_id',
    3 => 'students.first_name',
    4 => 'students.section',
    5 => 'semester_id',
    6 => 'programs.abbreviation',
    7 => 'violations.code',
    8 => 'violations.violation',
    9 => 'sanction_referrals.complainer_name',
    10 => 'sanction_referrals.date',
    11 => 'sanction_referrals.remark',
);

$sql .= " WHERE ";

if (isset($_POST["category"]) != '') {
    if ($_POST['category'] == 3) {
    } elseif ($_POST['category'] == 2) {
        $sql .= "sanction_referrals.remark = 'Actioned' AND ";
    } else {
        $sql .= "sanction_referrals.remark IS NULL AND ";
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
    $sql .= " ORDER BY sanction_referrals.id desc";
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
    $sub_array[] = $row['offense'];
    $sub_array[] = $row['violation'];
    $sub_array[] = $row['complainer_name'];
    $sub_array[] = $row['date'];
    $sub_array[] = $row['remark'];

    if ($row['remark'] == NULL) {
        $sub_array[] = ' <button class="viewPDFButton btn btn-warning m-1" value="' . $row["id"] . '"  type="button" >View PDF</button>
        <button class="sanction-actionAddButton btn btn-success m-1" value="' . $row["id"] . '"  type="button">Action</button>
            <a href="../forms/sanction-referral.php" style="text-decoration: none;"> <button class="sanction-referralEditButton btn btn-info m-1" value="' . $row["id"] . '"  type="button">Update</button> </a>
            <button class="referralDeleteButton btn btn-danger m-1" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#ReferralDeleteModal">Delete</button>
            ';
    } else {
        $sub_array[] = ' <button class="viewPDFButton btn btn-warning m-1" value="' . $row["id"] . '"  type="button" >View PDF</button>
        <button class="sanction-actionAddButton btn btn-success disabled m-1" value="' . $row["id"] . '"  type="button">Action</button>
            <a href="../forms/sanction-referral.php" style="text-decoration: none;"> <button class="sanction-referralEditButton btn btn-info m-1" value="' . $row["id"] . '"  type="button">Update</button> </a>
            <button class="referralDeleteButton btn btn-danger disabled m-1" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#ReferralDeleteModal">Delete</button>
            ';
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
