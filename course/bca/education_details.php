<?php
include '../config.php';
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['student_id'];

// Fetch Old Values
$sql = "SELECT * FROM bca WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "i", $id);
if (!mysqli_stmt_execute($stmt)) {
    die("Execute failed: " . mysqli_stmt_error($stmt));
}
$result = mysqli_stmt_get_result($stmt);
if (!$result) {
    die("Get result failed: " . mysqli_error($conn));
}
$edu = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// If no data, initialize empty array
if (!$edu) {
    $edu = array_fill_keys(['edu_10_board', 'edu_10_year', 'edu_10_percent', 'edu_12_board', 'edu_12_year', 'edu_12_percent', 'graduation_course', 'graduation_uni', 'graduation_year', 'graduation_percent'], '');
}
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
        <input type="text" name="tenth_board" placeholder="10th Board Name" class="input"
               value="<?= $edu['tenth_board'] ?? ''; ?>" required>

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="tenth_year" placeholder="Passing Year" class="input"
                   value="<?= $edu['tenth_year'] ?? ''; ?>" required>

            <input type="text" name="tenth_percentage" placeholder="Percentage (%)" class="input"
                   value="<?= $edu['tenth_percentage'] ?? ''; ?>" required>
        </div>

        <!-- 12th -->
        <h3 class="text-xl font-semibold text-gray-700 mt-6">12th Details</h3>
        <input type="text" name="twelfth_board" placeholder="12th Board Name" class="input"
               value="<?= $edu['twelfth_board'] ?? ''; ?>">

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="twelfth_year" placeholder="Passing Year" class="input"
                   value="<?= $edu['twelfth_year'] ?? ''; ?>">

            <input type="text" name="twelfth_percentage" placeholder="Percentage (%)" class="input"
                   value="<?= $edu['twelfth_percentage'] ?? ''; ?>">
        </div>

        <!-- Graduation -->
        <h3 class="text-xl font-semibold text-gray-700 mt-6">Graduation (Optional)</h3>
        <input type="text" name="graduation_course" placeholder="Course (BA/BSc/BCom/BCA)" class="input"
               value="<?= $edu['graduation_course'] ?? ''; ?>">

        <input type="text" name="graduation_university" placeholder="University Name" class="input"
               value="<?= $edu['graduation_university'] ?? ''; ?>">

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="graduation_year" placeholder="Year" class="input"
                   value="<?= $edu['graduation_year'] ?? ''; ?>">
            <input type="text" name="graduation_percentage" placeholder="Percentage (%)" class="input"
                   value="<?= $edu['graduation_percentage'] ?? ''; ?>">
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
