<?php
include '../config.php';
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['student_id'];

// Get Values from Form
$edu_10_board       = $_POST['edu_10_board'];
$edu_10_year        = $_POST['edu_10_year'];
$edu_10_percent     = $_POST['edu_10_percent'];

$edu_12_board       = $_POST['edu_12_board'];
$edu_12_year        = $_POST['edu_12_year'];
$edu_12_percent     = $_POST['edu_12_percent'];

$graduation_course  = $_POST['graduation_course'];
$graduation_uni     = $_POST['graduation_uni'];
$graduation_year    = $_POST['graduation_year'];
$graduation_percent = $_POST['graduation_percent'];

// Update Query
$sql = "UPDATE bca SET
    edu_10_board = ?,
    edu_10_year = ?,
    edu_10_percent = ?,
    edu_12_board = ?,
    edu_12_year = ?,
    edu_12_percent = ?,
    graduation_course = ?,
    graduation_uni = ?,
    graduation_year = ?,
    graduation_percent = ?
    WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssi",
    $edu_10_board,
    $edu_10_year,
    $edu_10_percent,
    $edu_12_board,
    $edu_12_year,
    $edu_12_percent,
    $graduation_course,
    $graduation_uni,
    $graduation_year,
    $graduation_percent,
    $id
);

mysqli_stmt_execute($stmt);

// Success message
$_SESSION['message'] = "Education details updated successfully!";
header("Location: dashboard.php");
exit;
?>
