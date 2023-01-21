<?php
require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = array();
$sql = "SELECT
    violations.code,
    offenses.offense,
    COUNT(violations.id) AS total
FROM
    sanction_referrals
JOIN students ON sanction_referrals.student_id = students.id
JOIN violations ON sanction_referrals.violation_id = violations.id
JOIN offenses ON violations.offenses_id = offenses.id
JOIN programs ON students.program_id = programs.id
JOIN colleges ON programs.college_id = colleges.id";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'violations.code',
    1 => 'offenses.offense',
    2 => 'total'
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND students.student_no LIKE '%" . $search_value . "%'";
    $sql .= " OR violations.code LIKE '%" . $search_value . "%'";
    $sql .= " OR offenses.offense LIKE '%" . $search_value . "%'";
}

$sql .= "GROUP BY violations.code";

if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} else {
    $sql .= " ORDER BY COUNT(violations.id) desc";
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
    $sub_array[] = $row['code'];

    if ($row['offense'] == "Light Offense") {
        $sub_array[] = ' <h5><span class=" badge bg-info rounded-pill">' . $row['offense'] . '</span></h5>';
    } elseif ($row['offense'] == "Serious Offense") {
        $sub_array[] = ' <h5><span  class=" badge bg-warning rounded-pill">' . $row['offense'] . '</span></h5>';
    } else {
        $sub_array[] = ' <h5><span class=" badge bg-danger rounded-pill">' . $row['offense'] . '</span></h5>';
    }
    $sub_array[] = '<span class="badge bg-primary rounded-pill">' . $row["total"] . '</span>';
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' =>   $total_all_rows,
    'data' => $data,
);
echo  json_encode($output);
