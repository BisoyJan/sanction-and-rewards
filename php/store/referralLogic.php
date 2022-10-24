<?php

require '../../database/database.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['checkReferral'])) {

    if (empty($_SESSION['semester_id'])) :
        $res = [
            'status' => 401,
            'message' => 'Semester is not yet set'
        ];
        echo json_encode($res);
        return;
    endif;

    $semester_id =  $_SESSION['semester_id'];

    $student_id = mysqli_real_escape_string($con, $_GET['checkReferral']);

    $query = "SELECT * FROM `semesters` WHERE id = '$semester_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        while ($row = mysqli_fetch_array($query_run)) {

            if (date('n', strtotime($row['first_starting'])) <= date('n') && date('n', strtotime($row['first_ending'])) >= date('n')) {

                $data = array($row['first_starting'], $row['first_ending'], $student_id, $semester_id);

                $response =  selectReferralDataSpecificStudent($data);

                $res = [
                    'status' => $response[2],
                    'message' => $response[1],
                    'type' => $response[0]

                ];
                echo json_encode($res);
                return;
            } elseif (date('n', strtotime($row['second_starting'])) <= date('n') && date('n', strtotime($row['second_ending'])) >= date('n')) {

                $data = array($row['second_starting'], $row['second_ending'], $student_id, $semester_id);

                $response =  selectReferralDataSpecificStudent($data);

                $res = [
                    'status' => $response[2],
                    'message' => $response[1],
                    'type' => $response[0]

                ];
                echo json_encode($res);
                return;
            }
        }
    }
}

function selectReferralDataSpecificStudent($data)
{
    global $con;

    $counselling = 0;
    $investigation = 0;
    $continuing = 0;
    $actioned = 0;
    $notActioned = 0;

    $wholeYearActioned = 0;
    $wholeYearNotActioned = 0;

    $query = "SELECT
        sanction_referrals.*
    FROM
        sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    WHERE
        students.id = $data[2] AND sanction_referrals.date BETWEEN '$data[0]' AND '$data[1]'";

    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) != 0) {

        while ($row = mysqli_fetch_array($query_run)) {

            if ($row['remark'] == 'Counselled') {
                $counselling++;
            } elseif ($row['remark'] == 'For Formal Investigation') {
                $investigation++;
            } elseif ($row['remark'] == 'Continuing Hearing') {
                $continuing++;
            } elseif ($row['remark'] == 'Actioned') {
                $actioned++;
            } else {
                $notActioned++;
            }
        }
    }

    $query = "SELECT
        sanction_referrals.*
    FROM
        sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN semesters ON sanction_referrals.semester_id = semesters.id
    WHERE
        students.student_no = $data[2] AND sanction_referrals.semester_id = $data[3]";

    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) != 0) {

        while ($row = mysqli_fetch_array($query_run)) {

            if ($row['remark'] == 'Actioned') {
                $wholeYearActioned++;
            } elseif ($row['remark'] == null) {
                $wholeYearNotActioned++;
            }
        }
    }

    $total = $counselling + $investigation + $continuing + $actioned + $notActioned;

    if ($total >= 1) {

        $type = "warning";
        $message = 'This student is already Referred ' . $total . ' times by this Semester';
        $status = 412;
    } elseif ($wholeYearActioned + $wholeYearNotActioned != 0) {

        $type = "danger";
        $message = 'This student has ' . $wholeYearNotActioned . ' Referral report not yet Actioned and has ' . $wholeYearActioned . ' Actioned reports not yet Counselled';
        $status = 412;
    } else {
        $type = "success";
        $message = 'This student has no Pending Records';
        $status = 200;
    }


    $data = array($type, $message, $status);

    return $data;
}
