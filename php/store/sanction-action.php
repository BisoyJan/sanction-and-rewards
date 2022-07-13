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
    $section = mysqli_real_escape_string($con, $_POST['Section']);
    $program = mysqli_real_escape_string($con, $_POST['course_Abbreviation']);

    $offense = mysqli_real_escape_string($con, $_POST['offenseType']);

    $complainerName = mysqli_real_escape_string($con, $_POST['complainerName']);
    $referredTo = mysqli_real_escape_string($con, $_POST['referredTo']);

    $dateIssued = mysqli_real_escape_string($con, $_POST['dateIssued']);
    $convertedDateIssued = date_create(mysqli_real_escape_string($con, $_POST['dateIssued']));

    $committedDate = mysqli_real_escape_string($con, $_POST['committedDate']);
    $committedTime = mysqli_real_escape_string($con, $_POST['committedTime']);

    $counsellingDate = mysqli_real_escape_string($con, $_POST['counsellingDate']);
    $counsellingTime = mysqli_real_escape_string($con, $_POST['counsellingTime']);

    $convertedCommittedDate = date_create(mysqli_real_escape_string($con, $_POST['committedDate']));
    $convertedCommittedTime = date_create(mysqli_real_escape_string($con, $_POST['committedTime']));

    $convertedCounsellingDate = date_create(mysqli_real_escape_string($con, $_POST['counsellingDate']));
    $convertedCounsellingTime = date_create(mysqli_real_escape_string($con, $_POST['counsellingTime']));


    if ($referral_id == NULL || $committedDate == NULL || $committedTime == NULL || $counsellingDate == NULL || $counsellingTime == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;

    } else {

        $query = "UPDATE `sanction_referrals` SET `remark`='Actioned' WHERE id = '$referral_id'";
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
        )";

        $query_run = mysqli_query($con, $query);
        $last_id = mysqli_insert_id($con);

        $data = [
            'student_name_field' => $studentName,
            'program_section_field' => $program . ' ' . $section,
            'type_of_offense_field' => $offense,
            'committed_time_date_field' => date_format($convertedCommittedDate, "M/d/Y") . ' ' . date_format($convertedCommittedTime, "h:i A"),
            'date_issued_field' => date_format($convertedDateIssued, "M/d/Y"),
            'date_issued1_field' => date_format($convertedDateIssued, "M/d/Y"),
            'counselling_date_field' =>  date_format($convertedCounsellingDate, "M/d/Y"),
            'counselling_time_field' =>  date_format($convertedCounsellingTime, "h:i A"),
            'complainer_name_field' => $complainerName,
            'vpsdas_name_field' => $referredTo,
            'last_inserted_id' => $last_id,
            'student_no' => $student_no
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateAction($data);

        if ($response && $query_run) {
            $res = [
                'status' => 200,
                'message' => 'Action Created Successfully',
                'console' => $query_run,
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Action Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}
