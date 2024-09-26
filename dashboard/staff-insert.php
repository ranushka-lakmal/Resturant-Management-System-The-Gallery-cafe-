<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['isLoggedIn'])) {
    echo '<script>window.location="login.php"</script>';
    exit;
}

// Include the database connection file
include 'dbCon.php';
$con = connect(); // Function to connect to the database

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addStaff'])) {
    // Fetch form values
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $jobTitle = $_POST['jobTitle'];
    $mobileNo = $_POST['mobileNo'];
    $addr = $_POST['addr'];
    $nic = $_POST['nic'];
    $dob = $_POST['dob'];
    $password = md5($_POST['password']); // Encrypt the password using MD5
    $status = 0; 
    // Handle the profile picture upload
    $photoPath = null; // Initialize photo path variable
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Use the absolute path of the staff-image folder
        $targetDirectory = __DIR__ . "/staff-image"; // Change to the appropriate path
        $file_name = $_FILES['photo']['name'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

        // Ensure the directory exists, if not, create it
        if (!is_dir($targetDirectory)) {
            if (!mkdir($targetDirectory, 0777, true)) { // Try to create the directory
                die('Failed to create folders...');
            }
        }

        // Move the uploaded file to the target directory
        $photoPath = "staff-image/" . uniqid() . '.' . $file_extension; // Create a unique file name
        if (move_uploaded_file($file_tmp, $targetDirectory . '/' . basename($photoPath))) {
            // File uploaded successfully
        } else {
            // File move failed
            echo '<script>alert("Error moving the uploaded file. Please check permissions and path.");</script>';
            exit;
        }
    } else {
        echo '<script>alert("Photo upload error: ' . $_FILES['photo']['error'] . '");</script>';
        exit;
    }

 
    $sql = "INSERT INTO `staff` (firstName, lastName, email, jobTitle, mobileNo, addr, nic, dob, password, photo,status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssssssi", $firstName, $lastName, $email, $jobTitle, $mobileNo, $addr, $nic, $dob, $password, $photoPath, $status);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>alert("Staff member added successfully!"); window.location="staff-manage.php";</script>';
    } else {
        echo '<script>alert("Error: ' . $stmt->error . '"); window.history.back();</script>';
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$con->close();
?>
