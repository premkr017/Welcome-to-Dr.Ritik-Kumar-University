<?php

include '../config.php';   // ✔️ This is correct for your structure
session_start();
//old code
// if (isset($_POST['submit'])) {
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $phone = $_POST['number'];
//     $gender = $_POST['gender'];
//     $dob = $_POST['dob'];

//this is my new code with password hashing
// ---------- FORM SUBMIT ----------
if (isset($_POST['submit'])) {

    // Get values safely
    $name     = trim($_POST['name']);
    $gender   = trim($_POST['gender']);
    $dob      = trim($_POST['dob']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['number']);
    $password_plain = trim($_POST['password']);
    
  
    //this is my new code
    // ---------- BASIC VALIDATION ----------
    if (
        empty($name) ||
        empty($gender) ||
        empty($dob) ||
        empty($email) ||
        empty($phone) ||
        empty($password_plain)
    ) {
        $_SESSION['message'] = "All fields are required!";
        header("Location: admission.php");
        exit;
    }
//old code
    // Validate inputs
    // if (empty($name) || empty($email) || empty($phone) || empty($gender) || empty($dob) || empty($password_plain)) {
    //     $_SESSION['message'] = "All fields are required!";
    //     header("Location: admission.php");
    //     exit;
    // }

    //new code
    // Gender validation
    if ($gender == "") {
        $_SESSION['message'] = "Please select a valid gender!";
        header("Location: admission.php");
        exit;
    }

  //old code
    // Get password and HASH it
    // $password_plain = $_POST['password'];
    // $password = password_hash($password_plain, PASSWORD_DEFAULT);

    // New code
    // Hash password
    $password = password_hash($password_plain, PASSWORD_DEFAULT);

//old code
    // CHECK IF EMAIL OR PHONE  ALREADY EXISTS
    // $checkSql = "SELECT * FROM b_ed WHERE email = '$email' OR phone = '$phone'";
    // $checkResult = mysqli_query($conn, $checkSql);
    // if (mysqli_num_rows($checkResult) > 0) {
    //     $row = mysqli_fetch_assoc($checkResult);

    //     if ($row['email'] == $email) {
    //         $_SESSION['message'] = "Your Email already exists!";
    //     }
    //     if ($row['phone'] == $phone) {
    //         $_SESSION['message'] = "Your Phone number already exists!";
    //     }

    //     header("Location: admission.php");
    //     exit;
    // }

    
    // New code
    // ---------- CHECK DUPLICATE EMAIL / PHONE ----------
    $checkSql = "SELECT * FROM b_ed WHERE email = ? OR phone = ?";
    $stmt = mysqli_prepare($conn, $checkSql);

    if (!$stmt) {
        die("Query Prepare Failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ss", $email, $phone);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] == $email) {
            $_SESSION['message'] = "Email already exists!";
        }
        if ($row['phone'] == $phone) {
            $_SESSION['message'] = "Phone number already exists!";
        }

        header("Location: admission.php");
        exit;
    }


//old code
    // INSERT DATA INTO DATABASE
    // INSERT with HASHED PASSWORD
//     $sql = "INSERT INTO b_ed (name, email, phone, gender, dob, password)
//             VALUES ('$name', '$email', '$phone', '$gender', '$dob', '$password')";

//     if (!$result) {
//         die("INSERT FAILED: " . mysqli_error($conn));
//     }


//     $result = mysqli_query($conn, $sql);

//     if ($result) {
//         $_SESSION['message'] = 'Sent your detail Successful. Wait for reply.';
//         header('location: admission.php');
//         exit;
//     } else {
//         $_SESSION['message'] = 'Subscription Failed';
//         header('Location: admission.php');
//         exit;
//     }
// }


// New code
    // ---------- INSERT DATA INTO DATABASE ----------
   // ---------- INSERT STUDENT ----------
    $insertSql = "INSERT INTO b_ed (name, gender, dob, email, phone, password)
                  VALUES (?, ?, ?, ?, ?, ?)";
    $stmt2 = mysqli_prepare($conn, $insertSql);

    if (!$stmt2) {
        die("Insert Prepare Failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt2, "ssssss", $name, $gender, $dob, $email, $phone, $password);
    $insertSuccess = mysqli_stmt_execute($stmt2);

    if (!$insertSuccess) {
        die("INSERT FAILED: " . mysqli_error($conn));
    }

    $_SESSION['message'] = "Form submitted successfully. Please wait for approval.";
    header("Location: admission.php");
    exit;
} 

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.Ed Admission Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body><body class="bg-gray-100">

    <?php include 'header_register.php'; ?>

    <main class="main">

        <!-- SHOW ALERT MESSAGE -->
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="container mx-auto mt-6 max-w-3xl">
                <div class="p-4 text-white font-bold text-center rounded-lg bg-red-500 mb-4">
                    <?= $_SESSION['message']; ?>
                </div>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <!-- B.ED DETAILS -->
        <section class="text-gray-700 body-font py-16">
            <div class="container mx-auto px-5">
                <h1 class="text-4xl font-bold text-center text-blue-700 mb-6">Bachelor of Education (B.Ed)</h1>

                <p class="text-lg text-center max-w-3xl mx-auto text-gray-600 mb-8">
                    The <b>B.Ed program</b> is designed to prepare students for professional teaching careers.
                    Learn teaching skills, child psychology, and modern education techniques.
                </p>

                <div class="grid md:grid-cols-3 gap-6 mt-10">
                    <div class="bg-white shadow p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-blue-600 mb-3">📘 Duration</h2>
                        <p class="text-gray-600">2 Years – Full Time</p>
                    </div>
                    <div class="bg-white shadow p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-blue-600 mb-3">💰 Eligibility</h2>
                        <p class="text-gray-600">Graduation (any stream) with minimum 50% marks.</p>
                    </div>
                    <div class="bg-white shadow p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-blue-600 mb-3">🎯 Career Opportunities</h2>
                        <ul class="list-disc pl-4 text-gray-600">
                            <li>School Teacher (Primary/Secondary)</li>
                            <li>Educational Counselor</li>
                            <li>School Administrator</li>
                            <li>Coaching Instructor</li>
                            <li>Training & Development Officer</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <!-- ADMISSION FORM -->
        <section class="text-gray-600 body-font bg-white py-20">
            <div class="container mx-auto px-5 max-w-3xl">
                <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">B.Ed Admission Form – 2025</h1>

                <form action="" method="POST" class="bg-gray-100 shadow-lg rounded-lg p-8">

                    <!-- Name -->
                    <label class="block mb-4">
                        <span class="text-gray-700 font-medium">Full Name*</span>
                        <input type="text" name="name" required
                               class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500" />
                    </label>

                    <!-- Gender -->
                    <label class="block mb-4">
                        <span class="text-gray-700 font-medium">Gender*</span>
                        <select name="gender" required
                                class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
                            <option value="">Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </label>

                    <!-- DOB -->
                    <label class="block mb-4">
                        <span class="text-gray-700 font-medium">Date of Birth*</span>
                        <input type="date" name="dob" required
                               class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
                    </label>

                    <!-- Email -->
                    <label class="block mb-4">
                        <span class="text-gray-700 font-medium">Email*</span>
                        <input type="email" name="email" required
                               class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
                    </label>

                    <!-- Phone -->
                    <label class="block mb-4">
                        <span class="text-gray-700 font-medium">Mobile Number*</span>
                        <input type="number" name="number" required
                               class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
                    </label>

                    <!-- Password -->
                    <label class="block mb-4">
                        <span class="text-gray-700 font-medium">Password*</span>
                        <input type="password" name="password" required
                               class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
                    </label>

                    <button type="submit" name="submit"
                            class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">
                        Submit Admission Form
                    </button>

                </form>
            </div>
        </section>

    </main>

    <?php include '../../form/footer.php'; ?>

</body>

</html>