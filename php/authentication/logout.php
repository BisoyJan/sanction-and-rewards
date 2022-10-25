<?php
include('../../database/database.php');


$user_id = $_SESSION['id'];
$description = "User Logout to the system ";
$date = date('Y-m-d H:i:s');

$query = "INSERT INTO `syslogs`(`user_id`, `description`, `date`) VALUES ('$user_id','$description','$date')";
$query_run = mysqli_query($con, $query);

session_unset();
session_destroy();

header("Location: ../../index.php");
