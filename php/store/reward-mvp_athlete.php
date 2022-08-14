<?php

use Classes\generatePDF;

require '../../database/database.php';

require_once '../../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['MVPAthlete_id'])) {
    $MVPAthlete_id = mysqli_real_escape_string($con, $_GET['MVPAthlete_id']);

    $query = "SELECT
        mvp_athletes.*,
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
    mvp_athletes
    JOIN students ON mvp_athletes.student_id = students.id
    JOIN programs ON students.program_id = programs.id 
    WHERE mvp_athletes.id ='$MVPAthlete_id'";

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

if (isset($_POST['create_MVPAthlete'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);
    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);
    $gender  = mysqli_real_escape_string($con, $_POST['Gender']);
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

        $query = "SELECT * FROM `mvp_athletes` WHERE student_id = '$student_id' AND sports = '$sports';";

        $select = mysqli_query($con, $query);
        if (mysqli_num_rows($select) === 1) {
            $res = [
                'status' => 401,
                'message' => 'This Student is already Added',
            ];
            echo json_encode($res);
            return;
        }

        $query = "INSERT INTO `mvp_athletes`(
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

        if ($gender === 'Male') {
            $gender = 'his';
        } else {
            $gender = 'her';
        };

        $data = [
            'student_name_field' => $studentName,
            'student_no' => $student_no,
            'award_name_field' => "For " . $gender . " exemplary performance this season as a member of Leyte Normal University " . $sports . " Team, earning him the Most Valuable Player (MVP) Status.",
            'date_given_field' => "Awarded this on " . $formatted1 . " day of " . $formatted . " at Leyte Normal University Tacloban City Philippines",
            'organizer_name_field' => $organizerName,
            'coach_name_field' => $coachName,
            'last_inserted_id' => $last_id
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateMVPAthlete($data);

        if ($response && $query_run) {
            $res = [
                'status' => 200,
                'message' => 'Data Created Successfully',
                'console' => $query_run,
            ];
            echo json_encode($res);
            return;
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

if (isset($_POST['update_MVPAthlete'])) {
    $MVPAthlete_id = mysqli_real_escape_string($con, $_POST['MVPAthlete_id']);
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);
    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);
    $gender  = mysqli_real_escape_string($con, $_POST['Gender']);
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
            `mvp_athletes`
        SET
            `coach_name` = '$coachName',
            `organizer_name` = '$organizerName',
            `sports` = '$sports',
            `date_issued` = '$dateIssued'
        WHERE id = '$MVPAthlete_id'";

        $query_run = mysqli_query($con, $query);

        if ($gender === 'Male') {
            $gender = 'his';
        } else {
            $gender = 'her';
        };

        $data = [
            'student_name_field' => $studentName,
            'student_no' => $student_no,
            'award_name_field' => "For " . $gender . " exemplary performance this season as a member of Leyte Normal University " . $sports . " Team, earning him the Most Valuable Player (MVP) Status.",
            'date_given_field' => "Awarded this on " . $formatted1 . " day of " . $formatted . " at Leyte Normal University Tacloban City Philippines",
            'organizer_name_field' => $organizerName,
            'coach_name_field' => $coachName,
            'last_inserted_id' => $MVPAthlete_id
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateMVPAthlete($data);

        if ($response && $query_run) {
            $res = [
                'status' => 200,
                'message' => 'Updated Successfully',
                'console' => $query_run,
            ];
            echo json_encode($res);
            return;
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

if (isset($_POST['delete_MVPAthlete'])) {
    $MVPAthlete_id = mysqli_real_escape_string($con, $_POST['delete_MVPAthlete_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['delete_student_id']);

    $filename =  $student_no . '_' . $MVPAthlete_id . '.pdf';
    unlink('../../assets/docs/processed/mvp-athlete/' . $filename);

    $query = "DELETE FROM `mvp_athletes` WHERE id = '$MVPAthlete_id'";
    $query_run = mysqli_query($con, $query);

    if ($query) {
        $res = [
            'status' => 200,
            'message' => 'Data Successfully Delete',
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Data is not Been Delete'
        ];
        echo json_encode($res);
        return;
    }
}
