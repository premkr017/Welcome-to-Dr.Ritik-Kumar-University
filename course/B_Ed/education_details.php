<?php
include '../config.php';
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['student_id'];

// Fetch Old Values
$query = mysqli_query($conn, "SELECT * FROM b_ed WHERE id = '$id'");
$edu = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Education Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

<div class="max-w-3xl mx-auto bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-3xl font-bold mb-6 text-blue-700">📚 Education Details</h2>

    <form action="save_education.php" method="POST" class="space-y-6">

        <!-- 10th -->
        <h3 class="text-xl font-semibold text-gray-700">10th Details</h3>
        <input type="text" name="edu_10_board" placeholder="10th Board Name" class="input" 
               value="<?= $edu['edu_10_board']; ?>" required>

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="edu_10_year" placeholder="Passing Year" class="input"
                   value="<?= $edu['edu_10_year']; ?>" required>

            <input type="text" name="edu_10_percent" placeholder="Percentage (%)" class="input"
                   value="<?= $edu['edu_10_percent']; ?>" required>
        </div>

        <!-- 12th -->
        <h3 class="text-xl font-semibold text-gray-700 mt-6">12th Details</h3>
        <input type="text" name="edu_12_board" placeholder="12th Board Name" class="input"
               value="<?= $edu['edu_12_board']; ?>">

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="edu_12_year" placeholder="Passing Year" class="input"
                   value="<?= $edu['edu_12_year']; ?>">

            <input type="text" name="edu_12_percent" placeholder="Percentage (%)" class="input"
                   value="<?= $edu['edu_12_percent']; ?>">
        </div>

        <!-- Graduation -->
        <h3 class="text-xl font-semibold text-gray-700 mt-6">Graduation (Optional)</h3>
        <input type="text" name="graduation_course" placeholder="Course (BA/BSc/BCom/BCA)" class="input"
               value="<?= $edu['graduation_course']; ?>">

        <input type="text" name="graduation_uni" placeholder="University Name" class="input"
               value="<?= $edu['graduation_uni']; ?>">

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="graduation_year" placeholder="Year" class="input"
                   value="<?= $edu['graduation_year']; ?>">
            <input type="text" name="graduation_percent" placeholder="Percentage (%)" class="input"
                   value="<?= $edu['graduation_percent']; ?>">
        </div>

        <!-- Submit -->
        <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 mt-4">
            Save Details
        </button>

    </form>
       <a href="dashboard.php"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition">
                    Back to Dashboard
                </a>
</div>

</body>
</html>

<style>
.input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
}
</style>
