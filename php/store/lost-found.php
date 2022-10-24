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

if (isset($_GET['lost-found-id'])) {
    $found_id = mysqli_real_escape_string($con, $_GET['lost-found-id']);

    $query = "SELECT * FROM properties WHERE id ='$found_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        $lost_found = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Specific Data fetched Successfully',
            'data' => $lost_found
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

if (isset($_POST['create_Lost-Found'])) {
    $returnee_id = mysqli_real_escape_string($con, $_POST['returnee_id']);
    $retrieval_id = mysqli_real_escape_string($con, $_POST['retrieval_id']);
    $itemType = mysqli_real_escape_string($con, $_POST['itemType']);
    $itemDescription = mysqli_real_escape_string($con, $_POST['itemDescription']);

    if (mysqli_real_escape_string($con, $_POST['inlineRadioOptions']) === "Surrendered") {
        $radioSelect = "Surrendered";
    } else {
        $radioSelect = "Retrieved";
    }

    $surrenderedDate =  mysqli_real_escape_string($con, $_POST['surrenderedDate']);
    $foundDate =  mysqli_real_escape_string($con, $_POST['foundDate']);
    $retrievalDate =  mysqli_real_escape_string($con, $_POST['retrievalDate']);

    $img = $_FILES["itemImage"]["name"]; //stores the original filename from the client
    $tmp = $_FILES["itemImage"]["tmp_name"]; //stores the name of the designated temporary file
    $errorimg = $_FILES["itemImage"]["error"]; //stores any error code resulting from the transfer

    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
    $path = '../../assets/images/uploads/'; // upload directory

    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // can upload same image using rand function
    $final_image = rand(1000, 1000000) . $img;

    if ($errorimg > 0) {
        $res = [
            'status' => 401,
            'message' => 'Something Wrong with the Image',
        ];
        echo json_encode($res);
        return;
    }

    if (($_FILES['itemImage']['size'] >= 10485760) || ($_FILES["itemImage"]["size"] == 0)) {
        $res = [
            'status' => 401,
            'message' => 'The Image size is more than 10 MB / please insert Image',
        ];
        echo json_encode($res);
        return;
    }

    if (in_array($ext, $valid_extensions)) {
        $path = $path . strtolower($final_image);
        if (move_uploaded_file($tmp, $path)) {

            $query = "INSERT INTO `properties` (`student_id`, `retrieval_id`, `date_found`, `date_retrieved`, `date_surrendered`, `type`, `description`, `picture`, `remarks`) VALUES ('$returnee_id', NULLIF('$retrieval_id', ''), NULLIF('$foundDate', ''), NULLIF('$retrievalDate', ''), '$surrenderedDate','$itemType','$itemDescription','$path','$radioSelect')";
            $query_run = mysqli_query($con, $query);
            $last_id = mysqli_insert_id($con);

            if ($query_run) {

                $user_id = $_SESSION['id'];
                $description = "Created data Primary key:" . $last_id;
                $type = "Lost and Found";
                $date = date('Y-m-d H:i:s');

                $query = "INSERT INTO `syslogs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
                $response = mysqli_query($con, $query);

                if ($response) {
                    $res = [
                        'status' => 200,
                        'message' => 'Successfully Created',
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
                    'message' => 'Something wrong'
                ];
                echo json_encode($res);
                return;
            }
        }
    } else {
        $res = [
            'status' => 500,
            'message' => 'Image Format Not Valid'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['update_Lost-Found'])) {
    $lostFoundID = mysqli_real_escape_string($con, $_POST['lost-foundID']);
    $returnee_id = mysqli_real_escape_string($con, $_POST['returnee_id']);
    $retrieval_id = mysqli_real_escape_string($con, $_POST['retrieval_id']);
    $itemType = mysqli_real_escape_string($con, $_POST['itemType']);
    $itemDescription = mysqli_real_escape_string($con, $_POST['itemDescription']);

    if (mysqli_real_escape_string($con, $_POST['inlineRadioOptions']) === "Surrendered") {
        $radioSelect = "Surrendered";
    } else {
        $radioSelect = "Retrieved";
    }

    $surrenderedDate =  mysqli_real_escape_string($con, $_POST['surrenderedDate']);
    $foundDate =  mysqli_real_escape_string($con, $_POST['foundDate']);
    $retrievalDate =  mysqli_real_escape_string($con, $_POST['retrievalDate']);

    //This will delete the old image
    $oldImage = mysqli_real_escape_string($con, $_POST['oldImage']);


    $img = $_FILES["itemImage"]["name"]; //stores the original filename from the client
    $tmp = $_FILES["itemImage"]["tmp_name"]; //stores the name of the designated temporary file
    $errorimg = $_FILES["itemImage"]["error"]; //stores any error code resulting from the transfer

    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
    $path = '../../assets/images/uploads/'; // upload directory

    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // can upload same image using rand function
    $final_image = rand(1000, 1000000) . $img;


    if ($errorimg > 0) {
        $res = [
            'status' => 401,
            'message' => 'Something Wrong with the Image',
        ];
        echo json_encode($res);
        return;
    }

    if (($_FILES['itemImage']['size'] >= 10485760) || ($_FILES["itemImage"]["size"] == 0)) {
        $res = [
            'status' => 401,
            'message' => 'The Image size is more than 10 MB / please insert Image',
        ];
        echo json_encode($res);
        return;
    }

    if (in_array($ext, $valid_extensions)) {
        $path = $path . strtolower($final_image);
        if (move_uploaded_file($tmp, $path)) {

            $query = "UPDATE `properties` SET `student_id`='$returnee_id',`retrieval_id`='$retrieval_id',`date_found`= NULLIF('$foundDate', ''),`date_retrieved`=NULLIF('$retrievalDate', ''),`date_surrendered`= NULLIF('$surrenderedDate', ''),`type`='$itemType',`description`='$itemDescription',`picture`='$path',`remarks`='$radioSelect' WHERE id = '$lostFoundID'";
            $query_run = mysqli_query($con, $query);

            if ($query_run) {

                $user_id = $_SESSION['id'];
                $description = "Updated data Primary key:" . $offense_id;
                $type = "Lost and Found";
                $date = date('Y-m-d H:i:s');

                $query = "INSERT INTO `syslogs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
                $response = mysqli_query($con, $query);

                if ($response) {
                    $res = [
                        'status' => 200,
                        'message' => 'Successfully Updated',
                        'console' => $query_run,
                    ];
                    echo json_encode($res);
                    return;
                    unlink($oldImage);
                } else {
                    $res = [
                        'status' => 500,
                        'message' => 'Something wrong with the logs system',
                        'console' => $response
                    ];
                    echo json_encode($res);
                    return;
                    unlink($oldImage);
                }
            } else {
                $res = [
                    'status' => 500,
                    'message' => 'Something wrong'
                ];
                echo json_encode($res);
                return;
                unlink($oldImage);
            }
        }
    } else {
        $res = [
            'status' => 500,
            'message' => 'Image Format Not Valid'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['delete_LostFound'])) {
    $lostFound_id = mysqli_real_escape_string($con, $_POST['delete_LostFound_id']);
    $image = mysqli_real_escape_string($con, $_POST['delete_image_path']);

    unlink($image);

    $query = "DELETE FROM `properties` WHERE id = '$lostFound_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $user_id = $_SESSION['id'];
        $description = "Deleted data Primary key:" . $offense_id;
        $type = "Lost and Found";
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO `syslogs`(`user_id`, `description`,`section`,`date`) VALUES ('$user_id','$description','$type','$date')";
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
            'message' => 'Lost and Found is not Been Delete'
        ];
        echo json_encode($res);
        return;
    }
}
