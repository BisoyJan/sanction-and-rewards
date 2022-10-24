<?php

use Classes\generatePDF;

require '../../database/database.php';
require_once '../../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['counsel_id'])) {
    $counsel_id = mysqli_real_escape_string($con, $_GET['counsel_id']);

    $query = "SELECT
        sanction_cases.*,
        sanction_referrals.id AS referral_id,
        students.id AS student_id,
        students.student_no,
        students.first_name,
        students.middle_name,
        students.last_name,
        students.section,
        students.age,
        students.gender,
        users.first_name AS user_firstName,
        users.middle_name AS user_middleName,
        users.last_name AS user_lastName,
        programs.program_name AS program,
        programs.abbreviation,
        offenses.offense,
        violations.id AS violation_id,
        violations.code,
        violations.violation
    FROM
        sanction_cases
    JOIN sanction_disciplinary_action ON sanction_cases.sanction_disciplinary_action_id = sanction_disciplinary_action.id
    JOIN sanction_referrals ON sanction_disciplinary_action.sanction_referral_id = sanction_referrals.id
    JOIN users ON sanction_disciplinary_action.user_id = users.id
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN violations ON sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    WHERE
    sanction_cases.id = '$counsel_id'";

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

if (isset($_GET['action_id'])) {
    $action_id = mysqli_real_escape_string($con, $_GET['action_id']);

    $query = "SELECT
        sanction_cases.*
    FROM
        sanction_cases
    WHERE
    sanction_disciplinary_action_id = '$action_id'";

    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $res = [
            'status' => 200,
            'message' => 'This Action Already filed Counselling Report',
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Specific Counselling Not found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['create_Counsel'])) {

    $action_id = mysqli_real_escape_string($con, $_POST['action_id']);
    $referral_id = mysqli_real_escape_string($con, $_POST['referral_id']);

    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);

    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);
    $section = mysqli_real_escape_string($con, $_POST['Section']);
    $program = mysqli_real_escape_string($con, $_POST['course_Abbreviation']);

    $violation = mysqli_real_escape_string($con, $_POST['violationDescription']);

    $incidentReport = mysqli_real_escape_string($con, $_POST['incidentReport']);
    $resolution = mysqli_real_escape_string($con, $_POST['resolution']);

    $chairman = mysqli_real_escape_string($con, $_POST['Chairman']);
    $members = mysqli_real_escape_string($con, $_POST['Members']);

    $recommendations = mysqli_real_escape_string($con, $_POST['recommendations']);

    $hearingDate = null;

    if ($recommendations == 'Closed/Resolved') {
        $referral_update = 'Counselled';
        $formatted = null;
        $closed = 'Yes';
        $investigation = 'Off';
        $continuing = 'Off';
    } elseif ($recommendations == 'For Formal Investigation') {
        $referral_update = 'For Formal Investigation';
        $formatted = null;
        $closed = 'Off';
        $investigation = 'Yes';
        $continuing = 'Off';
    } else {
        $referral_update = 'Continuing Hearing';
        $hearingDate = mysqli_real_escape_string($con, $_POST['hearingDate']);
        $convertedhearingDate = date_create(mysqli_real_escape_string($con, $_POST['hearingDate']));
        $formatted = date_format($convertedhearingDate, "M/d/Y");
        $closed = 'Off';
        $investigation = 'Off';
        $continuing = 'Yes';
    }

    if ($incidentReport == NULL || $resolution == NULL || $chairman == NULL || $members == NULL || $recommendations == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $user_id = $_SESSION['id'];
        $date = date('Y-m-d H:i:s'); //Date Issued


        $query = "UPDATE `sanction_referrals` SET `remark` = '$referral_update' WHERE id = '$referral_id'";
        $query_run = mysqli_query($con, $query);

        $query = "UPDATE `sanction_disciplinary_action` SET `remarks`='$recommendations' WHERE id = '$action_id'";
        $query_run = mysqli_query($con, $query);

        $query = "INSERT INTO `sanction_cases`(
            `sanction_disciplinary_action_id`,
            `report`,
            `resolution`,
            `recommend`,
            `chairman`,
            `members`,
            `hearing_date`,
            `date_issued`,
            `user_id`,
            `date_time`
        )
        VALUES(
            '$action_id',
            '$incidentReport',
            '$resolution',
            '$recommendations',
            '$chairman',
            '$members',
            '$hearingDate',
            '$date',
            '$user_id',
            '$date'
        )";

        $query_run = mysqli_query($con, $query);
        $last_id = mysqli_insert_id($con);

        $data = [
            'student_name_field' => $studentName,
            'student_id_field'  => $student_no,
            'program_section_field' => $program . ' ' . $section,
            'violation_field' => $violation,
            'incident_report_field' => $incidentReport,
            'resolution_field' => $resolution,

            'close_resolve' => $closed,
            'continuing_hearing' => $continuing,
            'formal_investigation' => $investigation,

            'continuing_date' => $formatted,
            'chairman_field' => $chairman,
            'members_field' => $members,
            'last_inserted_id' => $last_id,
            'student_no' => $student_no
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateCounselling($data);

        if ($query_run) {

            $description = "Created data Primary key:" . $last_id;
            $type = "Sanction Counselling";

            $query = "INSERT INTO `syslogs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
            $response = mysqli_query($con, $query);
            if ($response) {
                $res = [
                    'status' => 200,
                    'message' => 'Counselling Successfully Created',
                    'console' => $query_run,
                ];
                echo json_encode($res);
                return;
            } else {
                $res = [
                    'status' => 500,
                    'message' => 'Something wrong with the logs system',
                    'console' => $response
                ];
                echo json_encode($res);
                return;
            }
        } else {
            $res = [
                'status' => 500,
                'message' => 'Counselling Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['update_Counsel'])) {

    $counsel_id = mysqli_real_escape_string($con, $_POST['counselling_id']);

    $action_id = mysqli_real_escape_string($con, $_POST['action_id']);
    $referral_id = mysqli_real_escape_string($con, $_POST['referral_id']);

    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);

    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);
    $section = mysqli_real_escape_string($con, $_POST['Section']);
    $program = mysqli_real_escape_string($con, $_POST['course_Abbreviation']);

    $violation = mysqli_real_escape_string($con, $_POST['violationDescription']);

    $incidentReport = mysqli_real_escape_string($con, $_POST['incidentReport']);
    $resolution = mysqli_real_escape_string($con, $_POST['resolution']);

    $chairman = mysqli_real_escape_string($con, $_POST['Chairman']);
    $members = mysqli_real_escape_string($con, $_POST['Members']);

    $recommendations = mysqli_real_escape_string($con, $_POST['recommendations']);

    $hearingDate = null;

    if ($recommendations == 'Closed/Resolved') {
        $referral_update = 'Counselled';
        $formatted = null;
        $closed = 'Yes';
        $investigation = 'Off';
        $continuing = 'Off';
    } elseif ($recommendations == 'For Formal Investigation') {
        $referral_update = 'For Formal Investigation';
        $formatted = null;
        $closed = 'Off';
        $investigation = 'Yes';
        $continuing = 'Off';
    } else {
        $referral_update = 'Continuing Hearing';
        $hearingDate = mysqli_real_escape_string($con, $_POST['hearingDate']);
        $convertedhearingDate = date_create(mysqli_real_escape_string($con, $_POST['hearingDate']));
        $formatted = date_format($convertedhearingDate, "M/d/Y");
        $closed = 'Off';
        $investigation = 'Off';
        $continuing = 'Yes';
    }

    if ($incidentReport == NULL || $resolution == NULL || $chairman == NULL || $members == NULL || $recommendations == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $user_id = $_SESSION['id'];
        $date = date('Y-m-d H:i:s'); //Date Issued

        $query = "UPDATE `sanction_referrals` SET `remark` = '$referral_update' WHERE id = '$referral_id'";
        $query_run = mysqli_query($con, $query);

        $query = "UPDATE `sanction_disciplinary_action` SET `remarks`='$recommendations' WHERE id = '$action_id'";
        $query_run = mysqli_query($con, $query);

        $query = "UPDATE
        `sanction_cases`
        SET
            `report` = '$incidentReport',
            `resolution` = '$resolution',
            `recommend` = '$recommendations',
            `chairman` = '$chairman',
            `members` = '$members',
            `hearing_date` = '$hearingDate',
            `user_id` = '$user_id',
            `date_time` = '$date'
        WHERE
        id = '$counsel_id'";

        $query_run = mysqli_query($con, $query);

        $data = [
            'student_name_field' => $studentName,
            'student_id_field'  => $student_no,
            'program_section_field' => $program . ' ' . $section,
            'violation_field' => $violation,
            'incident_report_field' => $incidentReport,
            'resolution_field' => $resolution,

            'close_resolve' => $closed,
            'continuing_hearing' => $continuing,
            'formal_investigation' => $investigation,

            'continuing_date' => $formatted,
            'chairman_field' => $chairman,
            'members_field' => $members,
            'last_inserted_id' => $counsel_id,
            'student_no' => $student_no
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateCounselling($data);

        if ($query_run) {

            $description = "Updated data Primary key:" . $counsel_id;
            $type = "Sanction Counselling";

            $query = "INSERT INTO `syslogs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
            $response = mysqli_query($con, $query);
            if ($response) {
                $res = [
                    'status' => 200,
                    'message' => 'Counselling Successfully Updated',
                    'console' => $query_run,
                ];
                echo json_encode($res);
                return;
            } else {
                $res = [
                    'status' => 500,
                    'message' => 'Something wrong with the logs system',
                    'console' => $response
                ];
                echo json_encode($res);
                return;
            }
        } else {
            $res = [
                'status' => 500,
                'message' => 'Counselling Not Updated',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['delete_Counsel'])) {
    $counsel_id = mysqli_real_escape_string($con, $_POST['delete_counsel_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['delete_student_no']);
    $action_id = mysqli_real_escape_string($con, $_POST['delete_action_id']);
    $referral_id = mysqli_real_escape_string($con, $_POST['delete_referral_no']);

    $query = "UPDATE `sanction_referrals` SET `remark` ='Actioned' WHERE id = '$referral_id'";
    $query_run = mysqli_query($con, $query);

    $query = "UPDATE `sanction_disciplinary_action` SET `remarks`=NULL WHERE id = '$action_id'";
    $query_run = mysqli_query($con, $query);

    $query = "DELETE FROM `sanction_cases` WHERE id = '$counsel_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $filename =  $student_no . '_' . $counsel_id . '.pdf';
        unlink('../../assets/docs/processed/counselling/' . $filename);

        $user_id = $_SESSION['id'];
        $description = "Deleted data Primary key:" . $counsel_id;
        $type = "Sanction Action";
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO `syslogs`(`user_id`,`description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
        $response = mysqli_query($con, $query);
        if ($response) {
            $res = [
                'status' => 200,
                'message' => 'Counselling Successfully Deleted',
                'console' => $query_run,
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Something wrong with the logs system',
                'console' => $response
            ];
            echo json_encode($res);
            return;
        }
    } else {
        $res = [
            'status' => 500,
            'message' => 'Counselling is not Been Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
