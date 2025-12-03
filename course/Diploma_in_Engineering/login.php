<?php
include '../config.php';
session_start();

if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($user) || empty($password)) {
        $_SESSION['message'] = "All fields are required!";
        header("Location: bca_login.php");
        exit;
    }

    // Check credentials
    $sql = "SELECT * FROM diploma_in_engineering WHERE (email = '$user' OR phone = '$user') AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['message'] = "Login successful!";
        header("Location: dashboard.php"); // Redirect to dashboard or another page
        exit;
    } else {
        $_SESSION['message'] = "Invalid credentials!";
        header("Location: login.php");
        exit;
    }
}


?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCA Admission Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header Include -->
    <?php include 'header_login.php'; ?>

    <main class="flex flex-1 items-center justify-center py-10">

        <div class="bg-white w-80 p-8 rounded-xl shadow-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

            <form action="dashboard.php" method="POST" class="space-y-4">
                <input type="text"  name="user"  placeholder="Email or Mobile"  required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="password"  name="password"  placeholder="Password"  required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

                <button type="submit"  name="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    Login
                </button>
            </form>
        </div>

    </main>

    <!-- Footer Include -->
    <?php include '../../form/footer.php'; ?>

</body>

</html>
