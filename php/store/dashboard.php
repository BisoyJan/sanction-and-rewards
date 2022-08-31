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

if (isset($_GET['barChart'])) {
    $query = "SELECT
        COUNT(offenses.id) AS total,
        offenses.offense
    FROM
        sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations ON sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    GROUP BY
        offenses.offense;";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) != 0) {


        while ($data = mysqli_fetch_array($query_run)) {
            $numbers[] = $data['total'];
            $labels[] = $data['offense'];
        }

        $res = [
            'status' => 200,
            'message' => 'Bar Chart fetched Successfully',
            'numbers' => $numbers,
            'labels' => $labels
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

if (isset($_GET['pieChart'])) {
    $query = "SELECT
        COUNT(sanction_referrals.id) AS total,
        colleges.abbreviation
    FROM
        sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations ON sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    JOIN colleges ON programs.college_id = colleges.id
    GROUP BY
        colleges.abbreviation;";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) != 0) {


        while ($data = mysqli_fetch_array($query_run)) {
            $numbers[] = $data['total'];
            $labels[] = $data['abbreviation'];
        }

        $res = [
            'status' => 200,
            'message' => 'Pie Chart fetched Successfully',
            'numbers' => $numbers,
            'labels' => $labels
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
