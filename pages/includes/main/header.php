<?php
require '../../database/database.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
if (empty($_SESSION['id'])) :
    header('Location:../../index.php');
endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanction and Rewards</title>

    <!-- MATERIAL ICON -->
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/toastr/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css" />



    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/chart.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@^1"></script> -->
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/moment.min.js"></script>
    <script src="../../assets/toastr/toastr.min.js"></script>
    <script type="text/javascript" src="../../assets/datatables/datatables.min.js"></script>

</head>

<body style="width:100%;height:100%;overflow:scroll;overflow-y:scroll;overflow-x:hidden;">