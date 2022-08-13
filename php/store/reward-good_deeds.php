<?php

use Classes\generatePDF;

require '../../database/database.php';

require_once '../../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['goodDeeds_id'])) {
    $goodDeeds_id = mysqli_real_escape_string($con, $_GET['goodDeeds_id']);

    $query = "SELECT
        kindly_acts.*,
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
        kindly_acts
    JOIN students ON kindly_acts.student_id = students.id
    JOIN programs ON students.program_id = programs.id 
    WHERE kindly_acts.id ='$goodDeeds_id'";

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


if (isset($_POST['create_GoodDeeds'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);

    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);

    $itemReturned = mysqli_real_escape_string($con, $_POST['itemReturned']);

    $dateIssued = mysqli_real_escape_string($con, $_POST['dateIssued']);

    $convertedhearingDate = date_create(mysqli_real_escape_string($con, $_POST['dateIssued']));
    $formatted = date_format($convertedhearingDate, "F d Y");


    if ($student_id == NULL || $itemReturned == NULL ||  $dateIssued == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "SELECT * FROM `kindly_acts` WHERE student_id = '$student_id' AND kindly_act = '$itemReturned';";

        $select = mysqli_query($con, $query);
        if (mysqli_num_rows($select) === 1) {
            $res = [
                'status' => 401,
                'message' => 'This Student is already Issued',
            ];
            echo json_encode($res);
            return;
        }

        $query = " INSERT INTO `kindly_acts`(
            `student_id`,
            `date_issued`,
            `kindly_act`
        )
        VALUES(
            '$student_id',
            '$dateIssued',
            '$itemReturned'
        );";

        $query_run = mysqli_query($con, $query);
        $last_id = mysqli_insert_id($con);

        $data = [
            'student_name_field' => $studentName,
            'returned_item_field' => $itemReturned,
            'student_no' => $student_no,
            'date_field' => $formatted,
            'last_inserted_id' => $last_id
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateGoodDeeds($data);

        if ($response && $query_run) {
            $res = [
                'status' => 200,
                'message' => 'Created Successfully',
                'console' => $query_run,
            ];
            echo json_encode($res);
            return;
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

if (isset($_POST['update_GoodDeeds'])) {
    $goodDeeds_id = mysqli_real_escape_string($con, $_POST['goodDeeds_id']);

    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['student_no']);

    $studentName = mysqli_real_escape_string($con, $_POST['StudentFullName']);

    $itemReturned = mysqli_real_escape_string($con, $_POST['itemReturned']);

    $dateIssued = mysqli_real_escape_string($con, $_POST['dateIssued']);

    $convertedhearingDate = date_create(mysqli_real_escape_string($con, $_POST['dateIssued']));
    $formatted = date_format($convertedhearingDate, "F d Y");


    if ($student_id == NULL || $itemReturned == NULL ||  $dateIssued == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "UPDATE
            `kindly_acts`
        SET
            student_id = '$student_id',
            date_issued = '$dateIssued',
            kindly_act = '$itemReturned'
        WHERE id = '$goodDeeds_id'";

        $query_run = mysqli_query($con, $query);

        $data = [
            'student_name_field' => $studentName,
            'returned_item_field' => $itemReturned,
            'student_no' => $student_no,
            'date_field' => $formatted,
            'last_inserted_id' => $goodDeeds_id
        ];

        $pdf = new GeneratePDF;
        $response = $pdf->generateGoodDeeds($data);

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
                'message' => 'Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['delete_GoodDeeds'])) {
    $goodDeeds_id = mysqli_real_escape_string($con, $_POST['delete_goodDeeds_id']);
    $student_no = mysqli_real_escape_string($con, $_POST['delete_student_id']);

    $filename =  $student_no . '_' . $goodDeeds_id . '.pdf';
    unlink('../../assets/docs/processed/good-deeds/' . $filename);


    $query = "DELETE FROM `kindly_acts` WHERE id = '$goodDeeds_id'";
    $query_run = mysqli_query($con, $query);

    if ($query) {
        $res = [
            'status' => 200,
            'message' => 'Successfully Deleted',
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Is not Been Delete'
        ];
        echo json_encode($res);
        return;
    }
}
