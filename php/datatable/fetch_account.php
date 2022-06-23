<?php
require '../../database/database.php';
ini_set('display_errors', "on");
error_reporting(E_ALL);

$output = array();
$sql = "SELECT * FROM `users`";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'id',
    1 => 'username',
    2 => 'type',
    3 => 'first_name',
    4 => 'middle_name',
    5 => 'last_name',
);

if (isset($_POST['search']['value'])) {

    $search_value = $_POST['search']['value'];
    $sql .= "WHERE username like '%" . $search_value . "%'";
    $sql .= " OR type like '%" . $search_value . "%'";
    $sql .= " OR first_name like '%" . $search_value . "%'";
    $sql .= " OR middle_name like '%" . $search_value . "%'";
    $sql .= " OR last_name like '%" . $search_value . "%'";
};

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
    $sub_array[] = $row['username'];
    $sub_array[] = $row['type'];
    $sub_array[] = $row['first_name'];
    $sub_array[] = $row['middle_name'];
    $sub_array[] = $row['last_name'];
    $sub_array[] = '<button class="accountEditButton btn btn-success" value="' . $row['id'] . '" onclick="formIDChangeEdit()" type="button" data-bs-toggle="modal" data-bs-target="#AccountModal">Edit Button</button>
                    <button class="accountDeleteButton btn btn-danger" value="' . $row['id'] . '" type="button" data-bs-toggle="modal" data-bs-target="#AccountDeleteModal">Delete Button</button>';
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' =>   $total_all_rows,
    'data' => $data,
);
echo  json_encode($output);
