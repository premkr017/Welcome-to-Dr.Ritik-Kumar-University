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
$q = mysqli_query($conn, "SELECT * FROM b_ed WHERE id='$id'");
$edu = mysqli_fetch_assoc($q);

// When form submitted
if (isset($_POST['submit'])) {

    // 10th
    $tenth_school = $_POST['tenth_school'];
    $tenth_board = $_POST['tenth_board'];
    $tenth_year = $_POST['tenth_year'];
    $tenth_percentage = $_POST['tenth_percentage'];

    // 12th
    $twelfth_school = $_POST['twelfth_school'];
    $twelfth_board = $_POST['twelfth_board'];
    $twelfth_year = $_POST['twelfth_year'];
    $twelfth_percentage = $_POST['twelfth_percentage'];

    // Graduation
    $graduation_course = $_POST['graduation_course'];
    $graduation_university = $_POST['graduation_university'];
    $graduation_year = $_POST['graduation_year'];
    $graduation_percentage = $_POST['graduation_percentage'];

    // UPDATE QUERY
    $sql = "UPDATE b_ed SET 
        tenth_school=?, tenth_board=?, tenth_year=?, tenth_percentage=?,
        twelfth_school=?, twelfth_board=?, twelfth_year=?, twelfth_percentage=?,
        graduation_course=?, graduation_university=?, graduation_year=?, graduation_percentage=?
        WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssssssssssssi",
        $tenth_school, $tenth_board, $tenth_year, $tenth_percentage,
        $twelfth_school, $twelfth_board, $twelfth_year, $twelfth_percentage,
        $graduation_course, $graduation_university, $graduation_year, $graduation_percentage,
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

        <input type="text" name="tenth_school" placeholder="School Name"
            value="<?= $edu['tenth_school'] ?>" class="w-full border p-3 rounded-lg">

        <input type="text" name="tenth_board" placeholder="Board"
            value="<?= $edu['tenth_board'] ?>" class="w-full border p-3 rounded-lg">

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="tenth_year" placeholder="Passing Year"
                value="<?= $edu['tenth_year'] ?>" class="border p-3 rounded-lg">

            <input type="text" name="tenth_percentage" placeholder="Percentage"
                value="<?= $edu['tenth_percentage'] ?>" class="border p-3 rounded-lg">
        </div>

        <!-- 12th Section -->
        <h3 class="text-xl font-bold">12th Details</h3>

        <input type="text" name="twelfth_school" placeholder="School Name"
            value="<?= $edu['twelfth_school'] ?>" class="w-full border p-3 rounded-lg">

        <input type="text" name="twelfth_board" placeholder="Board"
            value="<?= $edu['twelfth_board'] ?>" class="w-full border p-3 rounded-lg">

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="twelfth_year" placeholder="Passing Year"
                value="<?= $edu['twelfth_year'] ?>" class="border p-3 rounded-lg">

            <input type="text" name="twelfth_percentage" placeholder="Percentage"
                value="<?= $edu['twelfth_percentage'] ?>" class="border p-3 rounded-lg">
        </div>

        <!-- Graduation Section -->
        <h3 class="text-xl font-bold">Graduation Details (If any)</h3>

        <input type="text" name="graduation_course" placeholder="Course (B.A, B.Com, etc.)"
            value="<?= $edu['graduation_course'] ?>" class="w-full border p-3 rounded-lg">

        <input type="text" name="graduation_university" placeholder="University"
            value="<?= $edu['graduation_university'] ?>" class="w-full border p-3 rounded-lg">

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="graduation_year" placeholder="Passing Year"
                value="<?= $edu['graduation_year'] ?>" class="border p-3 rounded-lg">

            <input type="text" name="graduation_percentage" placeholder="Percentage"
                value="<?= $edu['graduation_percentage'] ?>" class="border p-3 rounded-lg">
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
