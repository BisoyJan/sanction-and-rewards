<?php
session_start();
require '../database/database.php';

//For console log
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if ($username == NULL || $password == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) === 1) {
            $row = mysqli_fetch_assoc($query_run);
            if (is_array($row)) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['middle_name'] = $row['middle_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['type'] = $row['type'];
                $_SESSION['notify'] = 1; // Show toastr when login 
                $res = [
                    'status' => 200,
                    'message' => 'Successfully Login',
                    'console' => $row
                ];
                echo json_encode($res);
                return;
            } else {

                $res = [
                    'status' => 401,
                    'message' => 'Invalid Credentials',
                    'console' => $row
                ];
                echo json_encode($res);
                return;
            }
        } else {

            $res = [
                'status' => 401,
                'message' => 'Invalid Credentials',
                'console' => $row
            ];
            echo json_encode($res);
            return;
        }
    }
}
