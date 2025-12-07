<?php
include '../config.php';
session_start();

// LOGIN PROTECTION
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['student_id'];

// Get current user data from bba table
$sql = "SELECT * FROM bca WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Update profile
if (isset($_POST['update'])) {

    $name   = trim($_POST['name']);
    $email  = trim($_POST['email']);
    $phone  = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $dob    = trim($_POST['dob']);

    // Update query for bba table
    $update = "UPDATE bca 
               SET name=?, email=?, phone=?, gender=?, dob=?
               WHERE id=?";

    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, "sssssi", $name, $email, $phone, $gender, $dob, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Profile updated successfully!";
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Error updating profile!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - BBA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<?php include 'header_dashboard.php'; ?>

<div class="container mx-auto max-w-xl py-12">

    <h1 class="text-3xl font-bold text-center text-blue-700 mb-6">
        Edit Profile (BBA)
    </h1>

    <?php if (isset($error)): ?>
        <div class="bg-red-500 text-white p-3 rounded mb-4 text-center">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="bg-white shadow-lg rounded-xl p-8">

        <label class="block mb-4">
            <span class="text-gray-700">Full Name</span>
            <input type="text" name="name" value="<?= $user['name'] ?>" 
                required class="mt-1 block w-full border px-4 py-2 rounded-lg" />
        </label>

        <label class="block mb-4">
            <span class="text-gray-700">Email</span>
            <input type="email" name="email" value="<?= $user['email'] ?>"
                required class="mt-1 block w-full border px-4 py-2 rounded-lg" />
        </label>

        <label class="block mb-4">
            <span class="text-gray-700">Mobile Number</span>
            <input type="text" name="phone" value="<?= $user['phone'] ?>"
                required class="mt-1 block w-full border px-4 py-2 rounded-lg" />
        </label>

        <label class="block mb-4">
            <span class="text-gray-700">Gender</span>
            <select name="gender" class="mt-1 block w-full border px-4 py-2 rounded-lg">
                <option <?= $user['gender']=='Male'?'selected':'' ?>>Male</option>
                <option <?= $user['gender']=='Female'?'selected':'' ?>>Female</option>
                <option <?= $user['gender']=='Other'?'selected':'' ?>>Other</option>
            </select>
        </label>

        <label class="block mb-6">
            <span class="text-gray-700">Date of Birth</span>
            <input type="date" name="dob" value="<?= $user['dob'] ?>"
                class="mt-1 block w-full border px-4 py-2 rounded-lg" />
        </label>

        <button type="submit" name="update"
            class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700">
            Update Profile
        </button>
    </form>

</div>

<?php include '../../form/footer.php'; ?>

</body>
</html>
