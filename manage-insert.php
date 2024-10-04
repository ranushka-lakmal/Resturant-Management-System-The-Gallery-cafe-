<?php
session_start();
include_once 'dbCon.php';
$con = connect();

if (isset($_POST['regUser'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$gender = $_POST['gender'];
	$password = md5($_POST['password']); // Encrypt the password using MD5
	$status = 0;  // Default status for newly registered users as "not activated by admin"
	$role = 'user'; // Default role for newly registered users

	// Check if email already exists in the users table
	$checkSQL = "SELECT * FROM `users` WHERE email = '$email';";
	$checkresult = $con->query($checkSQL);
	if ($checkresult->num_rows > 0) {
		echo '<script>alert("User with this email already exists.")</script>';
		echo '<script>window.location="register.php"</script>';
	}else {

			$iquery = "INSERT INTO `users`(`username`, `email`, `phone`, `address`, `gender`, `password`, `status`, `role`) 
                    VALUES ('$username','$email','$phone','$address','$gender','$password','$status', '$role');";
			if ($con->query($iquery) === TRUE) {
				echo '<script>alert("You registered successfully. Await admin approval.")</script>';
				echo '<script>window.location="login.php"</script>';
			} else {
				echo "Error: " . $iquery . "<br>" . $con->error;
			}
		}
	}


?>