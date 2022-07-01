<?php
require '../../database/database.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['student_id'])) {
    $student_id = mysqli_real_escape_string($con, $_GET['student_id']);

    $query = "SELECT
        students.*,
        programs.abbreviation,
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

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Student Created Successfully',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
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
            $res = [
                'status' => 200,
                'message' => 'Student Successfully Updated'
            ];
            echo json_encode($res);
            return;
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
        $res = [
            'status' => 200,
            'message' => 'Student Successfully Delete',
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Student is not Been Delete'
        ];
        echo json_encode($res);
        return;
    }
}
