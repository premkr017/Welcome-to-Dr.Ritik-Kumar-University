<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About University</title>
</head>
<body>
    <?php include 'form/header_index.php'; ?>
    
<main>
    <!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- ABOUT PAGE MAIN -->
<main class="bg-gray-100 min-h-screen py-10">

  <!-- Page Heading -->
  <div class="text-center mb-10">
    <h1 class="text-4xl font-bold text-blue-700">About Dr. Ritik Kumar University</h1>
    <p class="text-gray-600 mt-2 text-lg">At Dr. Ritik Kumar University, we are dedicated to shaping the future of every learner through quality education, innovation, and skill-oriented training. Our mission is to empower students with the knowledge, discipline, and real-world expertise needed to succeed in their chosen careers. We focus on holistic development, ensuring that each student grows academically, professionally, and personally in a dynamic and supportive learning environment.</p>
  </div>

  <!-- ABOUT SECTION -->
  <section class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 px-6 mb-16">

    <!-- Image -->
    <div>
      <img src="https://images.unsplash.com/photo-1597924540652-89427fb29b25?q=80&w=1358&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D/600x400" 
           class="rounded-xl shadow-lg">
    </div>

    <!-- Text Content -->
    <div class="flex flex-col justify-center">
      <h2 class="text-3xl font-bold text-blue-700 mb-4">Our Vision & Mission</h2>
      <p class="text-gray-700 leading-relaxed mb-4">
        Dr. Ritik Kumar University aims to provide world-class education with modern 
        facilities, experienced faculty, and industry-oriented curriculum. Our mission is 
        to empower students with strong knowledge, practical skills, and leadership qualities 
        to build a successful future.
      </p>
      <p class="text-gray-700 leading-relaxed">
        We focus on holistic development, innovation, research, and creating opportunities 
        that help students achieve excellence in every field.
      </p>
    </div>

  </section>

  <!-- WHY CHOOSE US -->
  <section class="container mx-auto px-6 mb-16">
    <h2 class="text-3xl font-bold text-blue-700 text-center mb-8">Why Choose Our University?</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Card 1 -->
      <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition">
        <h3 class="text-xl font-semibold text-blue-700 mb-2">Experienced Faculty</h3>
        <p class="text-gray-700">Our teachers are highly qualified with real industry experience and strong academic backgrounds.</p>
      </div>

      <!-- Card 2 -->
      <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition">
        <h3 class="text-xl font-semibold text-blue-700 mb-2">Modern Campus</h3>
        <p class="text-gray-700">Smart classrooms, computer labs, libraries, and a beautiful eco-friendly environment.</p>
      </div>

      <!-- Card 3 -->
      <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition">
        <h3 class="text-xl font-semibold text-blue-700 mb-2">Industry-Oriented Courses</h3>
        <p class="text-gray-700">Courses designed with job-focused curriculum to prepare students for future challenges.</p>
      </div>

    </div>
  </section>

  <!-- OUR LEADERSHIP -->
  <section class="container mx-auto px-6 mb-16">
    <h2 class="text-3xl font-bold text-blue-700 text-center mb-8">Our Leadership</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

      <!-- Leader 1 -->
      <div class="bg-white shadow-lg rounded-xl p-6 text-center hover:shadow-xl transition">
        <img src="images/manager.jpg" 
             class="w-32 h-32 mx-auto rounded-full mb-4 shadow">
        <h3 class="text-xl font-semibold text-blue-700">Dr. Ritik Kumar</h3>
        <p class="text-gray-600 text-sm mb-2">Founder & Chancellor</p>
        <p class="text-gray-700 text-sm">Visionary leader committed to transforming education with innovation and excellence.</p>
      </div>

      <!-- Leader 2 -->
      <div class="bg-white shadow-lg rounded-xl p-6 text-center hover:shadow-xl transition">
        <img src="images/manager - Copy (2).jpg" 
             class="w-32 h-32 mx-auto rounded-full mb-4 shadow">
        <h3 class="text-xl font-semibold text-blue-700">Dr. Prem Kumar</h3>
        <p class="text-gray-600 text-sm mb-2">Vice Chancellor</p>
        <p class="text-gray-700 text-sm">Ensuring quality education, academic development, and student welfare programs.</p>
      </div>

      <!-- Leader 3 -->
      <div class="bg-white shadow-lg rounded-xl p-6 text-center hover:shadow-xl transition">
        <img src="images/manager - Copy.jpg"
             class="w-32 h-32 mx-auto rounded-full mb-4 shadow">
        <h3 class="text-xl font-semibold text-blue-700">Prof. Amit Verma</h3>
        <p class="text-gray-600 text-sm mb-2">Dean of Academics</p>
        <p class="text-gray-700 text-sm">Leading academic strategies, syllabus development, and quality enhancement.</p>
      </div>

    </div>
  </section>

</main>

</main>
    

    <?php include 'form/footer.php'; ?>
</body>
</html>