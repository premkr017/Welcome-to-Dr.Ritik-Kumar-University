<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr.Ritik Kumar University</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php include 'form/header_index.php'; ?>
    
<main class="main">
  <section class="text-gray-600 body-font  py-24">
    <div class="container mx-auto flex px-5 flex-col items-center text-center">

      <!-- Heading -->
      <h1 class="title-font sm:text-4xl text-3xl mb-4 font-bold text-white">
        Empowering Students for a Brighter Future
      </h1>

      <!-- Paragraph -->
      <p class="mb-8 leading-relaxed text-gray-200 max-w-2xl text-white">
        Our mission at <b>Dr. Ritik Kumar University</b> is to provide world-class education,
        modern skill development, and a student-centered learning environment.
        We are committed to nurturing excellence, innovation, research, and
        leadership qualities that help every learner achieve their dreams.
      </p>

      <!-- Buttons -->
      <div class="flex flex-wrap justify-center gap-4">
        <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 hover:bg-indigo-600 rounded text-lg">
          <a href="course.php" class="hover:text-blue-400">Learn More Courses</a>
        </button>
        <button class="inline-flex text-gray-800 bg-gray-100 border-0 py-2 px-6 hover:bg-gray-200 rounded text-lg">
          <a href="admission.php" class="hover:text-blue-400">Go to Admission</a>
        </button>
      </div>

    </div>
  </section>
</main>

    <?php include 'form/footer.php'; ?>
</body>
</html>