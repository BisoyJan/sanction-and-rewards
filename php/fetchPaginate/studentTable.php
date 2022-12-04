<?php
require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = array();
$sql = "SELECT
    students.*,
    programs.abbreviation,
    programs.program_name as program,
    programs.abbreviation,
    colleges.abbreviation as college
    FROM
    students
    JOIN programs ON students.program_id = programs.id
    JOIN colleges ON programs.college_id = colleges.id";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'id',
    1 => 'student_no',
    2 => 'first_name',
    3 => 'middle_name',
    4 => 'last_name',
    5 => 'age',
    6 => 'gender',
    7 => 'section',
    8 => 'program',
    9 => 'college',
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
    $sql .= " ORDER BY students.id desc";
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
    $sub_array[] = $row['age'];
    $sub_array[] = $row['gender'];
    $sub_array[] = $row['section'];
    $sub_array[] = $row['program'];
    $sub_array[] = $row['college'];
    $sub_array[] = '<button class="studentEditButton btn btn-success ms-1" value="' . $row["id"] . '" onclick="formIDChangeEdit()" type="button" data-bs-toggle="modal" data-bs-target="#StudentModal">Update</button>
    <button class="studentDeleteButton btn btn-danger " value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#StudentDeleteModal">Delete</button>';
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' =>   $total_all_rows,
    'data' => $data,
);
echo  json_encode($output);
