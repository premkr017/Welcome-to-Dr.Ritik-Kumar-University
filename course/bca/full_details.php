<?php
include '../config.php';
session_start();

// LOGIN PROTECTION
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['student_id'];

// Fetch existing education data
$sql = "SELECT * FROM bca WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$edu = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// When form submitted
if (isset($_POST['submit'])) {

    // 10th
    $edu_10_board = $_POST['edu_10_board'];
    $edu_10_year = $_POST['edu_10_year'];
    $edu_10_percent = $_POST['edu_10_percent'];

    // 12th
    $edu_12_board = $_POST['edu_12_board'];
    $edu_12_year = $_POST['edu_12_year'];
    $edu_12_percent = $_POST['edu_12_percent'];

    // Graduation
    $graduation_course = $_POST['graduation_course'];
    $graduation_uni = $_POST['graduation_uni'];
    $graduation_year = $_POST['graduation_year'];
    $graduation_percent = $_POST['graduation_percent'];

    // UPDATE QUERY
    $sql = "UPDATE bca SET
        edu_10_board=?, edu_10_year=?, edu_10_percent=?,
        edu_12_board=?, edu_12_year=?, edu_12_percent=?,
        graduation_course=?, graduation_uni=?, graduation_year=?, graduation_percent=?
        WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssssssssssi",
        $edu_10_board, $edu_10_year, $edu_10_percent,
        $edu_12_board, $edu_12_year, $edu_12_percent,
        $graduation_course, $graduation_uni, $graduation_year, $graduation_percent,
        $id
    );

    mysqli_stmt_execute($stmt);

    $_SESSION['message'] = "Education details updated!";
    header("Location: dashboard.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Education Detail Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
<?php include 'header_dashboard.php'; ?>

<div class="max-w-3xl mx-auto bg-white p-8 mt-8 shadow-lg rounded-xl">

    <h2 class="text-3xl font-bold mb-6 text-center text-blue-700">
        Education Details
    </h2>

    <form method="POST" class="space-y-8">

        <!-- 10th Section -->
        <h3 class="text-xl font-bold">10th Details</h3>

        <input type="text" name="edu_10_board" placeholder="Board"
            value="<?= $edu['edu_10_board'] ?? '' ?>" class="w-full border p-3 rounded-lg">

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="edu_10_year" placeholder="Passing Year"
                value="<?= $edu['edu_10_year'] ?? '' ?>" class="border p-3 rounded-lg">

            <input type="text" name="edu_10_percent" placeholder="Percentage"
                value="<?= $edu['edu_10_percent'] ?? '' ?>" class="border p-3 rounded-lg">
        </div>

        <!-- 12th Section -->
        <h3 class="text-xl font-bold">12th Details</h3>

        <input type="text" name="edu_12_board" placeholder="Board"
            value="<?= $edu['edu_12_board'] ?? '' ?>" class="w-full border p-3 rounded-lg">

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="edu_12_year" placeholder="Passing Year"
                value="<?= $edu['edu_12_year'] ?? '' ?>" class="border p-3 rounded-lg">

            <input type="text" name="edu_12_percent" placeholder="Percentage"
                value="<?= $edu['edu_12_percent'] ?? '' ?>" class="border p-3 rounded-lg">
        </div>

        <!-- Graduation Section -->
        <h3 class="text-xl font-bold">Graduation Details (If any)</h3>

        <input type="text" name="graduation_course" placeholder="Course (B.A, B.Com, etc.)"
            value="<?= $edu['graduation_course'] ?? '' ?>" class="w-full border p-3 rounded-lg">

        <input type="text" name="graduation_uni" placeholder="University"
            value="<?= $edu['graduation_uni'] ?? '' ?>" class="w-full border p-3 rounded-lg">

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="graduation_year" placeholder="Passing Year"
                value="<?= $edu['graduation_year'] ?? '' ?>" class="border p-3 rounded-lg">
            <input type="text" name="graduation_percent" placeholder="Percentage"
                value="<?= $edu['graduation_percent'] ?? '' ?>" class="border p-3 rounded-lg">
        </div>

        <button name="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold">
            Save Education Details
        </button>

    </form>

    <a href="dashboard.php"
        class="mt-4 inline-block bg-yellow-600 text-white px-6 py-2 rounded-lg">
        Back to Dashboard
    </a>

</div>

</body>
</html>
