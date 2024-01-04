<?php 
session_start();

include("../go-shdc/connection.php");
include("functions.php");

$user_data = check_login($con);

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $cargo_name = $_POST['cargo_name'];
    $pickup_point = $_POST['pickup_point'];
    $dropoff_point = $_POST['dropoff_point'];
    $weight = $_POST['weight'];
    $length = $_POST['length'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $distance = $_POST['distance'];
    $rate = $_POST['rate'];
    $currency = $_POST['currency'];

    // Validate the input fields (similar to your previous validation logic)

    // If there are no errors, save to the database
    if (empty($errors)) {
        $volume = ($length * $width * $height) / 1000000; // Convert cm³ to dm³
        $cargo_cost = $weight * $volume * $distance * $rate;

        // Retrieve username from the session
        $username = $user_data['username'];

        // Save data to the database
        $insert_query = "INSERT INTO cargo_details (cargo_name, pickup_point, dropoff_point, weight, length, width, height, distance, rate, currency, cargo_cost, username) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($insert_stmt, "sssiiiisssis", $cargo_name, $pickup_point, $dropoff_point, $weight, $length, $width, $height, $distance, $rate, $currency, $cargo_cost, $username);

        if (mysqli_stmt_execute($insert_stmt)) {
            echo json_encode(['success' => true, 'message' => 'Cargo details saved successfully.']);


        } else {
            echo json_encode(['success' => false, 'message' => 'An error occurred while saving cargo details: ' . mysqli_error($con)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Validation error.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO SHDC</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

<header>
    <img id="logo" src="../icon/go-shdc.png" alt="Logo">
</header>

<nav>
    <div class="nav-link">
        <img src="../icon/home.png" alt="Home Icon"> Home
        <div class="dropdown-content">
            <a href="customerDashboardLogic.php"><img src="../icon/key.png" alt="Delivery Icon">Go Cargo</a>
            <!-- Add more submenu items as needed -->
        </div>
    </div>

    <div class="nav-link">
        <img src="../icon/transaction.png" alt="Transaction Icon"> Transaction
        <div class="dropdown-content">
            <a href="pendLogic.php"><img src="../icon/time.png" alt="Pending Icon">Pending</a>
            <a href="progressLogic.php"><img src="../icon/work-in-progress.png" alt="Inprogress Icon">Inprogress</a>
            <!-- Add more submenu items as needed -->
        </div>
    </div>

    <div class="nav-link">
        <img src="../icon/notification.png" alt="Notification Icon"> Notification
        <div class="dropdown-content">
          <a href="messagesLogic.php"><img src="../icon/mail.png "alt="Messages Icon"> Messages</a>
            <!-- Add more submenmu ites as needed -->
        </div>
    </div>

    <div class="nav-link">
        <img src="../icon/file.png" alt="History Icon"> History
        <div class="dropdown-content">
            <a href="completeLogic.php"><img src="../icon/checking.png" alt="Completed Icon">Completed</a>
            <a href="cancelLogic.php"><img src="../icon/cancel.png" alt="Cancelled Icon">Cancelled</a>
            <a href="rejectLogic.php"><img src="../icon/question-mark.png" alt="Rejected Icon">Rejected</a>

            <!-- Add more submenu items as needed -->
        </div>
    </div>

    <div class="nav-link">
        <img src="../icon/setting.png" alt="User Icon"> Settings
        <div class="dropdown-content">
            <a href="accountCustomer.php"><img src="../icon/user.png" alt="Account Icon">My Account</a>
            <a href="aboutLogic.php"><img src="../icon/truck.png" alt="Delivery Icon">About GO SHDC</a>
            <a href="supportLogic.php"><img src="../icon/headset.png" alt="Delivery Icon">Support</a>

            <!-- Add more submenu items as needed -->
        </div>
    </div>

    <tr>
                 <div class="profile-container">
        <button class="profile-btn" onclick="toggleProfile()"><?php echo $user_data['username']; ?></button>
        <div id="profile-table" class="profile-table">
            <!-- Your profile information table goes here -->
            <table>

               <div id="firstname"><?php echo $user_data['firstname']; ?></div>
                <div id="lastname"><?php echo $user_data['lastname']; ?></div>
                <div class="button">
                    <a href="../go-shdc/go-shdc.php">Logout</a>
                </div>


                </tr>


                <!-- Add more rows as needed -->
            </table>
        </div>
    </div>
</nav>

<div id="box">
        <div id="header">
        </div>

        <div id="content">
            <h1>Hello, <?php echo $user_data['username']; ?></h1>
            <h2>Welcome to Go SHDC</h2>
            <h2>We can ship from several countries</h2><br>
            <?php include("customerDashboard.php"); ?>
        </div>
    </div>

<script>
    function toggleProfile() {
        var profileTable = document.getElementById("profile-table");
        profileTable.style.transition = "height 0.5s";
        profileTable.style.height = (profileTable.style.height === "0px" || !profileTable.style.height) ? "100px" : "0px";
    }

    
</script>


    
</body>
</html>
