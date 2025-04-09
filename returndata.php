<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'pappushop');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['returnbutton'])) {
    $reason = $_POST['reason'];
    $price = $_POST['price'];
    $customername = $_POST['customername'];
    $orderdate = date('Y-m-d', strtotime($_POST['orderdate']));
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    // Use placeholders in the prepared statement
    $stmt = $conn->prepare("INSERT INTO `returndata` (reason, price, customername, orderdate, address, contact) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        // Determine the correct data types
        // Example: If price and contact are integers, and others are strings:
        $stmt->bind_param("sisssi", $reason, $price, $customername, $orderdate,  $address, $contact);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error in SQL query: " . $conn->error;
    }
    $_SESSION['message'] = "Form Submited Successfully !";
    header('Location: ../index.php');
    die();
}

$conn->close();
?>