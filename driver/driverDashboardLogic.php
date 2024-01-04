<?php
session_start();

include("../go-shdc/connection.php");
include("functions0.php");

$user_data = check_login($con);
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $carname = $_POST['carname'];
    $maxweight = $_POST['maxweight'];
    $location = $_POST['location'];
    $loadingtime = $_POST['loadingtime'];
    $unloadingtime = $_POST['unloadingtime'];
    $length = $_POST['length'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    
    // Retrieve username from the user data
    $username = $user_data['username'];

    // Validate the input fields
    $errors = validateInput($carname, $maxweight, $location, $loadingtime, $unloadingtime, $length, $width, $height);

    // If there are no errors, save to the database
    if (empty($errors)) {
        $id = generateUniqueID();
        $insert_query = "INSERT INTO cargo (id, carname, maxweight, location, loadingtime, unloadingtime, length, width, height, username) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = mysqli_prepare($con, $insert_query);

        mysqli_stmt_bind_param($insert_stmt, "isisssiiis", $id, $carname, $maxweight, $location, $loadingtime, $unloadingtime, $length, $width, $height, $username);

        if (mysqli_stmt_execute($insert_stmt)) {
            // Refresh form fields
            $carname = $maxweight = $location = $loadingtime = $unloadingtime = $length = $width = $height = '';

            // Redirect to driverDashboardLogic.php
            header("Location: driverDashboardLogic.php");
            die;
        } else {
            // Handle database error
            $errors['general'] = "An error occurred while registering. Please try again.";
            // Log or display the error
            error_log("Database Error: " . mysqli_error($con));
        }
    }
}

function validateInput($carname, $maxweight, $location, $loadingtime, $unloadingtime, $length, $width, $height) {
    $errors = array();

    // Validate each input field
    if (empty($carname)) {
        $errors['carname'] = "Please enter a car name.";
    }

    if (empty($maxweight) || !filter_var($maxweight, FILTER_VALIDATE_INT)) {
        $errors['maxweight'] = "Please enter a valid maxweight.";
    }

    if (empty($location)) {
        $errors['location'] = "Please enter a valid location.";
    }

    if (empty($loadingtime)) {
        $errors['loadingtime'] = "Please enter a valid time.";
    }

    if (empty($unloadingtime)) {
        $errors['unloadingtime'] = "Please enter a valid time.";
    }

    if (empty($length) || !filter_var($length, FILTER_VALIDATE_INT)) {
        $errors['length'] = "Please enter a valid length.";
    }

    if (empty($width) || !filter_var($width, FILTER_VALIDATE_INT)) {
        $errors['width'] = "Please enter a valid width.";
    }

    if (empty($height) || !filter_var($height, FILTER_VALIDATE_INT)) {
        $errors['height'] = "Please enter a valid height.";
    }

    return $errors;
}

function generateUniqueID() {
    // Implement a method to generate a unique ID (e.g., using timestamp)
    return uniqid();
}
?>



<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO SHDC</title>
    <link rel="stylesheet" href="../styles/account.css">
</head>
<body>

<header>
    <img id="logo" src="../icon/go-shdc.png" alt="Logo">
</header>

<nav>
    <div class="nav-link">
        <img src="../icon/home.png" alt="Home Icon"> Home
        <div class="dropdown-content">
            <a href="driverDashboardLogic.php"><img src="../icon/buy-home.png" alt="Delivery Icon">Go Delivery</a>

            <!-- Add more submenu items as needed -->
        </div>
    </div>

    <div class="nav-link">
        <img src="../icon/transaction.png" alt="Transaction Icon"> Transaction
        <div class="dropdown-content">
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
        <img src="../icon/setting.png" alt="User Icon"> Settings
        <div class="dropdown-content">
            <a href="accountDriver.php"><img src="../icon/user.png" alt="Account Icon">My Account</a>
            <a href="aboutLogic.php"><img src="../icon/truck.png" alt="Delivery Icon">About GO SHDC</a>
            <a href="supportLogic.php"><img src="../icon/headset.png" alt="Delivery Icon">Support</a>

            <!-- Add more submenu items as needed -->
        </div>
    </div>

    <tr>
                 <div class="profile-container">

                <?php
    // Retrieve username from the session
    $username = $user_data['username'];

    // Fetch the current profile image filename and timestamp from the database
    $select_query = "SELECT filename, timestamp_column FROM image WHERE username = ? ORDER BY timestamp_column DESC LIMIT 1";
    $select_stmt = mysqli_prepare($con, $select_query);
    mysqli_stmt_bind_param($select_stmt, "s", $username);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $profile_image, $timestamp);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    // Display the profile image and timestamp if available
    if (!empty($profile_image)) {
        echo '<img src="./profile/' . $profile_image . '" alt="Profile Image" class="profile-image">';
    }
?>

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
            <?php include("driverDashboard.php"); ?>
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
