<?php

require '../../database/database.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['student_id'])) {
    $student_id = mysqli_real_escape_string($con, $_GET['student_id']);

    $query = "SELECT
        students.*,
        programs.program_name as program,
        programs.abbreviation,
        colleges.abbreviation as college
    FROM
        students
    JOIN programs ON students.program_id = programs.id
    JOIN colleges on programs.college_id = colleges.id WHERE students.id ='$student_id'";
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

if (isset($_GET['student_no'])) {
    $student_id = mysqli_real_escape_string($con, $_GET['student_no']);

    $query = "SELECT
        students.*,
        programs.program_name as program,
        programs.abbreviation,
        colleges.abbreviation as college
    FROM
        students
    JOIN programs ON students.program_id = programs.id
    JOIN colleges on programs.college_id = colleges.id WHERE students.student_no LIKE '$student_id%'";
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


if (isset($_POST['create_Student'])) {
    $studentNo = mysqli_real_escape_string($con, $_POST['studentNo']);
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($con, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $section = mysqli_real_escape_string($con, $_POST['section']);
    $program = mysqli_real_escape_string($con, $_POST['program']);


    if ($firstName == NULL || $middleName == NULL || $lastName == NULL || $age == NULL || $gender == NULL || $email == NULL || $section == NULL || $program == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "SELECT * FROM students WHERE binary student_no LIKE '%$studentNo%' OR email LIKE '%$email%'";
        $select = mysqli_query($con, $query);
        if (mysqli_num_rows($select) === 1) {

            $studentInfo = mysqli_fetch_array($select);

            if ($studentNo == $studentInfo["student_no"]) {
                $res = [
                    'status' => 401,
                    'message' => 'Student Number already existed',
                ];
                echo json_encode($res);
                return;
            } elseif ($email == $studentInfo["email"]) {
                $res = [
                    'status' => 401,
                    'message' => 'Student Email already existed',
                ];
                echo json_encode($res);
                return;
            }
        }

        $query = "INSERT INTO students(
            student_no,
            first_name,
            middle_name,
            last_name,
            age,
            gender,
            section,
            email,
            program_id
        )
        VALUES(
            '$studentNo',
            '$firstName',
            '$middleName',
            '$lastName',
            '$age',
            '$gender',
            '$section',
            '$email',
            '$program'
        )";
        $query_run = mysqli_query($con, $query);
        $last_id = mysqli_insert_id($con);

        if ($query_run) {

            $user_id = $_SESSION['id'];
            $description = "Created data Primary key:" . $last_id;
            $type = "Students";
            $date = date('Y-m-d H:i:s');

            $query = "INSERT INTO `syslogs`(`user_id`, `description`,`section`, `date`) VALUES ('$user_id','$description','$type','$date')";
            $response = mysqli_query($con, $query);

            if ($response) {
                $res = [
                    'status' => 200,
                    'message' => 'Student Successfully Created',
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
                'message' => 'Student Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['update_Student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $studentNo = mysqli_real_escape_string($con, $_POST['studentNo']);
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($con, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $section = mysqli_real_escape_string($con, $_POST['section']);
    $program = mysqli_real_escape_string($con, $_POST['program']);

    if ($firstName == NULL || $middleName == NULL || $lastName == NULL || $age == NULL || $gender == NULL || $email == NULL || $section == NULL || $program == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "UPDATE `students` SET `student_no`='$studentNo',`first_name`='$firstName',`middle_name`='$middleName',`last_name`='$lastName',`age`='$age',`gender`='$gender',`section`='$section',`email`='$email',`program_id`='$program' WHERE id = '$student_id'";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {

            $user_id = $_SESSION['id'];
            $description = "Updated data Primary key:" . $student_id;
            $type = "Students";
            $date = date('Y-m-d H:i:s');

            $query = "INSERT INTO `syslogs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
            $response = mysqli_query($con, $query);

            if ($response) {
                $res = [
                    'status' => 200,
                    'message' => 'Student Successfully Updated',
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
                'message' => 'Student is not Been Updated'
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['delete_Student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student_id']);

    $query = "DELETE FROM `students` WHERE id = '$student_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $user_id = $_SESSION['id'];
        $description = "Deleted data Primary key:" . $student_id;
        $type = "Students";
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO `syslogs`(`user_id`, `description`,`section`, `date`) VALUES ('$user_id','$description','$type','$date')";
        $response = mysqli_query($con, $query);

        if ($response) {
            $res = [
                'status' => 200,
                'message' => 'Student Successfully Deleted',
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
            'message' => 'Student is not Been Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
