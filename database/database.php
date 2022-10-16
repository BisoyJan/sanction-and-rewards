<?php
session_start();
static $firstTime = true;

date_default_timezone_set('Asia/Manila');

$con = mysqli_connect("localhost", "root", "", "vpsdasdata") or die("Connection failed: " . mysqli_connect_error());

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
