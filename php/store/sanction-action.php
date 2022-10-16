<?php

use Classes\generatePDF;

require '../../database/database.php';

require_once '../../vendor/autoload.php';
require_once '../email/sendEmail.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['action_id'])) {
    $action_id = mysqli_real_escape_string($con, $_GET['action_id']);

    $query = "SELECT
        sanction_disciplinary_action.*,
        students.id AS student_id,
        students.student_no,
        students.first_name,
        students.middle_name,
        students.last_name,
        students.section,
        students.age,
        students.gender,
        students.email,
        users.first_name AS user_firstName,
        users.middle_name AS user_middleName,
        users.last_name AS user_lastName,
        programs.program_name AS program,
        programs.abbreviation,
        offenses.offense,
        violations.id AS violation_id,
        violations.code,
        violations.violation,
        sanction_referrals.complainer_name,
        sanction_referrals.referred,
        sanction_referrals.date
    FROM
        sanction_disciplinary_action
    JOIN sanction_referrals ON sanction_disciplinary_action.sanction_referral_id = sanction_referrals.id
    JOIN students ON sanction_referrals.student_id = students.id
    JOIN users ON sanction_disciplinary_action.user_id = users.id
    JOIN violations ON sanction_referrals.violation_id = violations.id
    JOIN offenses ON violations.offenses_id = offenses.id
    JOIN programs ON students.program_id = programs.id
    WHERE
        sanction_disciplinary_action.id = '$action_id'";

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

//NOTE will check if this users has already been filed action report
if (isset($_GET['referral_id'])) {

    if (empty($_SESSION['school_year'])) {
        $res = [
            'status' => 200,
            'message' => 'School year and semester not set!!',
        ];
        echo json_encode($res);
        return;
    } else {

        $referral_id = mysqli_real_escape_string($con, $_GET['referral_id']);

        $query = "SELECT
        sanction_disciplinary_action.*
    FROM
        sanction_disciplinary_action
    WHERE
    sanction_referral_id = '$referral_id'";

        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) == 1) {

            $res = [
                'status' => 200,
                'message' => 'This Referral Report Already filed an Action Report',
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
}


if (isset($_POST['create_Action'])) {

    $user_id = $_SESSION['id'];
    $date = date('Y-m-d H:i:s');

    $referral_id = mysqli_real_escape_string($con, $_POST['referral_id']);

    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);
    $student_email = mysqli_real_escape_string($con, $_POST['email_student']);

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
            `issual_date`,
            `user_id`,
            `date_time`   
        )
        VALUES(
            '$referral_id',
            '$committedDate',
            '$committedTime',
            '$counsellingDate',
            '$counsellingTime',
            '$dateIssued',
            '$user_id',
            '$date'
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

        $filename =  $student_no . '_' . $last_id . '.pdf';
        $emailData = [
            'student_name' => $studentName,
            'student_no' => $student_no,
            'student_email' => $student_no . '@lnu.edu.ph',
            'student_email_2' => $student_email,
            'fileLocation' => '../../assets/docs/processed/action/' . $filename,
            'counselling_time' => date_format($convertedCounsellingTime, "h:i A"),
            'counselling_date' => date_format($convertedCounsellingDate, "M/d/Y"),
            'last_inserted_id' => $last_id
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateAction($data);

        if ($response && $query_run) {

            $email = new sendEmail;
            $response = $email->actionEmail($emailData);

            if ($response) {

                $user_id = $_SESSION['id'];
                $description = "Created data Primary key:" . $last_id;
                $type = "Sanction Action";
                $date = date('Y-m-d H:i:s');

                $query = "INSERT INTO `logs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
                $response = mysqli_query($con, $query);

                if ($response) {
                    $res = [
                        'status' => 200,
                        'message' => 'Action Successfully Created',
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

                $user_id = $_SESSION['id'];
                $description = "Created data Primary key:" . $last_id . " But Mail failed to sent";
                $type = "Sanction Action";
                $date = date('Y-m-d H:i:s');

                $query = "INSERT INTO `logs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
                $response = mysqli_query($con, $query);
                if ($response) {
                    $res = [
                        'status' => 401,
                        'message' => 'Mail Not Sent',
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
            }
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

    $user_id = $_SESSION['id'];
    $date = date('Y-m-d H:i:s');

    $referral_id = mysqli_real_escape_string($con, $_POST['referral_id']);
    $action_id  = mysqli_real_escape_string($con, $_POST['action_id']);
    $student_email = mysqli_real_escape_string($con, $_POST['email_student']);

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

        $query = "UPDATE
            `sanction_disciplinary_action`
        SET
            `committed_date` = '$committedDate',
            `committed_time` = '$committedTime',
            `counselling_date` = '$counsellingDate',
            `counselling_time` = '$counsellingTime',
            `issual_date` = '$dateIssued',
            `user_id` = '$user_id',
            `date_time` = '$date'
        WHERE
            id = '$action_id'";

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

        $filename =  $student_no . '_' . $action_id . '.pdf';
        $emailData = [
            'student_name' => $studentName,
            'student_no' => $student_no,
            'student_email' => $student_no . '@lnu.edu.ph',
            'student_email_2' => $student_email,
            'fileLocation' => '../../assets/docs/processed/action/' . $filename,
            'counselling_time' => date_format($convertedCounsellingTime, "h:i A"),
            'counselling_date' => date_format($convertedCounsellingDate, "M/d/Y"),
            'last_inserted_id' => $action_id
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateAction($data);

        if ($response && $query_run) {

            $email = new sendEmail;
            $response = $email->actionEmail($emailData);

            if ($response) {

                $user_id = $_SESSION['id'];
                $description = "Updated data Primary key:" . $action_id;
                $type = "Sanction Action";
                $date = date('Y-m-d H:i:s');

                $query = "INSERT INTO `logs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
                $response = mysqli_query($con, $query);

                if ($response) {
                    $res = [
                        'status' => 200,
                        'message' => 'Action Successfully Updated',
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

                $user_id = $_SESSION['id'];
                $description = "Updated data Primary key:" . $action_id . " But Mail failed to sent";
                $type = "Sanction Action";
                $date = date('Y-m-d H:i:s');

                $query = "INSERT INTO `logs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
                $response = mysqli_query($con, $query);
                if ($response) {
                    $res = [
                        'status' => 401,
                        'message' => 'Mail Not Sent',
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
            }
        } else {
            $res = [
                'status' => 500,
                'message' => 'Action Not Updated',
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
    $referral_id = mysqli_real_escape_string($con, $_POST['delete_referral_id']);

    $query1 = "UPDATE `sanction_referrals` SET `remark`=NULL WHERE id = '$referral_id'";
    $query_run1 = mysqli_query($con, $query1);

    $query = "DELETE FROM `sanction_disciplinary_action` WHERE id = '$action_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run1 && $query) {

        $filename =  $student_no . '_' . $action_id . '.pdf';
        unlink('../../assets/docs/processed/action/' . $filename);

        $user_id = $_SESSION['id'];
        $description = "Deleted data Primary key:" . $referral_id;
        $type = "Sanction Action";
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO `logs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
        $response = mysqli_query($con, $query);
        if ($response) {
            $res = [
                'status' => 200,
                'message' => 'Action Successfully Deleted',
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
            'message' => 'Action is not Been Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
