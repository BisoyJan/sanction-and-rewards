<?php
require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = array();
$sql = "SELECT
    *
FROM
    properties";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'id',
    1 => 'student_id',
    2 => 'retrieval_id',
    3 => 'type',
    4 => 'description',
    5 => 'date_found',
    6 => 'date_retrieved',
    7 => 'date_surrendered',
    8 => 'remarks'
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE student_id LIKE '%" . $search_value . "%'";
    $sql .= " OR retrieval_id LIKE '%" . $search_value . "%'";
    $sql .= " OR description LIKE '%" . $search_value . "%'";
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
    $sub_array[] = $row["student_id"];
    $sub_array[] = $row["retrieval_id"];
    $sub_array[] = $row["type"];
    $sub_array[] = $row["description"];
    $sub_array[] = $row["date_found"];
    $sub_array[] = $row["date_retrieved"];
    $sub_array[] = $row["date_surrendered"];
    $sub_array[] = '<button class="lost-foundViewImage btn btn-success" value="' . $row["id"] . '"  type="button" data-bs-toggle="modal" data-bs-target="#viewImage">View Image</button>
    <a href="../forms/lost-found.php" style="text-decoration: none;"> <button class="lost-foundEditButton btn btn-success" value="' . $row["id"] . '"  type="button">Update</button> </a>
    <button class="lost-foundDeleteButton btn btn-danger" value="' . $row["id"] . '" type="button" data-bs-toggle="modal" data-bs-target="#LostFoundDeleteModal">Delete</button>';
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' =>   $total_all_rows,
    'data' => $data,
);
echo  json_encode($output);
