<?php 
session_start();

include("../go-shdc/connection.php");
include("functions0.php");

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $username = $_POST['username']; // Change variable name from $user_name to $username
    $password = $_POST['password'];

    // Validate the input fields
    if (empty($username) || empty($password) || is_numeric($username)) {
        $errors['general'] = "Please enter valid information for all fields!";
    } else {
        // Read from the database
        $query = "SELECT * FROM driver WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $username); // Change variable name from $user_name to $username
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                
                if ($user_data['password'] === $password) {
                    $_SESSION['id'] = $user_data['id'];
                    header("Location: driverDashboardLogic.php");
                    die;
                } else {
                    $errors['password'] = "Wrong username or password!";
                }
            } 
        } else {
            $errors['general'] = "An error occurred while logging in. Please try again.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO SHDC Login Page </title>
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
    <header>
        <img src="../icon/go-shdc.png" alt="GO SHDC Logo" class="logo-img">
    </header>

    <div class="container flex">
        <div class="goshdc-page flex">
            <div class="text">
                <h1>GO SHDC</h1>
                <p>Lets start so you can create </p>
                <p>your first delivery request.</p>
            </div>
            <form method="post" onsubmit="return validateForm();">

                <input type="text" name="username" placeholder="Username" required onblur="checkInputValidity('username')">
           
            <?php if (isset($errors['general'])): ?>
                <div class="error-message" id="username-error"><?php echo $errors['general']; ?></div>
            <?php endif; ?><br>


                <div class="password-container">
                    <input type="password" name="password" id="password" required placeholder="Password" onblur="checkInputValidity('password')">
                    <img src="../icon/close-eye.png" alt="Toggle Password Visibility" class="eye-icon" id="eye-icon" onclick="togglePasswordVisibility()">
                </div>

                <?php if (isset($errors['password'])): ?>  
                    <div class="error-message"><?php echo $errors['password']; ?></div>
                <?php endif; ?><br>

                <div class="link">
                    <input id="button" type="submit" value="Login"><br>
                    <a href="forgotDriver.php" class="forgot">Forgot password?</a>
                </div>
                <hr>
                <div class="button">
                    <a href="driverSign.php">Create new account</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eye-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.src = "../icon/open-eye.png";
            } else {
                passwordInput.type = "password";
                eyeIcon.src = "../icon/close-eye.png";
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Get the username and password input elements
            var usernameInput = document.querySelector('input[type="text"]');
            var passwordInput = document.querySelector('input[type="password"]');

            // Add click event listener to the username input
            usernameInput.addEventListener('click', function () {
                // Change border color to red
                this.style.borderColor = '#ff0000';
            });

            // Add blur event listener to the username input
            usernameInput.addEventListener('blur', function () {
                // If the input is not empty, remove the red border; otherwise, keep it red
                if (this.value.trim() !== '') {
                    this.style.borderColor = '';
                }
            });

            // Add click event listener to the password input
            passwordInput.addEventListener('click', function () {
                // Change border color to red
                this.style.borderColor = '#ff0000';
            });

            // Add blur event listener to the password input
            passwordInput.addEventListener('blur', function () {
                // If the input is not empty, remove the red border; otherwise, keep it red
                if (this.value.trim() !== '') {
                    this.style.borderColor = '';
                }
            });

            // Get the logo image element
            var logoImg = document.querySelector('.logo-img');

            // Listen for the end of the roll animation
            logoImg.addEventListener('animationend', function () {
                // Show the form after the roll animation is complete
                var form = document.getElementById('myForm');
                form.style.display = 'flex'; // Display the form as a flex container
                form.style.animation = 'flipForm 1s ease-in-out 1 forwards'; // Trigger the flip animation
            });
        });

        // Function to add red-placeholder class when input is empty or there are errors
        function checkInputValidity(inputId) {
            var input = document.getElementsByName(inputId)[0];
            var errorDiv = document.getElementById(inputId + '-error');
            
            if (input.value === "" || errorDiv.innerHTML !== "") {
                input.classList.add("red-placeholder");
            } else {
                input.classList.remove("red-placeholder");
            }
        }

        // Check input validity on form submission
        function validateForm() {
            checkInputValidity('username');
            checkInputValidity('password');
            
            return (!document.getElementsByName('username')[0].classList.contains("red-placeholder") &&
                    !document.getElementsByName('password')[0].classList.contains("red-placeholder"));
        }
    </script>
</body>
</html>
