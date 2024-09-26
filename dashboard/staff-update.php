<?php
session_start();
include 'dbCon.php';
$con = connect();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form
    $empId = $_POST['empId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mobileNo = $_POST['mobileNo'];
    $jobTitle = $_POST['jobTitle'];
    $addr = $_POST['addr'];
    $dob = $_POST['dob'];
    $status = $_POST['status'];

    // Prepare an SQL statement for updating the staff details
    $sql = "UPDATE `staff` 
            SET firstName = ?, lastName = ?, email = ?, mobileNo = ?, jobTitle = ?, addr = ?, dob = ?, status = ? 
            WHERE empId = ?";
    $stmt = $con->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }

    // Bind parameters
    $stmt->bind_param('ssssssssi', $firstName, $lastName, $email, $mobileNo, $jobTitle, $addr, $dob, $status, $empId);

    // Execute the statement
    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            echo '<script>alert("Staff details updated successfully."); window.location="staff-manage.php";</script>';
        } else {
            echo '<script>alert("No changes made."); window.location="staff-manage.php";</script>';
        }
    } else {
        echo '<script>alert("Error updating staff details: ' . htmlspecialchars($stmt->error) . '"); window.location="staff-manage.php";</script>';
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$con->close();
?>
