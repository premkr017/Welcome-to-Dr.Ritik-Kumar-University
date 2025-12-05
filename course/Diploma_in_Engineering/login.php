<?php
include '../config.php';
session_start();

// Show alert message
if (isset($_SESSION['message'])) {
    echo "<script>alert('{$_SESSION['message']}');</script>";
    unset($_SESSION['message']);
}

if (isset($_POST['submit'])) {

    $user = trim($_POST['user']);
    $password = trim($_POST['password']);

    // Fetch user from email or phone
    $selectquery = "SELECT * FROM diploma_in_engineering WHERE email = '$user' OR phone = '$user'";
    $res = mysqli_query($conn, $selectquery);

    if (mysqli_num_rows($res) > 0) {

        $row = mysqli_fetch_assoc($res);

        $hashed_password = $row['password'];

        // Verify password
        if (password_verify($password, $hashed_password)) {

            // Save session
            $_SESSION['loggedin'] = true;
            $_SESSION['student_id'] = $row['id'];
            $_SESSION['student_name'] = $row['name'];
            $_SESSION['phone'] = $row['phone'];   // FIXED
            $_SESSION['email'] = $row['email'];

            header('Location: dashboard.php');
            exit;

        } else {
            echo "<script>alert('Incorrect password');</script>";
        }

    } else {
        echo "<script>alert('Email or Mobile not found');</script>";
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
