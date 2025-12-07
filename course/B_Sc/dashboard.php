<?php
include '../config.php';
session_start();

// LOGIN PROTECTION
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch user basic + full details (same table)
$id = $_SESSION['student_id'];
$sql = "SELECT * FROM b_sc WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Safe fallback function
function show($value) {
    return isset($value) && !empty($value) ? $value : "<span class='text-red-600'>Not Provided</span>";
}
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
            Welcome, <?= show($user['name']); ?> 👋
        </h1>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                <h3 class="text-gray-500">Application Status</h3>
                <p class="text-xl font-bold text-green-600 mt-2">
                    <?= show($user['status'] ?? 'Pending'); ?>
                </p>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                <h3 class="text-gray-500">Registration No.</h3>
                <p class="text-xl font-bold text-blue-600 mt-2">
                    <?= show($user['reg_no'] ?? 'Not Assigned'); ?>
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
                    <p class="text-lg font-medium text-gray-800"><?= show($user['name']); ?></p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Email</p>
                    <p class="text-lg font-medium text-gray-800"><?= show($user['email']); ?></p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Mobile Number</p>
                    <p class="text-lg font-medium text-gray-800"><?= show($user['phone']); ?></p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Gender</p>
                    <p class="text-lg font-medium text-gray-800"><?= show($user['gender']); ?></p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Date of Birth</p>
                    <p class="text-lg font-medium text-gray-800"><?= show($user['dob']); ?></p>
                </div>

            </div>

            <!-- Buttons -->
            <div class="flex flex-wrap justify-between gap-4 mt-8">

                <a href="edit_profile.php"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Edit Profile
                </a>

                <a href="full_details.php"
                    class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition">
                    Fill Full Details
                </a>

                <a href="education_details.php"
                    class="bg-green-800 text-white px-6 py-2 rounded-lg hover:bg-green-900 transition">
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
                    <p><b>Father Name:</b> <?= show($user['father_name']); ?></p>
                    <p><b>Mother Name:</b> <?= show($user['mother_name']); ?></p>
                    <p><b>Address:</b> <?= show($user['address']); ?></p>
                    <p><b>State:</b> <?= show($user['state']); ?></p>
                    <p><b>City:</b> <?= show($user['city']); ?></p>
                    <p><b>Pincode:</b> <?= show($user['pincode']); ?></p>
                    <p><b>Category:</b> <?= show($user['category']); ?></p>
                </div>

                <div>
                    <p><b>Qualification:</b> <?= show($user['qualification']); ?></p>
                    <p><b>Passing Year:</b> <?= show($user['passing_year']); ?></p>
                    <p><b>Percentage:</b> <?= show($user['percentage']); ?></p>
                    <p><b>Aadhar:</b> <?= show($user['aadhar']); ?></p>
                </div>

            </div>

            <h3 class="text-xl font-semibold text-blue-700 mt-6">Uploaded Documents</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-4">

                <div>
                    <p><b>Photo</b></p>
                    <?php if(!empty($user['photo'])): ?>
                        <img src="uploads/<?= $user['photo']; ?>" class="h-24 border rounded">
                    <?php else: ?>
                        <p class="text-red-600">Not Uploaded</p>
                    <?php endif; ?>
                </div>

                <div>
                    <p><b>Aadhar Card</b></p>
                    <?php if(!empty($user['aadhar_file'])): ?>
                        <a href="uploads/<?= $user['aadhar_file']; ?>" target="_blank" class="text-blue-600 underline">
                            View File
                        </a>
                    <?php else: ?>
                        <p class="text-red-600">Not Uploaded</p>
                    <?php endif; ?>
                </div>

                <div>
                    <p><b>10th Marksheet</b></p>
                    <?php if(!empty($user['marksheet10'])): ?>
                        <a href="uploads/<?= $user['marksheet10']; ?>" target="_blank" class="text-blue-600 underline">View File</a>
                    <?php else: ?>
                        <p class="text-red-600">Not Uploaded</p>
                    <?php endif; ?>
                </div>

                <div>
                    <p><b>12th Marksheet</b></p>
                    <?php if(!empty($user['marksheet12'])): ?>
                        <a href="uploads/<?= $user['marksheet12']; ?>" target="_blank" class="text-blue-600 underline">View File</a>
                    <?php else: ?>
                        <p class="text-red-600">Not Uploaded</p>
                    <?php endif; ?>
                </div>

                <div>
                    <p><b>Caste Certificate</b></p>
                    <?php if(!empty($user['caste'])): ?>
                        <a href="uploads/<?= $user['caste']; ?>" target="_blank" class="text-blue-600 underline">View File</a>
                    <?php else: ?>
                        <p class="text-red-600">Not Uploaded</p>
                    <?php endif; ?>
                </div>

                <div>
                    <p><b>Signature</b></p>
                    <?php if(!empty($user['signature'])): ?>
                        <img src="uploads/<?= $user['signature']; ?>" class="h-16 border rounded">
                    <?php else: ?>
                        <p class="text-red-600">Not Uploaded</p>
                    <?php endif; ?>
                </div>

            </div>
        </section>

        <!-- Education Details Section -->
        <section class="bg-white shadow-md p-6 rounded-lg mt-10">

            <h2 class="text-2xl font-bold text-blue-700 mb-4">Education Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <h3 class="text-xl font-semibold">10th</h3>
                    <p><b>Board:</b> <?= show($user['edu_10_board'] ?? ''); ?></p>
                    <p><b>Passing Year:</b> <?= show($user['edu_10_year'] ?? ''); ?></p>
                    <p><b>Percentage:</b> <?= show($user['edu_10_percent'] ?? ''); ?></p>
                </div>

                <div>
                    <h3 class="text-xl font-semibold">12th</h3>
                    <p><b>Board:</b> <?= show($user['edu_12_board'] ?? ''); ?></p>
                    <p><b>Passing Year:</b> <?= show($user['edu_12_year'] ?? ''); ?></p>
                    <p><b>Percentage:</b> <?= show($user['edu_12_percent'] ?? ''); ?></p>
                </div>

                <div>
                    <h3 class="text-xl font-semibold">Graduation</h3>
                    <p><b>Course:</b> <?= show($user['graduation_course'] ?? ''); ?></p>
                    <p><b>University:</b> <?= show($user['graduation_uni'] ?? ''); ?></p>
                    <p><b>Year:</b> <?= show($user['graduation_year'] ?? ''); ?></p>
                    <p><b>Percentage:</b> <?= show($user['graduation_percent'] ?? ''); ?></p>
                </div>

            </div>
        </section>

    </main>

    <?php include '../../form/footer.php'; ?>

</body>

</html>
