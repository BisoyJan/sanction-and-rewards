<?php
require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$output = array();
$sql = "SELECT
        COUNT(students.id) AS total,
        students.student_no,
        students.first_name,
        students.middle_name,
        students.last_name,
        students.gender,
        students.section,
        programs.abbreviation
    FROM
        sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations ON sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    JOIN colleges ON programs.college_id = colleges.id
    WHERE MONTH(sanction_referrals.date) = MONTH(NOW())";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'students.student_no',
    1 => 'students.first_name',
    2 => 'students.gender',
    3 => 'students.section',
    4 => ' programs.abbreviation',
    5 => 'total',
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND students.student_no LIKE '%" . $search_value . "%'";
    $sql .= " OR students.first_name LIKE '%" . $search_value . "%'";
    $sql .= " OR students.middle_name LIKE '%" . $search_value . "%'";
    $sql .= " OR students.last_name LIKE '%" . $search_value . "%'";
    $sql .= " OR programs.abbreviation LIKE '%" . $search_value . "%'";
    $sql .= " OR colleges.abbreviation LIKE '%" . $search_value . "%'";
}

$sql .= "GROUP BY students.student_no";

if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} else {
    $sql .= " ORDER BY COUNT(students.id) desc";
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
    $sub_array[] = $row['student_no'];
    $sub_array[] = $row["first_name"]  . '  ' . $row["middle_name"] . '  ' .  $row["last_name"];
    $sub_array[] = $row['gender'];
    $sub_array[] = $row['section'];
    $sub_array[] = $row['abbreviation'];
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
