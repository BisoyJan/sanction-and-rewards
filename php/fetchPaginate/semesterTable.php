<?php
require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = array();
$sql = "SELECT * FROM `semesters`";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'id',
    1 => 'abbreviation',
    2 => 'program_name',
    3 => 'college_id',
    4 => 'collegeAbbreviation'
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE id LIKE '%" . $search_value . "%'";
    $sql .= " OR school_year LIKE '%" . $search_value . "%'";
}

if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} else {
    $sql .= " ORDER BY id desc";
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
    $sub_array[] = date("M/d/Y", strtotime($row["first_starting"])) . ' - ' . date("M/d/Y", strtotime($row["first_ending"]));
    $sub_array[] = date("M/d/Y", strtotime($row["second_starting"])) . ' - ' . date("M/d/Y", strtotime($row["second_ending"]));
    $sub_array[] = $row["school_year"];
    $sub_array[] = '<button class="semesterSetButton btn btn-secondary" value="' . $row["id"] . '" type="button">Set</button> 
    <button class="semesterEditButton btn btn-success" value="' . $row["id"] . '" onclick="formIDChangeEdit()" type="button" data-bs-toggle="modal" data-bs-target="#SemesterModal">Update</button>
    <button class="semesterDeleteButton btn btn-danger" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#SemesterDeleteModal">Delete</button>';
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' =>   $total_all_rows,
    'data' => $data,
);
echo  json_encode($output);
