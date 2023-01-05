<?php
require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = array();

$sql = "SELECT 
    syslogs.*,
    users.first_name,
    users.middle_name,
    users.last_name,
    users.type
FROM 
    syslogs
JOIN users ON syslogs.user_id = users.id";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'id',
    1 => 'username',
    2 => 'type',
    3 => 'first_name',
    4 => 'middle_name',
    5 => 'last_name'
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE users.first_name LIKE '%" . $search_value . "%'";
    $sql .= " OR users.middle_name LIKE '%" . $search_value . "%'";
    $sql .= " OR first_name LIKE '%" . $search_value . "%'";
    $sql .= " OR users.last_name LIKE '%" . $search_value . "%'";
    $sql .= " OR users.type LIKE '%" . $search_value . "%'";
}

if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} else {
    $sql .= " ORDER BY syslogs.id desc";
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
    $sub_array[] = $row["user_id"];
    $sub_array[] = $row["first_name"]  . '  ' . $row["middle_name"] . '  ' .  $row["last_name"];
    $sub_array[] = $row["type"];
    $sub_array[] = $row["section"];
    $sub_array[] = $row["description"];
    $sub_array[] = date("M/d/Y H:i A", strtotime($row["date"]));
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' =>   $total_all_rows,
    'data' => $data,
);
echo  json_encode($output);
