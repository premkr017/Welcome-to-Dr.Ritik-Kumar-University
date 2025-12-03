<?php
//old code
// include '../config.php';
// session_start();

//this is my new code
session_start();
include '../config.php';

//old code
// if (isset($_POST['submit'])) {
//     $user = $_POST['user'];
//     $password = $_POST['password'];

//this is my new code
// If login form submitted
if (isset($_POST['submit'])) {

    $user = trim($_POST['user']);
    $password = trim($_POST['password']);

//old code
    // Validate inputs
    // if (empty($user) || empty($password)) {
    //     $_SESSION['message'] = "All fields are required!";
    //     header("Location: login.php");
    //     exit;
    // }

    //this is my new code
     // Empty fields check
    if ($user == "" || $password == "") {
        $_SESSION['message'] = "All fields are required!";
        header("Location: login.php");
        exit;
    }

    //old code
    // Check credentials
//     $sql = "SELECT * FROM b_ed WHERE (email = '$user' OR phone = '$user') AND password = '$password'";
//     $result = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($result) == 1) {
//         $_SESSION['message'] = "Login successful!";
//         header("Location: dashboard.php"); // Redirect to dashboard or another page
//         exit;
//     } else {
//         $_SESSION['message'] = "Invalid credentials!";
//         header("Location: login.php");
//         exit;
//     }
// }

//this is my new code 
 // Prepared Statement (SAFE)
    $stmt = $conn->prepare("SELECT * FROM b_ed WHERE email = ? OR phone = ?");
    $stmt->bind_param("ss", $user, $user);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify password (if saved as plain text)
        if ($password === $row['password']) {

            // Create Session
            $_SESSION['loggedin'] = true;
            $_SESSION['student_id'] = $row['id'];
            $_SESSION['student_name'] = $row['name'];

            $_SESSION['message'] = "Login successful!";
            header("Location: dashboard.php");
            exit;

        } else {
            $_SESSION['message'] = "Incorrect Password!";
            header("Location: login.php");
            exit;
        }

    } else {
        // User not registered
        $_SESSION['message'] = "User not found! Please register first.";
        header("Location: admission.php");
        exit;
    }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.Ed Admission Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <?php include 'header_login.php'; ?>

    <main class="flex flex-1 items-center justify-center py-10">

        <div class="bg-white w-80 p-8 rounded-xl shadow-lg">
            
            <!-- Show Session Message -->
            <?php if(isset($_SESSION['message'])): ?>
                <p class="mb-4 text-red-600 text-center">
                    <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                    ?>
                </p>
            <?php endif; ?>

            <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

            <form action="" method="POST" class="space-y-4">

                <input type="text" name="user" placeholder="Email or Mobile"
                    required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="password" name="password" placeholder="Password"
                    required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

                <button type="submit" name="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    Login
                </button>

                <p class="text-center text-sm mt-2">
                    Not registered? <a href="header_register.php" class="text-blue-600">Register Now</a>
                </p>

            </form>
        </div>

    </main>

    <?php include '../../form/footer.php'; ?>

</body>

</html>
