<?php

require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['semester_id'])) {
    $semester_id = mysqli_real_escape_string($con, $_GET['semester_id']);

    $query = "SELECT * FROM `semesters` WHERE id ='$semester_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $data = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Specific Semester fetched Successfully',
            'data' => $data
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Specific Semester Not found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['create_Semester'])) {
    $firstSemStarting = mysqli_real_escape_string($con, $_POST['1stSemStarting']);
    $firstSemEnding = mysqli_real_escape_string($con, $_POST['1stSemEnding']);
    $secondSemStarting = mysqli_real_escape_string($con, $_POST['2ndSemStarting']);
    $secondSemEnding = mysqli_real_escape_string($con, $_POST['2ndSemEnding']);


    if ($firstSemStarting == NULL || $firstSemEnding == NULL || $secondSemStarting == NULL || $secondSemEnding == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $year1 = date('Y', strtotime($firstSemStarting));
        $year2 = date('Y', strtotime($secondSemEnding));

        $schoolyear = $year1 . '-' . $year2;

        $query = "SELECT * FROM `semesters` WHERE school_year = $schoolyear";
        $select = mysqli_query($con, $query);
        if (mysqli_num_rows($select) === 1) {

            if ($studentNo) {
                $res = [
                    'status' => 401,
                    'message' => 'Semester already existed',
                ];
                echo json_encode($res);
                return;
            }
        }
        $query = "INSERT INTO `semesters`(
            first_starting,
            first_ending,
            second_starting,
            second_ending,
            school_year
        )
        VALUES(
            '$firstSemStarting',
            '$firstSemEnding',
            '$secondSemStarting',
            '$secondSemEnding',
            '$schoolyear'
        )";
        $query_run = mysqli_query($con, $query);
        $last_id = mysqli_insert_id($con);

        if ($query_run) {

            $user_id = $_SESSION['id'];
            $description = "Created data Primary key:" . $last_id;
            $type = "Semester";
            $date = date('Y-m-d H:i:s');

            $query = "INSERT INTO `logs`(`user_id`, `description`,`section`, `date`) VALUES ('$user_id','$description','$type','$date')";
            $response = mysqli_query($con, $query);

            if ($response) {
                $res = [
                    'status' => 200,
                    'message' => 'Semester Successfully Created',
                    'console' => $response,
                ];
                echo json_encode($res);
                return;
            } else {
                $res = [
                    'status' => 401,
                    'message' => 'Something wrong with the logs system',
                    'console' => $response
                ];
                echo json_encode($res);
                return;
            }
        } else {
            $res = [
                'status' => 500,
                'message' => 'Semester Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['update_Semester'])) {
    $semester_id = mysqli_real_escape_string($con, $_POST['semester_id']);
    $firstSemStarting = mysqli_real_escape_string($con, $_POST['1stSemStarting']);
    $firstSemEnding = mysqli_real_escape_string($con, $_POST['1stSemEnding']);
    $secondSemStarting = mysqli_real_escape_string($con, $_POST['2ndSemStarting']);
    $secondSemEnding = mysqli_real_escape_string($con, $_POST['2ndSemEnding']);

    $year1 = date('Y', strtotime($firstSemStarting));
    $year2 = date('Y', strtotime($secondSemEnding));

    $schoolyear = $year1 . '-' . $year2;

    if ($firstSemStarting == NULL || $firstSemEnding == NULL || $secondSemStarting == NULL || $secondSemEnding == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "UPDATE
        `semesters`
    SET
        `first_starting` = '$firstSemStarting',
        `first_ending` = '$firstSemEnding',
        `second_starting` = '$secondSemStarting',
        `second_ending` = '$secondSemEnding',
        `school_year` = '$schoolyear'
    
    WHERE id = '$semester_id'";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {

            $user_id = $_SESSION['id'];
            $description = "Updated data Primary key:" . $semester_id;
            $type = "Semester";
            $date = date('Y-m-d H:i:s');

            $query = "INSERT INTO `logs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
            $response = mysqli_query($con, $query);

            if ($response) {
                $res = [
                    'status' => 200,
                    'message' => 'Semester Successfully Updated',
                    'console' => $query_run,
                ];
                echo json_encode($res);
                return;
            } else {
                $res = [
                    'status' => 401,
                    'message' => 'Something wrong with the logs system',
                    'console' => $response
                ];
                echo json_encode($res);
                return;
            }
        } else {
            $res = [
                'status' => 500,
                'message' => 'Semester is not Been Updated'
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['delete_Semester'])) {
    $semester_id = mysqli_real_escape_string($con, $_POST['delete_semester_id']);

    $query = "DELETE FROM `semesters` WHERE id = '$semester_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $user_id = $_SESSION['id'];
        $description = "Deleted data Primary key:" . $semester_id;
        $type = "Semester";
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO `logs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
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
            'message' => 'Semester is not Been Delete'
        ];
        echo json_encode($res);
        return;
    }
}
