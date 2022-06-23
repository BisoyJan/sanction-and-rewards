<?php
require '../../database/database.php';
ini_set('display_errors', "on");
error_reporting(E_ALL);

$params = $columns = $totalRecords = $data = array();

$params = $_REQUEST;

$columns = array(
    0 => 'id',
    1 => 'username',
    3 => 'type',
    4 => 'first_name',
    5 => 'middle_name',
    6 => 'last_name',
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if (!empty($params['search']['value'])) {
    $where .= " WHERE ";
    $where .= " ( username like '%" . $params['search']['value'] . "%'";
    $where .= " OR type LIKE '" . $params['search']['value'] . "%' ";
    $where .= " OR first_name LIKE '" . $params['search']['value'] . "%' ";
    $where .= " OR middle_name LIKE '" . $params['search']['value'] . "%' ";
    $where .= " OR last_name LIKE '" . $params['search']['value'] . "%')";
}

// getting total number records without any search
$sql = "SELECT * FROM `users` ";
$sqlTot .= $sql;
$sqlRec .= $sql;
//concatenate search sql if value exist
if (isset($where) && $where != '') {

    $sqlTot .= $where;
    $sqlRec .= $where;
}

$sqlRec .=  " ORDER BY " . $columns[$params['order'][0]['column']] . "   " . $params['order'][0]['dir'] . "  LIMIT " . $params['start'] . " ," . $params['length'] . " ";

$queryTot = mysqli_query($con, $sqlTot) or die("database error:" . mysqli_error($con));

$totalRecords = mysqli_num_rows($queryTot);

$queryRecords = mysqli_query($con, $sqlRec) or die("error to fetch Accounts data");

//iterate on results row and create new index array of data
while ($row = mysqli_fetch_row($queryRecords)) {
    $data[] = $row;
}

$json_data = array(
    "draw"            => intval($params['draw']),
    "recordsTotal"    => intval($totalRecords),
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format