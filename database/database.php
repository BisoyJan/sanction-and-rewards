<?php

static $firstTime = true;

$con = mysqli_connect("localhost", "root", "", "vpsdasdata");

if (!$con) {
    die('Connection Failed' . mysqli_connect_error());
}
