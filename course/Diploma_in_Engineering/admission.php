<?php

include '../config.php';
session_start();        

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['number'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];


    // Validate inputs
    if (empty($name) || empty($email) || empty($phone) || empty($gender) || empty($dob) || empty($password)) {
        $_SESSION['message'] = "All fields are required!";
        header("Location: admission.php");
        exit;
    }



    // CHECK IF EMAIL OR PHONE  ALREADY EXISTS
    $checkSql = "SELECT * FROM diploma_in_engineering WHERE email = '$email' OR phone = '$phone'";
    $checkResult = mysqli_query($conn, $checkSql);
    if (mysqli_num_rows($checkResult) > 0) {
        $row = mysqli_fetch_assoc($checkResult);

        if ($row['email'] == $email) {
            $_SESSION['message'] = "Your Email already exists!";
        }
        if ($row['phone'] == $phone) {
            $_SESSION['message'] = "Your Phone number already exists!";
        }

        header("Location: admission.php");
        exit;
    }



    $sql = "INSERT INTO diploma_in_engineering ( name, email , phone, gender, dob, password ) 
                    VALUES ( '$name', '$email' , '$phone', '$gender', '$dob', '$password' )";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['message'] = 'Sent your detail Successful wait for reply';
        header('location: admission.php');
        exit;
    } else {
        $_SESSION['message'] = 'Subscription Failed';
        header('Location: admission.php');
        exit;
    }


}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCA Admission Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include 'header_register.php'; ?>
    <main>
        <main class="main">

            <!-- BCA DETAILS SECTION -->
            <section class="text-gray-700 body-font bg-gray-100 py-16">
                <div class="container mx-auto px-5">
                    <h1 class="text-4xl font-bold text-center text-blue-700 mb-6">
                        Bachelor of Computer Applications (BCA)
                    </h1>

                    <p class="text-lg text-center max-w-3xl mx-auto text-gray-600 mb-8">
                        The <b>BCA program</b> at Dr. Ritik Kumar University is designed to build strong computer
                        science fundamentals, programming skills, and modern IT knowledge. This 3-year undergraduate
                        course prepares students for careers in software development, cybersecurity, IT management, web
                        development, and more.
                    </p>

                    <!-- Highlights -->
                    <div class="grid md:grid-cols-3 gap-6 mt-10">
                        <div class="bg-white shadow-md p-6 rounded-lg">
                            <h2 class="text-xl font-semibold text-blue-600 mb-3">📘 Duration</h2>
                            <p class="text-gray-600">3 Years (6 Semesters) – Full Time</p>
                        </div>

                        <div class="bg-white shadow-md p-6 rounded-lg">
                            <h2 class="text-xl font-semibold text-blue-600 mb-3">💰 Eligibility</h2>
                            <p class="text-gray-600">Passed 10+2 in any stream with minimum 45% marks.</p>
                        </div>

                        <div class="bg-white shadow-md p-6 rounded-lg">
                            <h2 class="text-xl font-semibold text-blue-600 mb-3">🎯 Career Opportunities</h2>
                            <ul class="list-disc pl-4 text-gray-600">
                                <li>Software Developer</li>
                                <li>Web Developer</li>
                                <li>Cyber Security Analyst</li>
                                <li>System Administrator</li>
                                <li>IT Support Specialist</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ADMISSION FORM SECTION -->
            <section class="text-gray-600 body-font bg-white py-20">
                <div class="container mx-auto px-5 max-w-3xl">
                    <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">
                        BCA Admission Form – 2025
                    </h1>

                    <form action="#" method="POST" class="bg-gray-100 shadow-lg rounded-lg p-8">

                        <!-- Name -->
                        <label class="block mb-4">
                            <span class="text-gray-700 font-medium">Full Name*</span>
                            <input type="text" id="name" name="name" required
                                class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </label>

                        <!-- Gender -->
                        <label class="block mb-4">
                            <span class="text-gray-700 font-medium">Gender*</span>
                            <select type="gender" id="gender" name="gender" required
                                class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Select Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </label>


                        <!-- Date of Birth -->
                        <label class="block mb-4">
                            <span class="text-gray-700 font-medium">Date of Birth*</span>
                            <input type="dob" id="dob" name="dob" required
                                class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </label>

                        <!-- Email -->
                        <label class="block mb-4">
                            <span class="text-gray-700 font-medium">Email Address*</span>
                            <input type="email" id="email" name="email" required
                                class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </label>

                        <!-- Mobile -->
                        <label class="block mb-4">
                            <span class="text-gray-700 font-medium">Mobile Number*</span>
                            <input type="number" id="number" name="number" required
                                class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        </label>

<label class="block mb-4">
    <span class="text-gray-700 font-medium">Password*</span>
    <input type="password" id="password" name="password" required
        class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
</label>



                        <button type="submit" name="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition-all">
                            Submit Admission Form
                        </button>
                    </form>
                </div>
            </section>

        </main>

    </main>

    <?php include '../../form/footer.php'; ?>


</body>

</html>