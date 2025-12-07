<?php
// Backend code for handling BBA admission form submission

// Include the configuration file to establish database connection
include '../config.php';   // ✔️ Correct

// Start the session
session_start();

// Check if form submitted
if (isset($_POST['submit'])) {

    $name     = trim($_POST['name']);
    $gender   = trim($_POST['gender']);
    $dob      = trim($_POST['dob']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['number']);
    $password_plain = trim($_POST['password']);

    // Required fields check
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

    if ($gender == "") {
        $_SESSION['message'] = "Please select a valid gender!";
        header("Location: admission.php");
        exit;
    }

    // Encrypt password
    $password = password_hash($password_plain, PASSWORD_DEFAULT);

    // Check duplicate email or phone
    $checkSql = "SELECT * FROM b_sc WHERE email = ? OR phone = ?";
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

    // Insert into table bba
    $insertSql = "INSERT INTO b_sc (name, gender, dob, email, phone, password)
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

    $_SESSION['message'] = "Form submitted successfully. Please go to login.";
    header("Location: admission.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBA Admission Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<?php include 'header_register.php'; ?>

<main class="main">

    <!-- ALERT MESSAGE -->
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="container mx-auto mt-6 max-w-3xl">
            <div class="p-4 text-white font-bold text-center rounded-lg bg-red-500 mb-4">
                <?= $_SESSION['message']; ?>
            </div>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- BBA DETAILS -->
    <section class="text-gray-700 body-font py-16">
        <div class="container mx-auto px-5">
            <h1 class="text-4xl font-bold text-center text-blue-700 mb-6">Bachelor of Business Administration (BBA)</h1>

            <p class="text-lg text-center max-w-3xl mx-auto text-gray-600 mb-8">
                The <b>BBA program</b> provides a strong foundation in business management,
                leadership, marketing, finance, and entrepreneurship.
                This course prepares students for corporate careers and higher studies like MBA.
            </p>

            <div class="grid md:grid-cols-3 gap-6 mt-10">
                <div class="bg-white shadow p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-600 mb-3">📘 Duration</h2>
                    <p class="text-gray-600">3 Years – Full Time</p>
                </div>

                <div class="bg-white shadow p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-600 mb-3">💰 Eligibility</h2>
                    <p class="text-gray-600">12th pass with minimum 45% marks from any stream.</p>
                </div>

                <div class="bg-white shadow p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-600 mb-3">🎯 Career Opportunities</h2>
                    <ul class="list-disc pl-4 text-gray-600">
                        <li>Marketing Executive</li>
                        <li>HR Assistant</li>
                        <li>Business Analyst</li>
                        <li>Finance Executive</li>
                        <li>Entrepreneur</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ADMISSION FORM -->
    <section class="text-gray-600 body-font bg-white py-20">
        <div class="container mx-auto px-5 max-w-3xl">
            <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">BBA Admission Form – 2025</h1>

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
