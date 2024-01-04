<?php 
session_start();

include("../go-shdc/connection.php");
include("functions.php");

$user_data = check_login($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <link rel="stylesheet" href="../styles/account.css">
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
            <a href="aboutLogic.php"><img src="../icon/truck.png" alt="Delivery Icon">Available Truck</a>
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
                <div class="green-button">
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

                <?php include("about.html"); ?>
                </div>

</html>
