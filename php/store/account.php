<?php
require '../../database/database.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['account_id'])) {
    $account_id = mysqli_real_escape_string($con, $_GET['account_id']);

    $query = "SELECT * FROM users WHERE id ='$account_id'";
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

if (isset($_POST['update_Account'])) {
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($con, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $userName = mysqli_real_escape_string($con, $_POST['userName']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $userType = mysqli_real_escape_string($con, $_POST['userType']);
    $account_id = mysqli_real_escape_string($con, $_POST['account_id']);

    if ($firstName == NULL || $middleName == NULL || $lastName == NULL || $userName == NULL || $password == NULL || $userType == NULL) {

        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET `username`='$userName',`password`='$hash',`type`='$userType',`first_name`='$firstName',`middle_name`='$middleName',`last_name`='$lastName' WHERE id = '$account_id'";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Account Successfully Updated'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Account is not Been Updated'
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['delete_Account'])) {
    $account_id = mysqli_real_escape_string($con, $_POST['delete_account_id']);

    $query = "DELETE FROM `users` WHERE id = '$account_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Account Successfully Delete',
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Account is not Been Delete'
        ];
        echo json_encode($res);
        return;
    }
}
