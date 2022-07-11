<?php

use Classes\generatePDF;

require '../../database/database.php';

require_once '../../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_POST['create_Action'])) {
    $referral_id = mysqli_real_escape_string($con, $_POST['referral_id']);

    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);

    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);

    $violation_id = mysqli_real_escape_string($con, $_POST['violation_id']);
    $violation = mysqli_real_escape_string($con, $_POST['violationDescription']);

    $complainerName = mysqli_real_escape_string($con, $_POST['complainerName']);
    $referredTo = mysqli_real_escape_string($con, $_POST['referredTo']);
    $dateIssued = mysqli_real_escape_string($con, $_POST['dateIssued']);

    $committedDate = mysqli_real_escape_string($con, $_POST['committedDate']);
    $committedTime = mysqli_real_escape_string($con, $_POST['committedTime']);
    $counsellingDate = mysqli_real_escape_string($con, $_POST['counsellingDate']);
    $counsellingTime = mysqli_real_escape_string($con, $_POST['counsellingTime']);


    if ($referral_id == NULL || $committedDate == NULL || $committedTime == NULL || $counsellingDate == NULL || $counsellingTime == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "UPDATE `sanction_referrals` SET `remark`='Filed' WHERE id = '$referral_id'";
        $query_run = mysqli_query($con, $query);


        $query = "INSERT INTO `sanction_disciplinary_action`(
            `sanction_referral_id`,
            `committed_date`,
            `committed_time`,
            `counselling_date`,
            `counselling_time`,
            `issual_date`
        )
        VALUES(
            '$referral_id',
            '$committedDate',
            '$committedTime',
            '$counsellingDate',
            '$counsellingTime',
            '$dateIssued'
        );";

        $query_run = mysqli_query($con, $query);
        $last_id = mysqli_insert_id($con);

        $data = [
            'date_field' => $dateIssued,
            'referred_to_field' => $referredTo,
            'student_name_field' => $studentName,
            'violation_description_field' => $violation,
            'complainer_name_field' => $complainerName,
            'last_inserted_id' => $last_id,
            'student_no' => $student_no
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateReferral($data);

        if ($response && $query_run) {
            $res = [
                'status' => 200,
                'message' => 'Referral Created Successfully',
                'console' => $query_run,
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Referral Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}
