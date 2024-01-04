<?php
error_reporting(0);

$msg = "";

session_start();

include("../go-shdc/connection.php");
include("functions0.php");

$user_data = check_login($con);

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Handling cargo details form submission
    $cargo_name = $_POST['cargo_name'];
    // ... (rest of your cargo details handling logic)

    // Validate the input fields (similar to your previous validation logic)

    // If there are no errors, save to the database
    if (empty($errors)) {
        // ... (rest of your cargo details saving logic)

        // File upload logic
        if (isset($_FILES['uploadfile'])) {
            $filename = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            $folder = "./profile/" . $filename;

            $folderPath = "./profile";

            // Check if the folder exists, if not, create it
            if (!is_dir($folderPath)) {
                mkdir($folderPath);
            }

            // Retrieve username from the session
            $username = $user_data['username'];

            // Save data to the database
            $insert_query = "INSERT INTO image (filename, username) VALUES (?, ?)";
            $insert_stmt = mysqli_prepare($con, $insert_query);
            mysqli_stmt_bind_param($insert_stmt, "ss", $filename, $username);

            if (mysqli_stmt_execute($insert_stmt)) {
                // Now let's move the uploaded image into the folder: profile
                if (move_uploaded_file($tempname, $folder)) {
                    echo "<h3> Image uploaded successfully!</h3>";

                    // Redirect to accountDriver.php after successful upload
                    header("Location: accountDriver.php");
                    exit(); // Ensure that no further code is executed after the header
                } else {
                    echo "<h3> Failed to upload image!</h3>";
                }
            } else {
                echo "<h3> Failed to save image details!</h3>";
            }
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
            <a href="driverDashboardLogic.php"><img src="../icon/key.png" alt="Delivery Icon">Go Cargo</a>
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
                <div class="green-button">
                    <a href="../go-shdc/go-shdc.php">Logout</a>
                </div>
            </table>
        </div>
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
            <h2>Welcome to Go SHDC</h2>
            <h2>We can ship from several countries</h2><br>
            <h1>Upload profile</h1>
           



        <form method="POST" action="accountDriver.php" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="green-button" type="submit" name="upload">UPLOAD</button>
            </div>
        </form>
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

            <h1>Username: <?php echo $user_data['username']; ?></h1>     
            <h1>Firstname:<?php echo $user_data['firstname']; ?></h1>
            <h1>Lastname: <?php echo $user_data['lastname']; ?></h1>
            <h1>Mobile No:<?php echo $user_data['mobile']; ?></h1>
            <h1>Address:<?php echo $user_data['address']; ?></h1>
            <h1>Gender: <?php echo $user_data['gender']; ?></h1>
            <h1>Age: <?php echo $user_data['age']; ?> years old</h1>

        <br><br></div>
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