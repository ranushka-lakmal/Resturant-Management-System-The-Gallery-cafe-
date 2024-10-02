<?php
session_start();
include 'dbCon.php';
$con = connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerName = $_POST['customerName'];
    $customerEmail = $_POST['customerEmail'];
    $orderDetails = $_POST['orderDetails'];
    $orderDateTime = $_POST['orderDateTime'];
    $totalPrice = $_POST['totalPrice'];

    $sql = "INSERT INTO foodOrder (customer_name, customer_email, order_details, order_date_time, total_price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssd", $customerName, $customerEmail, $orderDetails, $orderDateTime, $totalPrice);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    $stmt->close();
}
?>
