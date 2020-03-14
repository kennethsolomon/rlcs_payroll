<?php
ob_start(); //Turns on output buffering 
session_start();

date_default_timezone_set("Asia/Manila");

$conn = mysqli_connect('localhost', 'root', '', 'rlcs_payroll');
if (!$conn) {
    die('Connection failed ' . mysqli_error($conn));
}
