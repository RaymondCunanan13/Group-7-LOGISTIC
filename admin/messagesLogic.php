<?php
session_start();

include("../go-shdc/connection.php");
include("functions1.php");

$user_data = check_login($con);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve values from the form
    $message = $_POST['message'];
    $form_username = $user_data['username'];
    $recipient = $_POST['recipient'];

    // Debugging: Output values for verification
    echo "Form Username: $form_username<br>";
    echo "Recipient: $recipient<br>";
    echo "Message: $message<br>";

    // Insert the values into the database using prepared statements to prevent SQL injection
    $sql = $con->prepare("INSERT INTO messages (timestamp, username, account, message) VALUES (CURRENT_TIMESTAMP, ?, ?, ?)");
    $sql->bind_param("sss", $form_username, $recipient, $message);

    // Debugging: Output the SQL query for verification
    echo "SQL Query: " . $sql->sqlstate . "<br>";

    if ($sql->execute()) {
        // Redirect to the same page to avoid form resubmission on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Debugging: Output any errors
        echo "Error: " . $sql->error . "<br>";
    }

    // Close the prepared statement
    $sql->close();
}

$sql = "SELECT messages.*, admin.*, customer.*, messages.timestamp AS message_timestamp
        FROM messages
        LEFT JOIN admin ON messages.username = admin.username
        LEFT JOIN customer ON messages.username = customer.username
        WHERE (messages.account = '{$user_data['username']}'
               OR messages.username = '{$user_data['username']}'
               OR admin.username = '{$user_data['username']}'
               OR customer.username = '{$user_data['username']}')
        ORDER BY messages.timestamp DESC";
$result = $con->query($sql);

                ?>
<!-- ... rest of your HTML code ... -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO SHDC</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>





<div id="box">
        <div id="header">
        </div>

         <div id="content" style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div style="flex: 1;">

               <img id="logo" src="../icon/go-shdc.png" alt="Logo"><br><br>


            <nav style="display: flex; justify-content: space-between; align-items: flex-start;">

       <div class="nav-link"  style="flex: 1;">
        <img src="../icon/home.png" alt="Home Icon"> Home
        <div class="dropdown-content">
            <a href="adminDashboardLogic.php"><img src="../icon/key.png" alt="Delivery Icon">Go Cargo</a>
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
            <a href="accountAdmin.php"><img src="../icon/user.png" alt="Account Icon">My Account</a>
            <a href="aboutLogic.php"><img src="../icon/truck.png" alt="Delivery Icon">About GO SHDC</a>
            <a href="supportLogic.php"><img src="../icon/headset.png" alt="Delivery Icon">Support</a>
            

            <!-- Add more submenu items as needed -->
        </div>
    </div><br><br>

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
            <h1>Hello, <?php echo $user_data['username']; ?></h1>
            <h2>Welcome to Go SHDC</h2>
            <h2>We can ship from several countries</h2><br>
        </div>
    </div>
<br><br>
<script>
    function toggleProfile() {
        var profileTable = document.getElementById("profile-table");
        profileTable.style.transition = "height 0.5s";
        profileTable.style.height = (profileTable.style.height === "0px" || !profileTable.style.height) ? "100px" : "0px";
    }


</script>


    
</body>

<div style="flex: 1;">

                <?php include("messages.php"); ?>
                </div>
<br><br>
</html>