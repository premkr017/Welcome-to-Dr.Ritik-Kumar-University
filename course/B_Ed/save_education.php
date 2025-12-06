<?php
include '../config.php';
session_start();

$id = $_SESSION['student_id'];

$edu_10_board = $_POST['edu_10_board'];
$edu_10_year = $_POST['edu_10_year'];
$edu_10_percent = $_POST['edu_10_percent'];

$edu_12_board = $_POST['edu_12_board'];
$edu_12_year = $_POST['edu_12_year'];
$edu_12_percent = $_POST['edu_12_percent'];

$graduation_course = $_POST['graduation_course'];
$graduation_uni = $_POST['graduation_uni'];
$graduation_year = $_POST['graduation_year'];
$graduation_percent = $_POST['graduation_percent'];

$sql = "UPDATE b_ed SET 
        edu_10_board='$edu_10_board',
        edu_10_year='$edu_10_year',
        edu_10_percent='$edu_10_percent',
        
        edu_12_board='$edu_12_board',
        edu_12_year='$edu_12_year',
        edu_12_percent='$edu_12_percent',

        graduation_course='$graduation_course',
        graduation_uni='$graduation_uni',
        graduation_year='$graduation_year',
        graduation_percent='$graduation_percent'
        
        WHERE id='$id'";

mysqli_query($conn, $sql);

header("Location: dashboard.php?msg=education_updated");
exit;
