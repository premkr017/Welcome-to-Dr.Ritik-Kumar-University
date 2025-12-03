
    <script src="https://cdn.tailwindcss.com"></script>


<!-- HEADER / NAVBAR -->
<header class="bg-blue shadow-md">
  <div class="container mx-auto flex items-center justify-between p-4">

    <!-- Logo -->
    <a href="#" class="text-2xl font-bold text-blue-700">
      Welcome to Dr.Ritik Kumar University
    </a>

    <!-- Desktop Menu -->
    <nav class="hidden md:flex space-x-8 text-gray-700 font-medium">
      <a href="../../index.php" class="hover:text-blue-600">Home</a>
      <a href="b_sc_login.php" class="hover:text-blue-600">Login Account</a>
      <!-- <a href="logout.php" class="hover:text-blue-600">Logout</a> -->
    </nav>

    <!-- Mobile Menu Button -->
    <button id="menuBtn" class="md:hidden text-3xl focus:outline-none">
      ☰
    </button>

  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="hidden md:hidden bg-white shadow-lg">
    <nav class="flex flex-col text-gray-700 font-medium p-4 space-y-3">
      <a href="index.php" class="hover:text-blue-600">Home</a>
      <a href="course.php" class="hover:text-blue-600">Courses</a>
      <a href="admission.php" class="hover:text-blue-600">Admissions</a>
      <a href="about.php" class="hover:text-blue-600">About</a>
      <a href="contact.php" class="hover:text-blue-600">Contact</a>
    </nav>
  </div>

</header>

<script>
  const btn = document.getElementById("menuBtn");
  const menu = document.getElementById("mobileMenu");

  btn.addEventListener("click", () => {
      menu.classList.toggle("hidden");
  });
</script>
