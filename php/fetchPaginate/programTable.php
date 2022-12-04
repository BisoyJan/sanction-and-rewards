<?php
require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = array();
$sql = "SELECT
programs.*,
colleges.abbreviation as collegeAbbreviation
FROM
programs
JOIN colleges ON programs.college_id = colleges.id";

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
    $sql .= " WHERE programs.program_name LIKE '%" . $search_value . "%'";
    $sql .= " OR programs.abbreviation LIKE '%" . $search_value . "%'";
    $sql .= " OR colleges.abbreviation LIKE '%" . $search_value . "%'";
}

if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} else {
    $sql .= " ORDER BY programs.id desc";
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
    $sub_array[] = $row["abbreviation"];
    $sub_array[] = $row["program_name"];
    $sub_array[] = $row["collegeAbbreviation"];
    $sub_array[] = '<button class="programEditButton btn btn-success" value="' . $row["id"] . '" onclick="buttonIDChange()" type="button">Update</button>
    <button class="programDeleteButton btn btn-danger" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#ProgramDeleteModal">Delete</button>';
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' =>   $total_all_rows,
    'data' => $data,
);
echo  json_encode($output);
