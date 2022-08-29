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
