<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "go_shdc";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete from customer table
    $sql_customer = "DELETE FROM `customer` WHERE `id`='$user_id'";
    $result_customer = $conn->query($sql_customer);

    // Delete from driver table
    $sql_driver = "DELETE FROM `driver` WHERE `id`='$user_id'";
    $result_driver = $conn->query($sql_driver);

    // Check if both deletions were successful
    if ($result_customer === TRUE && $result_driver === TRUE) {
        echo "Record deleted successfully.";
        // Redirect to adminDashboardLogic.php
        header("Location: aboutLogic.php");
        exit; // Ensure that no more code is executed after the redirect header
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
