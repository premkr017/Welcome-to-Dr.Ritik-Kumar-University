








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome dashboard</title>
</head>

        <body class="bg-gray-100 min-h-screen">
    <?php include 'header_dashboard.php'; ?>

    <main class="container mx-auto py-12 px-4">

        <h1 class="text-3xl font-bold text-center text-blue-700 mb-10">
            Welcome diploma in engineering Dashboard
        </h1>

        <!-- PROFILE CARD -->
        <div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8">

            <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">
                Profile Details
            </h2>

            <div class="space-y-4">

                <div>
                    <p class="text-gray-500 text-sm">Full Name</p>
                    <p class="text-lg font-medium text-gray-800">
                        <?= $user['name']; ?>
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Email</p>
                    <p class="text-lg font-medium text-gray-800">
                        <?= $user['email']; ?>
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Mobile Number</p>
                    <p class="text-lg font-medium text-gray-800">
                        <?= $user['phone']; ?>
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Gender</p>
                    <p class="text-lg font-medium text-gray-800">
                        <?= $user['gender']; ?>
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Date of Birth</p>
                    <p class="text-lg font-medium text-gray-800">
                        <?= $user['dob']; ?>
                    </p>
                </div>

            </div>

        </div>

  
    </main>

    <?php include '../../form/footer.php'; ?>

</body>
</html>