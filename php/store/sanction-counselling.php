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
        students.id AS student_id,
        students.student_no,
        students.first_name,
        students.middle_name,
        students.last_name,
        students.section,
        students.age,
        students.gender,
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

if (isset($_POST['create_Counsel'])) {

    $action_id = mysqli_real_escape_string($con, $_POST['action_id']);

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
        $formatted = null;
        $closed = 'Yes';
        $investigation = 'Off';
        $continuing = 'Off';
    } elseif ($recommendations == 'For Formal Investigation') {
        $formatted = null;
        $closed = 'Off';
        $investigation = 'Yes';
        $continuing = 'Off';
    } else {
        $hearingDate = mysqli_real_escape_string($con, $_POST['hearingDate']);
        $convertedhearingDate = date_create(mysqli_real_escape_string($con, $_POST['hearingDate']));
        $formatted = date_format($convertedhearingDate, "M/d/Y");
        $closed = 'Off';
        $investigation = 'Off';
        $continuing = 'Yes';
    }

    $date = date('d-m-y h:i:s'); //Date Issued

    if ($incidentReport == NULL || $resolution == NULL || $chairman == NULL || $members == NULL || $recommendations == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "UPDATE `sanction_disciplinary_action` SET `remarks`='Counselled' WHERE id = '$action_id'";
        $query_run = mysqli_query($con, $query);

        $query = "INSERT INTO `sanction_cases`(
            `sanction_disciplinary_action_id`,
            `report`,
            `resolution`,
            `recommend`,
            `chairman`,
            `members`,
            `hearing_date`,
            `date_issued`
        )
        VALUES(
            '$action_id',
            '$incidentReport',
            '$resolution',
            '$recommendations',
            '$chairman',
            '$members',
            '$hearingDate',
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
            $res = [
                'status' => 200,
                'message' => 'Counselling Created Successfully',
                'console' => $data,
            ];
            echo json_encode($res);
            return;
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
        $hearingDate = null;
        $formatted = null;
        $closed = 'Yes';
        $investigation = 'Off';
        $continuing = 'Off';
    } elseif ($recommendations == 'For Formal Investigation') {
        $hearingDate = null;
        $formatted = null;
        $closed = 'Off';
        $investigation = 'Yes';
        $continuing = 'Off';
    } else {
        $hearingDate = mysqli_real_escape_string($con, $_POST['hearingDate']);
        $convertedhearingDate = date_create(mysqli_real_escape_string($con, $_POST['hearingDate']));
        $formatted = date_format($convertedhearingDate, "M/d/Y");
        $closed = 'Off';
        $investigation = 'Off';
        $continuing = 'Yes';
    }

    $date = date('d-m-y h:i:s'); //Date Issued

    if ($incidentReport == NULL || $resolution == NULL || $chairman == NULL || $members == NULL || $recommendations == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "UPDATE `sanction_disciplinary_action` SET `remarks`='Counselled' WHERE id = '$action_id'";
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
            `date_issued` = '$date'
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
            $res = [
                'status' => 200,
                'message' => 'Counselling Updated Successfully',
                'console' => $data,
            ];
            echo json_encode($res);
            return;
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
