<?php

use Classes\generatePDF;

require '../../database/database.php';

require_once '../../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['action_id'])) {
    $action_id = mysqli_real_escape_string($con, $_GET['action_id']);

    $query = "SELECT
        sanction_referrals.*,
        students.student_no,
        students.first_name,
        students.middle_name,
        students.last_name,
        students.section,
        students.section,
        students.age,
        students.gender,
        programs.abbreviation,
        programs.program_name,
        sanction_disciplinary_action.id AS action_id,
        sanction_disciplinary_action.committed_date,
        sanction_disciplinary_action.committed_time,
        sanction_disciplinary_action.counselling_date,
        sanction_disciplinary_action.counselling_time,
        sanction_disciplinary_action.issual_date,
        sanction_disciplinary_action.remarks,
        offenses.offense,
        violations.code,
        violations.violation
    FROM
        sanction_disciplinary_action
    JOIN sanction_referrals ON sanction_disciplinary_action.sanction_referral_id = sanction_referrals.id
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations ON sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id WHERE sanction_disciplinary_action.id = '$action_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $action = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Specific action fetched Successfully',
            'data' => $action
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Specific action Not found'
        ];
        echo json_encode($res);
        return;
    }
}

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

if (isset($_POST['update_Action'])) {
    $action_id =  mysqli_real_escape_string($con, $_POST['action_id']);
    $referral_id = mysqli_real_escape_string($con, $_POST['referral_id']);

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


        $query = "UPDATE
            `sanction_disciplinary_action`
        SET
            `sanction_referral_id` = ' $referral_id',
            `committed_date` = '$committedDate',
            `committed_time` = '$committedTime',
            `counselling_date` = '$counsellingDate',
            `counselling_time` = '$counsellingTime',
            `issual_date` = '$dateIssued '
        WHERE id = '$action_id'";

        $query_run = mysqli_query($con, $query);

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
            'last_inserted_id' => $action_id,
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

if (isset($_POST['delete_Action'])) {
    $action_id = mysqli_real_escape_string($con, $_POST['delete_action_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['delete_student_no']);

    $filename =  $student_no . '_' . $action_id . '.pdf';
    unlink('../../assets/docs/processed/action/' . $filename);

    $query = "DELETE FROM `sanction_disciplinary_action` WHERE id = '$action_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Lost and Found Successfully Delete',
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Lost and Found is not Been Delete'
        ];
        echo json_encode($res);
        return;
    }
}
