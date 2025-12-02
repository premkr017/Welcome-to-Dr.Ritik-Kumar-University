<?php
// admission.php

// This file serves as the admission page for Dr. Ritik Kumar University. It provides information about the admission process and includes an enquiry form for prospective students.

include 'course/config.php';
session_start();


if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $course = $_POST['course'];
  $address = $_POST['address'];
  // $whatsapp = $_POST['whatsapp'];
  // $messege = $_POST['messege'];

  // CHECK IF EMAIL OR PHONE  ALREADY EXISTS
  $checkSql = "SELECT * FROM enquary WHERE email = '$email' OR phone = '$phone'";
  $checkResult = mysqli_query($conn, $checkSql);

  if (mysqli_num_rows($checkResult) > 0) {
    $row = mysqli_fetch_assoc($checkResult);

    if ($row['email'] == $email) {
      $_SESSION['message'] = "Your Email already exists!";
    }
    if ($row['phone'] == $phone) {
      $_SESSION['message'] = "Your Phone number already exists!";
    }

    header("Location: index.php");
    exit;
  }

  $sql = "INSERT INTO enquary ( email , phone, name, course, address ) 
                    VALUES ( '$email' , '$phone', '$name', '$course', '$address' )";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $_SESSION['message'] = 'Sent your detail Successful wait for reply';
    header('location:index.php');

    exit;
  } else {
    $_SESSION['message'] = 'Subscription Failed';
    header('Location: index.php');
    exit;
  }
}














?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Admission</title>
     <!-- TAILWIND CDN -->
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include 'form/header_index.php'; ?>

    <main>
<!-- ADMISSION MAIN SECTION -->
<main class="bg-gray-100 min-h-screen py-10">

  <!-- Heading -->
  <div class="text-center mb-10">
    <h1 class="text-4xl font-bold text-blue-700">Admission 2025 - Apply Now</h1>
    <p class="text-gray-600 mt-2 text-lg">Secure your future by joining Dr. Ritik Kumar University</p>
  </div>

  <!-- 3 Info Cards -->
  <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-4 mb-12">

    <!-- Card 1 -->
    <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition">
      <h2 class="text-xl font-semibold text-blue-700 mb-2">Eligibility Criteria</h2>
      <ul class="text-gray-700 space-y-2">
        <li>✔ Minimum 50% marks in 12th (for UG courses)</li>
        <li>✔ For BCA – Maths/Computer preferred</li>
        <li>✔ For BBA – Any Stream</li>
        <li>✔ For B.Ed – Bachelor Degree Required</li>
      </ul>
    </div>

    <!-- Card 2 -->
    <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition">
      <h2 class="text-xl font-semibold text-blue-700 mb-2">Important Dates</h2>
      <ul class="text-gray-700 space-y-2">
        <li>📌 Admission Open: <b>1 April 2025</b></li>
        <li>📌 Last Date to Apply: <b>30 July 2025</b></li>
        <li>📌 Entrance Exam (if applicable): <b>August 2025</b></li>
        <li>📌 Final Merit List: <b>September 2025</b></li>
      </ul>
    </div>

    <!-- Card 3 -->
    <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition">
      <h2 class="text-xl font-semibold text-blue-700 mb-2">Documents Required</h2>
      <ul class="text-gray-700 space-y-2">
        <li>📝 10th & 12th Marksheet</li>
        <li>📝 Transfer Certificate</li>
        <li>📝 Passport Size Photos</li>
        <li>📝 Aadhar Card</li>
      </ul>
    </div>

  </div>

  <!-- Admission Form Section -->
  <section class="container mx-auto bg-white shadow-lg rounded-xl p-8 mx-4">
    <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center">Admission Enquary Form</h2>

    <form action="admission.php" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <!-- Name -->
      <div>
        <label class="text-gray-700 font-medium">Full Name</label>
        <input type="text" id="name" name="name" class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="Enter your full name">
      </div>

      <!-- Email -->
      <div>
        <label class="text-gray-700 font-medium">Email</label>
        <input type="email" id="email" name="email" class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="Enter your email">
      </div>

      <!-- Phone -->
      <div>
        <label class="text-gray-700 font-medium">Phone Number</label>
        <input type="phone" id="phone" name="phone" class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="Enter your phone number">
      </div>

      <!-- <div>
        <label class="text-gray-700 font-medium">Whatsapp Number</label>
        <input type="whatsapp" id="whatsapp" name="whatsapp" class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="Enter your phone number">
      </div> -->


      <div>
    <label for="course" class="text-gray-700 font-medium">Select Course</label>
    <select type="course" id="course" name="course" class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600">
      <option value="">--Select a Course--</option>
      <option value="BCA">BCA</option>
      <option value="BBA">BBA</option>
      <option value="BSc">B.Sc</option>
      <option value="BEd">B.Ed</option>
      <option value="DPharm">D.Pharm</option>
      <option value="DiplomaEngineering">Diploma Engineering</option>
    </select>
  </div>

  <div class="md:col-span-2">
    <label for="address" class="text-gray-700 font-medium">Address</label>
    <textarea id="address" name="address" class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600" rows="3" placeholder="Enter your address"></textarea>
  </div>
      <!-- Select Course -->
      <!-- <div>
        <label class="text-gray-700 font-medium">Select Course</label>
        <select class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600">
          <option>BCA</option>
          <option>BBA</option>
          <option>B.Sc</option>
          <option>B.Ed</option>
          <option>D.Pharm</option>
          <option>Diploma Engineering</option>
        </select>
      </div> -->

      <!-- Address -->
      <!-- <div class="md:col-span-2">
        <label class="text-gray-700 font-medium">Address</label>
        <textarea class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600" rows="3" placeholder="Enter your address"></textarea>
      </div> -->

      <!-- Submit Button -->
      <div class="md:col-span-2">
        <button type="submit" name="submit" class="w-full bg-blue-700 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition">
          Submit Enquiry
        </button>
      </div>

    </form>
  </section>

</main>

    </main>

    <?php include 'form/footer.php'; ?>
</body>
</html>