<?php
session_start();

if (!isset($_SESSION['isLoggedIn'])) {
    echo '<script>window.location="login.php"</script>';
    exit;
}

include 'dbCon.php';
$con = connect();

if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $password = md5($_POST['password']); // Encrypt the password using MD5
    $status = 0; // Set status to 0 for newly added users

    // Insert new user data into the database
    $sql = "INSERT INTO `users` (username, email, phone, gender, address, password, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssssssi', $username, $email, $phone, $gender, $address, $password, $status);

    if ($stmt->execute()) {
        echo '<script>alert("User added successfully!");</script>';
        echo '<script>window.location="user-list.php"</script>';
    } else {
        echo '<script>alert("Error adding user!");</script>';
    }
}
?>
