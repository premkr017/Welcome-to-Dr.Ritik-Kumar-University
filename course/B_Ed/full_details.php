<?php
include '../config.php';
session_start();

// LOGIN PROTECTION
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['student_id'];

// Fetch user existing details
$q = mysqli_query($conn, "SELECT * FROM b_ed WHERE id='$id'");
$user = mysqli_fetch_assoc($q);

// Handle Form Submit
if (isset($_POST['submit'])) {

    // Text Fields
    $father = $_POST['father_name'];
    $mother = $_POST['mother_name'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $category = $_POST['category'];
    $qualification = $_POST['qualification'];
    $year = $_POST['passing_year'];
    $percentage = $_POST['percentage'];
    $aadhar = $_POST['aadhar'];

    // File Upload Function
    function uploadFile($file, $folder) {
        if (!empty($file['name'])) {
            $name = time() . "_" . basename($file['name']);
            $path = "../uploads/$folder/" . $name;

            if (!is_dir("../uploads/$folder")) {
                mkdir("../uploads/$folder", 0777, true);
            }

            move_uploaded_file($file['tmp_name'], $path);
            return $name;
        }
        return null;
    }

    // Upload Files
    $photo = uploadFile($_FILES['photo'], "photo");
    $aadhar_file = uploadFile($_FILES['aadhar_file'], "aadhar");
    $marksheet10 = uploadFile($_FILES['marksheet10'], "10th");
    $marksheet12 = uploadFile($_FILES['marksheet12'], "12th");
    $caste = uploadFile($_FILES['caste'], "caste");
    $signature = uploadFile($_FILES['signature'], "signature");

    // Update Query
    $sql = "UPDATE b_ed SET 
        father_name=?, mother_name=?, address=?, state=?, city=?, pincode=?, 
        category=?, qualification=?, passing_year=?, percentage=?, aadhar=?,
        photo=COALESCE(?, photo),
        aadhar_file=COALESCE(?, aadhar_file),
        marksheet10=COALESCE(?, marksheet10),
        marksheet12=COALESCE(?, marksheet12),
        caste=COALESCE(?, caste),
        signature=COALESCE(?, signature)
        WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssssssssssssssssi",
        $father, $mother, $address, $state, $city, $pincode,
        $category, $qualification, $year, $percentage, $aadhar,
        $photo, $aadhar_file, $marksheet10, $marksheet12, $caste, $signature, $id
    );

    mysqli_stmt_execute($stmt);

    $_SESSION['message'] = "Details saved successfully!";
    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Full Detail Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<?php include 'header_dashboard.php'; ?>

<div class="max-w-3xl mx-auto bg-white p-8 mt-8 shadow-lg rounded-xl">

    <h2 class="text-3xl font-bold mb-6 text-center text-blue-700">Student Full Detail Form</h2>

    <form method="POST" enctype="multipart/form-data" class="space-y-6">

        <!-- Father Name -->
        <div>
            <label class="font-semibold">Father Name</label>
            <input type="text" name="father_name" value="<?= $user['father_name'] ?>"
                class="w-full border p-3 rounded-lg">
        </div>

        <!-- Mother Name -->
        <div>
            <label class="font-semibold">Mother Name</label>
            <input type="text" name="mother_name" value="<?= $user['mother_name'] ?>"
                class="w-full border p-3 rounded-lg">
        </div>

        <!-- Address -->
        <div>
            <label class="font-semibold">Full Address</label>
            <textarea name="address" class="w-full border p-3 rounded-lg"><?= $user['address'] ?></textarea>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label>State</label>
                <input type="text" name="state" value="<?= $user['state'] ?>" class="w-full border p-3 rounded-lg">
            </div>
            <div>
                <label>City</label>
                <input type="text" name="city" value="<?= $user['city'] ?>" class="w-full border p-3 rounded-lg">
            </div>
            <div>
                <label>Pincode</label>
                <input type="text" name="pincode" value="<?= $user['pincode'] ?>" class="w-full border p-3 rounded-lg">
            </div>
        </div>

        <!-- Category -->
        <div>
            <label>Category</label>
            <select name="category" class="w-full border p-3 rounded-lg">
                <option <?= $user['category']=="General"?"selected":"" ?>>General</option>
                <option <?= $user['category']=="OBC"?"selected":"" ?>>OBC</option>
                <option <?= $user['category']=="SC"?"selected":"" ?>>SC</option>
                <option <?= $user['category']=="ST"?"selected":"" ?>>ST</option>
            </select>
        </div>

        <!-- Qualification -->
        <div>
            <label>Highest Qualification</label>
            <input type="text" name="qualification" value="<?= $user['qualification'] ?>"
                class="w-full border p-3 rounded-lg">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Passing Year</label>
                <input type="text" name="passing_year" value="<?= $user['passing_year'] ?>"
                    class="w-full border p-3 rounded-lg">
            </div>
            <div>
                <label>Percentage</label>
                <input type="text" name="percentage" value="<?= $user['percentage'] ?>"
                    class="w-full border p-3 rounded-lg">
            </div>
        </div>

        <div>
            <label>Aadhar Number</label>
            <input type="text" name="aadhar" value="<?= $user['aadhar'] ?>" class="w-full border p-3 rounded-lg">
        </div>

        <!-- File Upload Section -->
        <h3 class="text-xl font-bold mt-6">Upload Documents</h3>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Passport Size Photo</label>
                <input type="file" name="photo" class="w-full">
            </div>

            <div>
                <label>Aadhar Card (PDF)</label>
                <input type="file" name="aadhar_file" class="w-full">
            </div>

            <div>
                <label>10th Marksheet</label>
                <input type="file" name="marksheet10" class="w-full">
            </div>

            <div>
                <label>12th Marksheet</label>
                <input type="file" name="marksheet12" class="w-full">
            </div>

            <div>
                <label>Caste Certificate</label>
                <input type="file" name="caste" class="w-full">
            </div>

            <div>
                <label>Signature</label>
                <input type="file" name="signature" class="w-full">
            </div>
        </div>

        <button name="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold">
            Save Details
        </button>

    </form>
    
                <a href="dashboard.php"
                    class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition">
                    Back to Dashboard
                </a>

</div>

</body>
</html>
