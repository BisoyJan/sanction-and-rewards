<?php
require '../../database/database.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['offense_id'])) {
    $offense_id = mysqli_real_escape_string($con, $_GET['offense_id']);

    $query = "SELECT
        violations.*,
        offenses.offense
    FROM
        violations
    JOIN offenses ON violations.offenses_id = offenses.id
    WHERE
        violations.id = '$offense_id'";

    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) == 1) {

        $offense = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Specific Offense fetched Successfully',
            'data' => $offense
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

if (isset($_POST['create_Offense'])) {
    $offenseType =  mysqli_real_escape_string($con, $_POST['offenseType']);
    $offenseCode =  mysqli_real_escape_string($con, $_POST['offenseCode']);
    $offenseDescription =  mysqli_real_escape_string($con, $_POST['offenseDescription']);

    if ($offenseType == NULL || $offenseCode == NULL || $offenseDescription == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "SELECT * FROM violations WHERE code LIKE '%$offenseCode'";
        $select = mysqli_query($con, $query);

        if (mysqli_num_rows($select) === 1) {
            $res = [
                'status' => 401,
                'message' => 'Offense Code already existed',
                'console' => $select
            ];
            echo json_encode($res);
            return;
        }

        $query = "INSERT INTO violations(offenses_id, code, violation) VALUES ('$offenseType','$offenseCode','$offenseDescription')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Offense Created Successfully',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Offense Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['update_Offense'])) {
    $id = mysqli_real_escape_string($con, $_POST['offense_id']);
    $offenseType =  mysqli_real_escape_string($con, $_POST['offenseType']);
    $offenseCode =  mysqli_real_escape_string($con, $_POST['offenseCode']);
    $offenseDescription =  mysqli_real_escape_string($con, $_POST['offenseDescription']);

    if ($id == NULL || $offenseType == NULL || $offenseCode == NULL || $offenseDescription == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {
        $query = "UPDATE `violations` SET `offenses_id`='$offenseType',`code`='$offenseCode',`violation`='$offenseDescription' WHERE id = '$id'";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Offense Successfully Updated'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Offense is not Been Updated'
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['delete_Offense'])) {
    $program_id = mysqli_real_escape_string($con, $_POST['delete_offense_id']);

    $query = "DELETE FROM `violations` WHERE id = '$program_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Offense Successfully Delete',
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Offense is not Been Delete'
        ];
        echo json_encode($res);
        return;
    }
}
