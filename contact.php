<?php
// contact.php
include 'course/config.php';
session_start();

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $messege = $_POST['messege'];

  // CHECK IF EMAIL ALREADY EXISTS
  $checkSql = "SELECT * FROM contact WHERE email = '$email'";
  $checkResult = mysqli_query($conn, $checkSql);

  if (mysqli_num_rows($checkResult) > 0) {
    $_SESSION['message'] = "Your Email already exists!";
    header("Location: contact.php");
    exit;
  }

  $sql = "INSERT INTO contact ( name, email, subject, messege ) 
                    VALUES ( '$name', '$email', '$subject', '$messege' )";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $_SESSION['message'] = 'Your message has been sent successfully. We will get back to you soon.';
    header('location:contact.php');
    exit;
  } else {
    $_SESSION['message'] = 'Failed to send your message. Please try again later.';
    header('Location: contact.php');
    exit;
  }
}









?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to contact</title>
</head>
<body>
    <?php include 'form/header_index.php'; ?>
<main>
    <!-- TAILWIND CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- CONTACT PAGE -->
<main class="bg-gray-100 min-h-screen py-10">

  <!-- Heading -->
  <div class="text-center mb-10">
    <h1 class="text-4xl font-bold text-blue-700">Contact Us</h1>
    <p class="text-gray-600 mt-2 text-lg">We are here to help you with all your queries</p>
  </div>

  <!-- CONTACT CONTAINER -->
  <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 px-6">

    <!-- LEFT: Contact Info -->
    <div class="bg-white shadow-lg rounded-xl p-8">
      <h2 class="text-2xl font-bold text-blue-700 mb-4">Get in Touch</h2>
      <p class="text-gray-700 mb-6">Feel free to reach out for admissions, support, or general inquiries.</p>

      <div class="space-y-6">

        <!-- Phone -->
        <div class="flex items-start">
          <span class="text-blue-700 text-2xl mr-4">📞</span>
          <div>
            <h3 class="font-semibold text-gray-800">Phone</h3>
            <p class="text-gray-600">+91 73230 78109</p>
          </div>
        </div>

        <!-- Email -->
        <div class="flex items-start">
          <span class="text-blue-700 text-2xl mr-4">📧</span>
          <div>
            <h3 class="font-semibold text-gray-800">Email</h3>
            <p class="text-gray-600">itstherocket83@gmail.com</p>
          </div>
        </div>

        <!-- Address -->
        <div class="flex items-start">
          <span class="text-blue-700 text-2xl mr-4">📍</span>
          <div>
            <h3 class="font-semibold text-gray-800">Address</h3>
            <p class="text-gray-600">Bhaluwahiya, Ramgarhwa, East Champaran, Bihar 845433</p>
          </div>
        </div>

      </div>
    </div>

    <!-- RIGHT: Contact Form -->
    <div class="bg-white shadow-lg rounded-xl p-8">
      <h2 class="text-2xl font-bold text-blue-700 mb-6">Send us a Message</h2>

     <form action="contact.php" method="POST" class="space-y-5">

    <div>
      <label class="text-gray-700 font-medium">Full Name</label>
      <input type="text" id="name" name="name" class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="Enter your name" required>
    </div>

    <div>
      <label class="text-gray-700 font-medium">Email</label>
      <input type="email" id="email" name="email" class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="Enter your email" required>
    </div>

    <div>
      <label class="text-gray-700 font-medium">Subject</label>
      <input type="text" id="subject" name="subject" class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="What is your query about?" required>
    </div>

    <div>
      <label class="text-gray-700 font-medium">Message</label>
      <textarea id="messege" name="messege" rows="4" class="w-full border mt-1 p-2 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="Write your message here..." required></textarea>
    </div>

    <button type="submit" name="submit" class="w-full bg-blue-700 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition">
      Send Message
    </button>

</form>

    </ 
  </div>

  <!-- MAP SECTION -->
  <div class="container mx-auto px-6 mt-16">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">Our Location</h2>
    <div class="rounded-xl overflow-hidden shadow-lg">
      <iframe 
        width="100%"  height="350"  frameborder="0"  scrolling="no"  marginheight="0"  marginwidth="0"
        src="https://maps.google.com/maps?q=Ramgarhwa%20Bihar&t=&z=13&ie=UTF8&iwloc=&output=embed">
      </iframe>
    </div>
  </div>

</main>

</main>
    <?php include 'form/footer.php'; ?>
</body>
</html>