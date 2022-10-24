<?php

use Classes\generatePDF;

require '../../database/database.php';

require_once '../../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['outstandingAthlete_id'])) {
    $leadership_id = mysqli_real_escape_string($con, $_GET['outstandingAthlete_id']);

    $query = "SELECT
        outstanding_athlete.*,
        students.id AS student_id,
        students.student_no,
        students.first_name,
        students.middle_name,
        students.last_name,
        students.age,
        students.gender,
        students.section,
        programs.abbreviation,
        programs.program_name
    FROM
    outstanding_athlete
    JOIN students ON outstanding_athlete.student_id = students.id
    JOIN programs ON students.program_id = programs.id 
    WHERE outstanding_athlete.id ='$leadership_id'";

    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $data = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Specific Data fetched Successfully',
            'data' => $data
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Specific Data Not found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['create_OutstandingAthlete'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);
    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);
    $organizerName = mysqli_real_escape_string($con, $_POST['organizerName']);
    $coachName = mysqli_real_escape_string($con, $_POST['coachName']);
    $sports = mysqli_real_escape_string($con, $_POST['sports']);
    $dateIssued = mysqli_real_escape_string($con, $_POST['dateIssued']);
    $convertedhearingDate = date_create(mysqli_real_escape_string($con, $_POST['dateIssued']));
    $formatted = date_format($convertedhearingDate, "F Y");
    $formatted1 = date_format($convertedhearingDate, "d");


    if ($student_id == NULL || $sports == NULL ||  $coachName == NULL ||  $organizerName == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "SELECT * FROM `outstanding_athlete` WHERE student_id = '$student_id' AND sports = '$sports';";

        $select = mysqli_query($con, $query);
        if (mysqli_num_rows($select) === 1) {
            $res = [
                'status' => 401,
                'message' => 'This Student is already Added',
            ];
            echo json_encode($res);
            return;
        }

        $query = "INSERT INTO `outstanding_athlete`(
            `student_id`,
            `coach_name`,
            `organizer_name`,
            `sports`,
            `date_issued`
        )
        VALUES(
            '$student_id',
            '$coachName',
            '$organizerName',
            '$sports',
            '$dateIssued'
        );";

        $query_run = mysqli_query($con, $query);
        $last_id = mysqli_insert_id($con);

        $data = [
            'student_name_field' => $studentName,
            'student_no' => $student_no,
            'sports_name_field' => $sports,
            'date_awarded_field' => "Presented on " . $formatted1 . " day of " . $formatted . "",
            'organizer_name_field' => $organizerName,
            'coach_name_field' => $coachName,
            'last_inserted_id' => $last_id
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateOutstandingAthlete($data);

        if ($response && $query_run) {
            $user_id = $_SESSION['id'];
            $description = "Created data Primary key:" . $last_id;
            $type = "Outstanding Athlete";
            $date = date('Y-m-d H:i:s');

            $query = "INSERT INTO `syslogs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
            $response = mysqli_query($con, $query);

            if ($response) {
                $res = [
                    'status' => 200,
                    'message' => 'Successfully Created',
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
                'message' => 'Data Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['update_OutstandingAthlete'])) {
    $athlete_id = mysqli_real_escape_string($con, $_POST['athlete_id']);
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);
    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);
    $organizerName = mysqli_real_escape_string($con, $_POST['organizerName']);
    $coachName = mysqli_real_escape_string($con, $_POST['coachName']);
    $sports = mysqli_real_escape_string($con, $_POST['sports']);
    $dateIssued = mysqli_real_escape_string($con, $_POST['dateIssued']);
    $convertedhearingDate = date_create(mysqli_real_escape_string($con, $_POST['dateIssued']));
    $formatted = date_format($convertedhearingDate, "F Y");
    $formatted1 = date_format($convertedhearingDate, "d");

    if ($student_id == NULL || $sports == NULL ||  $coachName == NULL ||  $organizerName == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "UPDATE
            `outstanding_athlete`
        SET
            `coach_name` = '$coachName',
            `organizer_name` = '$organizerName',
            `sports` = '$sports',
            `date_issued` = '$dateIssued'
        WHERE id = '$athlete_id'";

        $query_run = mysqli_query($con, $query);

        $data = [
            'student_name_field' => $studentName,
            'student_no' => $student_no,
            'sports_name_field' => $sports,
            'date_awarded_field' => "Presented on " . $formatted1 . " day of " . $formatted . "",
            'organizer_name_field' => $organizerName,
            'coach_name_field' => $coachName,
            'last_inserted_id' => $athlete_id
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateOutstandingAthlete($data);

        if ($response && $query_run) {
            $user_id = $_SESSION['id'];
            $description = "Updated data Primary key:" . $athlete_id;
            $type = "Outstanding Athlete";
            $date = date('Y-m-d H:i:s');

            $query = "INSERT INTO `syslogs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
            $response = mysqli_query($con, $query);

            if ($response) {
                $res = [
                    'status' => 200,
                    'message' => 'Successfully Updated',
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
                'message' => 'Not Updated',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['delete_OutstandingAthlete'])) {
    $athlete_id = mysqli_real_escape_string($con, $_POST['delete_athlete_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['delete_student_id']);

    $filename =  $student_no . '_' . $athlete_id . '.pdf';
    unlink('../../assets/docs/processed/outstanding-athlete/' . $filename);

    $query = "DELETE FROM `outstanding_athlete` WHERE id = '$athlete_id'";
    $query_run = mysqli_query($con, $query);

    if ($query) {
        $user_id = $_SESSION['id'];
        $description = "Deleted data Primary key:" . $athlete_id;
        $type = "Outstanding Athlete";
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO `syslogs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
        $response = mysqli_query($con, $query);

        if ($response) {
            $res = [
                'status' => 200,
                'message' => 'Successfully Deleted',
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
            'message' => 'Data is not Been Delete'
        ];
        echo json_encode($res);
        return;
    }
}
