<?php
require '../../database/database.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['program_id'])) {
    $program_id = mysqli_real_escape_string($con, $_GET['program_id']);

    $query = "SELECT * FROM programs WHERE id ='$program_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $account = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Specific account fetched Successfully',
            'data' => $account
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Specific account Not found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['create_Program'])) {
    $abbreviation =  mysqli_real_escape_string($con, $_POST['abbreviation']);
    $college =  mysqli_real_escape_string($con, $_POST['college']);
    $program =  mysqli_real_escape_string($con, $_POST['program']);

    if ($abbreviation == NULL || $college == NULL || $program == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "SELECT * FROM programs WHERE binary abbreviation LIKE '%$abbreviation%'";
        $select = mysqli_query($con, $query);
        if (mysqli_num_rows($select) === 1) {
            $res = [
                'status' => 401,
                'message' => 'Program already existed',
                'console' => $select
            ];
            echo json_encode($res);
            return;
        }

        $query = "INSERT INTO programs (abbreviation, program_name, college_id) VALUES ('$abbreviation','$program','$college')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Program Created Successfully',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Program Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['update_account'])) {
    $id = mysqli_real_escape_string($con, $_POST['program_id']);
    $abbreviation = mysqli_real_escape_string($con, $_POST['abbreviation']);
    $college_id = mysqli_real_escape_string($con, $_POST['college']);
    $program = mysqli_real_escape_string($con, $_POST['program']);


    if ($id == NULL || $abbreviation == NULL || $college_id == NULL || $program == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {
        $query = "UPDATE `programs` SET `abbreviation`='$abbreviation', `program_name`='$program', `college_id`='$college_id' WHERE id = '$id'";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Program Successfully Updated'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Program is not Been Updated'
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['delete_program'])) {
    $program_id = mysqli_real_escape_string($con, $_POST['delete_program_id']);

    $query = "DELETE FROM `programs` WHERE id = '$program_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Program Successfully Delete',
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Program is not Been Delete'
        ];
        echo json_encode($res);
        return;
    }
}
