<?php
include '../config.php';
session_start();

// LOGIN PROTECTION
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch user data
$id = $_SESSION['student_id'];
$query = mysqli_query($conn, "SELECT * FROM b_ed WHERE id = '$id'");
$user = mysqli_fetch_assoc($query);
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
                    <p class="text-lg font-medium text-gray-800">
                        <?= $user['name']; ?>
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Email</p>
                    <p class="text-lg font-medium text-gray-800">
                        <?= $user['email']; ?>
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Mobile Number</p>
                    <p class="text-lg font-medium text-gray-800">
                        <?= $user['phone']; ?>
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Gender</p>
                    <p class="text-lg font-medium text-gray-800">
                        <?= $user['gender']; ?>
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Date of Birth</p>
                    <p class="text-lg font-medium text-gray-800">
                        <?= $user['dob']; ?>
                    </p>
                </div>

            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-8">

                <a href="edit_profile.php"
                   class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Edit Profile
                </a>

                <a href="logout.php"
                   class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                    Logout
                </a>

            </div>

        </div>

    </main>

    <?php include '../../form/footer.php'; ?>

</body>
</html>
