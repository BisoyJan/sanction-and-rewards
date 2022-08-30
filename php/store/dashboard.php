<?php
require '../../database/database.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['student'])) {
    $query = "SELECT * FROM `students`";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) != 0) {

        $data = mysqli_num_rows($query_run);

        $res = [
            'status' => 200,
            'message' => 'Student fetched Successfully',
            'data' => $data
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'No Data found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['referral'])) {
    $query = "SELECT * FROM `sanction_referrals`";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) != 0) {

        $data = mysqli_num_rows($query_run);

        $res = [
            'status' => 200,
            'message' => 'Referral fetched Successfully',
            'data' => $data
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'No Data found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['action'])) {
    $query = "SELECT * FROM `sanction_disciplinary_action`";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) != 0) {

        $data = mysqli_num_rows($query_run);

        $res = [
            'status' => 200,
            'message' => 'Actioned fetched Successfully',
            'data' => $data
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'No Data found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['case'])) {
    $query = "SELECT * FROM `sanction_cases`";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) != 0) {

        $data = mysqli_num_rows($query_run);

        $res = [
            'status' => 200,
            'message' => 'Case fetched Successfully',
            'data' => $data
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'No Data found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['referralChart'])) {

    $query = "SELECT
        COUNT(offenses.id) as light
    FROM
        sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations ON sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    WHERE offenses.id = 1;";
    $query_run = mysqli_query($con, $query);


    $query1 = "SELECT
        COUNT(offenses.id) as serious
    FROM
        sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations ON sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    WHERE offenses.id = 2;";
    $query_run1 = mysqli_query($con, $query1);

    $query2 = "SELECT
        COUNT(offenses.id) as very
    FROM
        sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations ON sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    WHERE offenses.id = 3;";
    $query_run2 = mysqli_query($con, $query2);

    if (mysqli_num_rows($query_run) != 0) {

        $data1 = mysqli_fetch_array($query_run);
        $data2 = mysqli_fetch_array($query_run1);
        $data3 = mysqli_fetch_array($query_run2);

        $res = [
            'status' => 200,
            'message' => 'Case fetched Successfully',
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3
        ];
        echo json_encode($res);
    } else {
        $res = [
            'status' => 404,
            'message' => 'No Data found'
        ];
        echo json_encode($res);
        return;
    }
}
