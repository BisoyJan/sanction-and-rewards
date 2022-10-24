<?php

use Classes\generatePDF;

require '../../database/database.php';

require_once '../../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['leadership_id'])) {
    $leadership_id = mysqli_real_escape_string($con, $_GET['leadership_id']);

    $query = "SELECT
        leaderships.*,
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
        leaderships
    JOIN students ON leaderships.student_id = students.id
    JOIN programs ON students.program_id = programs.id 
    WHERE leaderships.id ='$leadership_id'";

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

if (isset($_POST['create_Leadership'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);

    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);

    $EventTitle = mysqli_real_escape_string($con, $_POST['EventTitle']);

    $dateIssued = mysqli_real_escape_string($con, $_POST['dateIssued']);

    $convertedhearingDate = date_create(mysqli_real_escape_string($con, $_POST['dateIssued']));
    $formatted = date_format($convertedhearingDate, "F d Y");


    if ($student_id == NULL || $EventTitle == NULL ||  $dateIssued == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "SELECT * FROM `leaderships` WHERE student_id = '$student_id' AND event_title = '$EventTitle';";

        $select = mysqli_query($con, $query);
        if (mysqli_num_rows($select) === 1) {
            $res = [
                'status' => 401,
                'message' => 'This Student is already Added',
            ];
            echo json_encode($res);
            return;
        }

        $query = "INSERT INTO `leaderships`(
            `student_id`,
            `date_issued`,
            `event_title`
        )
        VALUES(
            '$student_id',
            '$dateIssued',
            '$EventTitle'
        );";

        $query_run = mysqli_query($con, $query);
        $last_id = mysqli_insert_id($con);

        $data = [
            'student_name_field' => $studentName,
            'details_field' => "In recognition of your excellent leadership,awarded on " . $formatted . ", during the " . $EventTitle . " by the members of the Leyte Normal University",
            'student_no' => $student_no,
            'last_inserted_id' => $last_id
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateLeadership($data);

        if ($response && $query_run) {
            $user_id = $_SESSION['id'];
            $description = "Created data Primary key:" . $last_id;
            $type = "Leadership";
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
                'message' => 'Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['update_Leadership'])) {
    $leadership_id = mysqli_real_escape_string($con, $_POST['leadership_id']);

    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);
    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);
    $EventTitle = mysqli_real_escape_string($con, $_POST['EventTitle']);
    $dateIssued = mysqli_real_escape_string($con, $_POST['dateIssued']);
    $convertedhearingDate = date_create(mysqli_real_escape_string($con, $_POST['dateIssued']));
    $formatted = date_format($convertedhearingDate, "F d Y");


    if ($student_id == NULL || $EventTitle == NULL ||  $dateIssued == NULL || $leadership_id == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "UPDATE
            `leaderships`
        SET
            student_id = '$student_id',
            date_issued = '$dateIssued',
            event_title = '$EventTitle'
        WHERE id = '$leadership_id'";

        $query_run = mysqli_query($con, $query);

        $data = [
            'student_name_field' => $studentName,
            'details_field' => "In recognition of your excellent leadership, awarded on " . $formatted . ", during the " . $EventTitle . " by the members of the Leyte Normal University",
            'student_no' => $student_no,
            'last_inserted_id' => $leadership_id
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateLeadership($data);

        if ($response && $query_run) {
            $user_id = $_SESSION['id'];
            $description = "Updated data Primary key:" . $leadership_id;
            $type = "Leadership";
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
                'message' => 'Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['delete_Leadership'])) {
    $leadership_id = mysqli_real_escape_string($con, $_POST['delete_leadership_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['delete_student_id']);

    $filename =  $student_no . '_' . $leadership_id . '.pdf';
    unlink('../../assets/docs/processed/leadership/' . $filename);


    $query = "DELETE FROM `leaderships` WHERE id = '$leadership_id'";
    $query_run = mysqli_query($con, $query);

    if ($query) {
        $user_id = $_SESSION['id'];
        $description = "Deleted data Primary key:" . $leadership_id;
        $type = "Leadership";
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
            'message' => 'Leadership is not Been Delete'
        ];
        echo json_encode($res);
        return;
    }
}
