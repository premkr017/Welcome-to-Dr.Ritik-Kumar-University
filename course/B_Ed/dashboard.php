<?php
include '../config.php';
session_start();

// LOGIN PROTECTION
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch user basic data
$id = $_SESSION['student_id'];
$query = mysqli_query($conn, "SELECT * FROM b_ed WHERE id = '$id'");
$user = mysqli_fetch_assoc($query);

// Fetch student full details (same table)
$student = $user; // user aur student same table se aaya hai
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.Ed Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <?php include 'header_dashboard.php'; ?>

    <main class="container mx-auto py-12 px-4">

        <!-- Welcome Header -->
        <h1 class="text-3xl font-bold text-center text-blue-700 mb-10">
            Welcome, <?= $user['name']; ?> 👋
        </h1>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                <h3 class="text-gray-500">Application Status</h3>
                <p class="text-xl font-bold text-green-600 mt-2">
                    <?= $user['status'] ?? 'Pending'; ?>
                </p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                <h3 class="text-gray-500">Registration No.</h3>
                <p class="text-xl font-bold text-blue-600 mt-2">
                    <?= $user['reg_no'] ?? 'Not Assigned'; ?>
                </p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                <h3 class="text-gray-500">Last Login</h3>
                <p class="text-xl font-bold text-purple-600 mt-2">
                    <?= date("d M, Y"); ?>
                </p>
            </div>

        </div>

        <!-- Profile Card -->
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">

            <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">
                👤 Profile Details
            </h2>

            <div class="space-y-4">

                <div>
                    <p class="text-gray-500 text-sm">Full Name</p>
                    <p class="text-lg font-medium text-gray-800"><?= $user['name']; ?></p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Email</p>
                    <p class="text-lg font-medium text-gray-800"><?= $user['email']; ?></p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Mobile Number</p>
                    <p class="text-lg font-medium text-gray-800"><?= $user['phone']; ?></p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Gender</p>
                    <p class="text-lg font-medium text-gray-800"><?= $user['gender']; ?></p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Date of Birth</p>
                    <p class="text-lg font-medium text-gray-800"><?= $user['dob']; ?></p>
                </div>

            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-8">

                <a href="edit_profile.php"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Edit Profile
                </a>

                <a href="full_details.php"
                    class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition">
                    Fill Full Details
                </a>
                <a href="education_details.php"
                    class="bg-green-800 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition">
                    Add Education Details
                </a>

                <a href="logout.php"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                    Logout
                </a>

            </div>

        </div>

        <!-- Full Details Section -->
        <section class="bg-white shadow-md p-6 rounded-lg mt-10">
            <h2 class="text-2xl font-bold text-blue-700 mb-4">Student Full Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <p><b>Father Name:</b> <?= $student['father_name']; ?></p>
                    <p><b>Mother Name:</b> <?= $student['mother_name']; ?></p>
                    <p><b>Address:</b> <?= $student['address']; ?></p>
                    <p><b>State:</b> <?= $student['state']; ?></p>
                    <p><b>City:</b> <?= $student['city']; ?></p>
                    <p><b>Pincode:</b> <?= $student['pincode']; ?></p>
                    <p><b>Category:</b> <?= $student['category']; ?></p>
                </div>

                <div>
                    <p><b>Qualification:</b> <?= $student['qualification']; ?></p>
                    <p><b>Passing Year:</b> <?= $student['passing_year']; ?></p>
                    <p><b>Percentage:</b> <?= $student['percentage']; ?></p>
                    <p><b>Aadhar:</b> <?= $student['aadhar']; ?></p>
                </div>

            </div>

            <h3 class="text-xl font-semibold text-blue-700 mt-6">Uploaded Documents</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-4">

                <div>
                    <p><b>Photo</b></p>
                    <img src="uploads/<?= $student['photo']; ?>" class="h-24 border rounded">
                </div>

                <div>
                    <p><b>Aadhar Card</b></p>
                    <a href="uploads/<?= $student['aadhar_file']; ?>" target="_blank" class="text-blue-600 underline">
                        View File
                    </a>
                </div>

                <div>
                    <p><b>10th Marksheet</b></p>
                    <a href="uploads/<?= $student['marksheet10']; ?>" target="_blank" class="text-blue-600 underline">
                        View File
                    </a>
                </div>

                <div>
                    <p><b>12th Marksheet</b></p>
                    <a href="uploads/<?= $student['marksheet12']; ?>" target="_blank" class="text-blue-600 underline">
                        View File
                    </a>
                </div>

                <div>
                    <p><b>Caste Certificate</b></p>
                    <a href="uploads/<?= $student['caste']; ?>" target="_blank" class="text-blue-600 underline">
                        View File
                    </a>
                </div>

                <div>
                    <p><b>Signature</b></p>
                    <img src="uploads/<?= $student['signature']; ?>" class="h-16 border rounded">
                </div>

            </div>
        </section>

        <section class="bg-white shadow-md p-6 rounded-lg mt-10">

<h2 class="text-2xl font-bold text-blue-700 mb-4">Education Details</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>
        <h3 class="text-xl font-semibold">10th</h3>
        <p><b>Board:</b> <?= $user['edu_10_board']; ?></p>
        <p><b>Passing Year:</b> <?= $user['edu_10_year']; ?></p>
        <p><b>Percentage:</b> <?= $user['edu_10_percent']; ?></p>
    </div>

    <div>
        <h3 class="text-xl font-semibold">12th</h3>
        <p><b>Board:</b> <?= $user['edu_12_board']; ?></p>
        <p><b>Passing Year:</b> <?= $user['edu_12_year']; ?></p>
        <p><b>Percentage:</b> <?= $user['edu_12_percent']; ?></p>
    </div>

    <div>
        <h3 class="text-xl font-semibold">Graduation</h3>
        <p><b>Course:</b> <?= $user['graduation_course']; ?></p>
        <p><b>University:</b> <?= $user['graduation_uni']; ?></p>
        <p><b>Year:</b> <?= $user['graduation_year']; ?></p>
        <p><b>Percentage:</b> <?= $user['graduation_percent']; ?></p>
    </div>

</div>
</section>


    </main>

    <?php include '../../form/footer.php'; ?>

</body>

</html>
