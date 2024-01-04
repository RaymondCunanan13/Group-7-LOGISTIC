<?php
session_start();

include("../go-shdc/connection.php");
include("functions0.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $message = $_POST['message'];
    $form_username = $user_data['username'];
    $recipient = $_POST['recipient'];
    $driver = $_POST['driver']; // Retrieve the selected driver
    $cargoDetails = $_POST['cargo_details']; // Retrieve the selected cargo from cargo_details
    $cargo = $_POST['cargo']; // Retrieve the selected cargo from cargo

    // Insert the values into the database using prepared statements
    $sql = $con->prepare("INSERT INTO progress (timestamp, username, account, message, deliver, item, cargo) VALUES (CURRENT_TIMESTAMP, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssss", $form_username, $recipient, $message, $driver, $cargoDetails, $cargo);

    if ($sql->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $sql->error . "<br>";
    }

    $sql->close();
}

$sql = "SELECT progress.*, admin.*, driver.*, progress.timestamp AS message_timestamp
        FROM progress
        LEFT JOIN admin ON progress.username = admin.username
        LEFT JOIN driver ON progress.username = driver.username
        WHERE progress.deliver = '{$user_data['username']}'
        ORDER BY progress.timestamp DESC";
$result = $con->query($sql);
?>

<!-- Rest of your HTML code remains unchanged -->

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

<div style="flex: 1;">

                <?php include("progress.php"); ?>
                </div>
<br><br>
</html>