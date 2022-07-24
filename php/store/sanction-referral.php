<?php

use Classes\generatePDF;

require '../../database/database.php';

require_once '../../vendor/autoload.php';

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

if (isset($_GET['violation_code'])) {
    $violation_code = mysqli_real_escape_string($con, $_GET['violation_code']);

    $query = "SELECT
        violations.*,
        offenses.offense
    FROM
        violations
    JOIN offenses ON violations.offenses_id = offenses.id
    WHERE
        violations.code LIKE '%$violation_code'";

    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $violation = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Specific violation fetched Successfully',
            'data' => $violation
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Specific violation Not found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['referral_id'])) {
    $referral_id = mysqli_real_escape_string($con, $_GET['referral_id']);

    $query = "SELECT
        sanction_referrals.*,
        students.id AS student_id,
        students.student_no,
        students.first_name,
        students.middle_name,
        students.last_name,
        students.section,
        students.age,
        students.gender,
        students.email,
        programs.program_name AS program,
        programs.abbreviation,
        offenses.offense,
        violations.id AS violation_id,
        violations.code,
        violations.violation
        
    FROM
        sanction_referrals
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations on sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    WHERE
    sanction_referrals.id = '$referral_id'";

    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $referral = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Specific referral fetched Successfully',
            'data' => $referral
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Specific referral Not found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['create_Referral'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);

    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);

    $violation_id = mysqli_real_escape_string($con, $_POST['violation_id']);
    $violation = mysqli_real_escape_string($con, $_POST['violationDescription']);

    $complainerName = mysqli_real_escape_string($con, $_POST['complainerName']);
    $referredTo = mysqli_real_escape_string($con, $_POST['referredTo']);
    $dateIssued = mysqli_real_escape_string($con, $_POST['dateIssued']);


    if ($student_id == NULL || $violation_id == NULL || $complainerName == NULL || $referredTo == NULL || $dateIssued == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {


        $query = "SELECT * FROM sanction_referrals WHERE student_id = '$student_id';";

        $select = mysqli_query($con, $query);
        if (mysqli_num_rows($select) === 3) {
            $res = [
                'status' => 401,
                'message' => 'This Student is been Sanctioned 3 Times',
                'console' => $select
            ];
            echo json_encode($res);
            return;
        }

        $query = "SELECT * FROM sanction_referrals WHERE student_id = '$student_id' AND violation_id = '$violation_id' AND date = '$dateIssued';";

        $select = mysqli_query($con, $query);
        if (mysqli_num_rows($select) === 1) {
            $res = [
                'status' => 401,
                'message' => 'Referral already existed',
                'console' => $select
            ];
            echo json_encode($res);
            return;
        }

        $query = "INSERT INTO `sanction_referrals`(
            `student_id`,
            `violation_id`,
            `complainer_name`,
            `referred`,
            `date`
        )
        VALUES(
            '$student_id',
            '$violation_id',
            '$complainerName',
            '$referredTo',
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

if (isset($_POST['update_Referral'])) {
    $referral_id = mysqli_real_escape_string($con, $_POST['referral_id']);

    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);

    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);

    $violation_id = mysqli_real_escape_string($con, $_POST['violation_id']);
    $violation = mysqli_real_escape_string($con, $_POST['violationDescription']);

    $complainerName = mysqli_real_escape_string($con, $_POST['complainerName']);
    $referredTo = mysqli_real_escape_string($con, $_POST['referredTo']);
    $dateIssued = mysqli_real_escape_string($con, $_POST['dateIssued']);

    if ($student_id == NULL || $violation_id == NULL || $complainerName == NULL || $referredTo == NULL || $dateIssued == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $data = [
            'date_field' => $dateIssued,
            'referred_to_field' => $referredTo,
            'student_name_field' => $studentName,
            'violation_description_field' => $violation,
            'complainer_name_field' => $complainerName,
            'last_inserted_id' => $referral_id,
            'student_no' => $student_no
        ];

        $query = "UPDATE `sanction_referrals` SET `student_id`='$student_id',`violation_id`='$violation_id',`complainer_name`='$complainerName',`referred`='$referredTo',`date`='$dateIssued' WHERE id = '$referral_id'";
        $query_run = mysqli_query($con, $query);

        $pdf = new generatePDF;
        $response = $pdf->generateReferral($data);

        if ($response && $query_run) {
            $res = [
                'status' => 200,
                'message' => 'Referral Successfully Updated'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Referral is not Been Updated'
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['delete_Referral'])) {
    $referral_id = mysqli_real_escape_string($con, $_POST['delete_referral_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['delete_student_no']);

    $filename =  $student_no . '_' . $referral_id . '.pdf';
    unlink('../../assets/docs/processed/referrals/' . $filename);

    $query = "DELETE FROM `sanction_referrals` WHERE id = '$referral_id'";
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
