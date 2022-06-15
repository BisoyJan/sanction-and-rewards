<?php
require '../database/database.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['create_Account'])) {
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($con, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $userName = mysqli_real_escape_string($con, $_POST['userName']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $userType = mysqli_real_escape_string($con, $_POST['userType']);


    if ($firstName == NULL || $middleName == NULL || $lastName == NULL || $userName == NULL || $password == NULL || $userType == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "SELECT * FROM users WHERE binary username LIKE '%$userName%'";
        $select = mysqli_query($con, $query);
        if (mysqli_num_rows($select) === 1) {
            $res = [
                'status' => 401,
                'message' => 'Username already existed',
                'console' => $select
            ];
            echo json_encode($res);
            return;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, password, type, first_name, middle_name, last_name) VALUES ('$userName','$hash','$userType','$firstName','$middleName','$lastName')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Account Created Successfully',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Account Not Created',
                'console' => $query_run
            ];
            echo json_encode($res);
            return;
        }
    }
}
