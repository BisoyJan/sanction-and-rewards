<?php
require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = array();
$sql = "SELECT
    kindly_acts.id,
    students.student_no,
    students.first_name,
    students.middle_name,
    students.last_name,
    students.section,
    programs.abbreviation,
    kindly_acts.kindly_act,
    kindly_acts.date_issued
FROM
    kindly_acts
JOIN students ON kindly_acts.student_id = students.id
JOIN programs ON students.program_id = programs.id
JOIN colleges ON programs.college_id = colleges.id";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'kindly_acts.id',
    1 => 'students.student_no',
    2 => 'students.first_name',
    3 => 'students.section',
    4 => 'programs.abbreviation',
    5 => 'kindly_acts.kindly_act',
    6 => 'kindly_acts.date_issued',
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE students.student_no LIKE '%" . $search_value . "%'";
    $sql .= " OR students.first_name LIKE '%" . $search_value . "%'";
    $sql .= " OR students.middle_name LIKE '%" . $search_value . "%'";
    $sql .= " OR students.last_name LIKE '%" . $search_value . "%'";
    $sql .= " OR programs.abbreviation LIKE '%" . $search_value . "%'";
    $sql .= " OR colleges.abbreviation LIKE '%" . $search_value . "%'";
}

if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} else {
    $sql .= " ORDER BY kindly_acts.id desc";
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
    $sub_array[] = $row['kindly_act'];
    $sub_array[] = date("M/d/Y", strtotime($row["date_issued"]));
    $sub_array[] = '<button class="viewPDFButton btn btn-success m-1" value="' . $row["id"] . '"  type="button" >View PDF</button>
    <button class="goodDeedsEditButton btn btn-success m-1" value="' . $row["id"] . '" onclick="formIDChangeEdit()" data-bs-toggle="modal" data-bs-target="#GoodDeedsModal" type="button">Update</button>
    <button class="goodDeedsDeleteButton btn btn-danger m-1" value="' . $row["id"] . '" onclick="formIDChangeDelete()" type="button" data-bs-toggle="modal" data-bs-target="#goodDeedsDeleteModal">Delete</button>';
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' =>   $total_all_rows,
    'data' => $data,
);
echo  json_encode($output);
