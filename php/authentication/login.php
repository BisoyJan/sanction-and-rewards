<?php

require '../../database/database.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
    } elseif ($username == "MIS" || $password == "MIS") {
        // need to set season for the MIS
        $_SESSION['id'] = 'MIS';
        $_SESSION['first_name'] = 'MIS';
        $_SESSION['type'] = 'MIS';
        $_SESSION['notify'] = 1;
        $res = [
            'status' => 200,
            'message' => 'Successfully Login',
        ];
        echo json_encode($res);
        return;
    } else {

        $query = "SELECT * FROM users WHERE binary username LIKE '%$username%'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {

            while ($row = mysqli_fetch_array($query_run)) {
                if (password_verify($password, $row["password"])) {
                    //return true;  
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['middle_name'] = $row['middle_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['type'] = $row['type'];
                    $_SESSION['notify'] = 1; // Show toastr when login 

                    $user_id = $_SESSION['id'];
                    $description = "User Login to the system";
                    $date = date('Y-m-d H:i:s');

                    $query = "INSERT INTO `syslogs`(`user_id`, `description`, `date`) VALUES ('$user_id','$description','$date')";
                    $query_run = mysqli_query($con, $query);
                    $res = [
                        'status' => 200,
                        'message' => 'Successfully Login',
                        'data' => $row
                    ];
                    echo json_encode($res);
                    return;
                } else {
                    //return false;  
                    $res = [
                        'status' => 401,
                        'message' => 'Invalid Credentials',
                        'data' => $row
                    ];
                    echo json_encode($res);
                    return;
                }
            }
        } else {

            $res = [
                'status' => 401,
                'message' => 'Invalid Credentials',
            ];
            echo json_encode($res);
            return;
        }
    }
}
