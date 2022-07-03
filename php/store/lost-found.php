<?php
require '../../database/database.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['student_id'])) {
    $student_id = mysqli_real_escape_string($con, $_GET['student_id']);

    $query = "SELECT
        students.*,
        programs.program_name as program,
        programs.abbreviation,
        colleges.abbreviation as college
    FROM
        students
    JOIN programs ON students.program_id = programs.id
    JOIN colleges on programs.college_id = colleges.id WHERE students.student_no LIKE '$student_id%'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Specific student fetched Successfully',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Specific student Not found'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_GET['lost-found_id'])) {
    $found_id = mysqli_real_escape_string($con, $_GET['found_id']);

    $query = "SELECT * FROM users WHERE id ='$found_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $account = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Specific account fetched Successfully',
            'data' => $account
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Specific account Not found'
        ];
        echo json_encode($res);
        return;
    }
}
