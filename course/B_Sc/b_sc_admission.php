<?php
session_start();
require_once '../config.php'; // Secure include

// Function: Clean & sanitize input
function clean($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Process form on submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    // Sanitize input
    $name     = clean($_POST['name']);
    $gender   = clean($_POST['gender']);
    $dob      = clean($_POST['dob']);
    $email    = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone    = clean($_POST['number']);
    $password_plain = clean($_POST['password']);

    // Required field validation
    if (!$name || !$gender || !$dob || !$email || !$phone || !$password_plain) {
        $_SESSION['message'] = "All fields are required!";
        header("Location: b_sc_admission.php");
        exit();
    }

    // Strong password rule (optional)
    if (strlen($password_plain) < 6) {
        $_SESSION['message'] = "Password must be at least 6 characters!";
        header("Location: b_sc_admission.php");
        exit();
    }

    // Hash password
    $password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

    // Check existing email/phone
    $check = $conn->prepare("SELECT email, phone FROM b_sc WHERE email = ? OR phone = ?");
    $check->bind_param("ss", $email, $phone);
    $check->execute();
    $result = $check->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['email'] === $email) {
            $_SESSION['message'] = "Email already exists!";
        } elseif ($row['phone'] === $phone) {
            $_SESSION['message'] = "Phone already exists!";
        }

        header("Location: b_sc_admission.php");
        exit();
    }

    // Insert data securely
    $insert = $conn->prepare("
        INSERT INTO b_sc (name, gender, dob, email, phone, password)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $insert->bind_param("ssssss", $name, $gender, $dob, $email, $phone, $password_hashed);

    if ($insert->execute()) {
        $_SESSION['message'] = "Form submitted successfully. Please go to login.";
    } else {
        $_SESSION['message'] = "Something went wrong. Try again!";
    }

    header("Location: b_sc_admission.php");
    exit();
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSC Admission Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include 'header_register.php'; ?>
    <main>
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

    <!-- BSC DETAILS SECTION -->
<section class="text-gray-700 body-font py-16">
            <div class="container mx-auto px-5">
                <h1 class="text-4xl font-bold text-center text-blue-700 mb-6">Bachelor of Science (BSC)</h1>

    

            <p class="text-lg text-center max-w-3xl mx-auto text-gray-600 mb-8">
                The <b>BSC program</b> at Dr. Ritik Kumar University provides strong foundational knowledge in 
                science subjects with practical and analytical skills. This 3-year undergraduate course 
                prepares students for careers in research, laboratory work, teaching, and advanced scientific studies.
            </p>

            <!-- Highlights -->
            <div class="grid md:grid-cols-3 gap-6 mt-10">
                <div class="bg-white shadow-md p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-600 mb-3">📘 Duration</h2>
                    <p class="text-gray-600">3 Years (6 Semesters) – Full Time</p>
                </div>

                <div class="bg-white shadow-md p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-600 mb-3">💰 Eligibility</h2>
                    <p class="text-gray-600">Passed 10+2 in Science stream with minimum 45% marks.</p>
                </div>

                <div class="bg-white shadow-md p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-600 mb-3">🎯 Career Opportunities</h2>
                    <ul class="list-disc pl-4 text-gray-600">
                        <li>Lab Technician</li>
                        <li>Research Assistant</li>
                        <li>Science Teacher</li>
                        <li>Biotech Assistant</li>
                        <li>Pharmaceutical Industry Jobs</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ADMISSION FORM SECTION -->
    <section class="text-gray-600 body-font bg-white py-20">
        <div class="container mx-auto px-5 max-w-3xl">
            <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">
                BSC Admission Form – 2025
            </h1>

<form action="" method="POST" class="bg-gray-100 shadow-lg rounded-lg p-8">

    <label class="block mb-4">
        <span class="text-gray-700 font-medium">Full Name*</span>
        <input type="text" name="name" required
            class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
    </label>

    <label class="block mb-4">
        <span class="text-gray-700 font-medium">Gender*</span>
        <select name="gender" required
            class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
    </label>

    <label class="block mb-4">
        <span class="text-gray-700 font-medium">Date of Birth*</span>
        <input type="date" name="dob" required
            class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
    </label>

    <label class="block mb-4">
        <span class="text-gray-700 font-medium">Email*</span>
        <input type="email" name="email" required
            class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
    </label>

    <label class="block mb-4">
        <span class="text-gray-700 font-medium">Mobile Number*</span>
        <input type="number" name="number" required
            class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
    </label>

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