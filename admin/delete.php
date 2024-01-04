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

    $sql = "DELETE FROM `cargo_details` WHERE `id`='$user_id'";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "Record deleted successfully.";
        // Redirect to pending.php
        header("Location: adminDashboardLogic.php");
        exit; // Ensure that no more code is executed after the redirect header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
