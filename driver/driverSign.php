<?php
session_start();

include("../go-shdc/connection.php");
include("functions0.php");

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $platenumber = $_POST['platenumber'];
    $drivers_license = $_POST['drivers_license'];
    $area_of_delivery = $_POST['area_of_delivery'];

    // Validate the input fields in order
    if (empty($firstname)) {
        $errors['first_name'] = "Please enter a valid first name.";
    }

    if (empty($lastname)) {
        $errors['last_name'] = "Please enter a valid last name.";
    }

    if (empty($username) || is_numeric($username)) {
        $errors['username'] = "Please enter a valid username.";
    }

    if (empty($password)) {
        $errors['password'] = "Please enter a valid password.";
    }

    if (empty($mobile) || !preg_match("/^\d{11}$/", $mobile)) {
        $errors['mobile'] = "Please enter a valid 11-digit contact number.";
    }

    if (empty($address)) {
        $errors['address'] = "Please enter a valid address.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    if (empty($age) || !filter_var($age, FILTER_VALIDATE_INT)) {
        $errors['age'] = "Please enter a valid age.";
    }

    // Validate the new input fields
    if (empty($platenumber)) {
        $errors['platenumber'] = "Please enter a valid plate number.";
    }

    if (empty($drivers_license)) {
        $errors['drivers_license'] = "Please enter a valid driver's license.";
    }

    if (empty($area_of_delivery)) {
        $errors['area_of_delivery'] = "Please enter a valid area of delivery.";
    }

    // Check if mobile, email, and username are unique only if there are no previous errors
    if (empty($errors)) {
        $check_query = "SELECT * FROM driver WHERE mobile = ? OR email = ? OR username = ?";
        $check_stmt = mysqli_prepare($con, $check_query);
        mysqli_stmt_bind_param($check_stmt, "iss", $mobile, $email, $username);
        mysqli_stmt_execute($check_stmt);
        $check_result = mysqli_stmt_get_result($check_stmt);

        if ($check_result) {
            $row = mysqli_fetch_assoc($check_result);

            if ($row && $row['mobile'] == $mobile) {
                $errors['mobile'] = "Contact number is already in use. Please use a different contact number.";
            }

            if ($row && $row['email'] == $email) {
                $errors['email'] = "Email is already in use. Please use a different email.";
            }

            if ($row && $row['username'] == $username) {
                $errors['username'] = "Username is already in use. Please choose a different username.";
            }
        } else {
            $errors['general'] = "An error occurred while checking for duplicate entries.";
        }
    }

    // If there are no errors, save to the database
    if (empty($errors)) {
        $id = uniqid();
        $insert_query = "INSERT INTO driver (id, firstname, lastname, username, password, mobile, address, gender, email, age, platenumber, drivers_license, area_of_delivery) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($insert_stmt, "sssssisssisss", $id, $firstname, $lastname, $username, $password, $mobile, $address, $gender, $email, $age, $platenumber, $drivers_license, $area_of_delivery);

        if (mysqli_stmt_execute($insert_stmt)) {
            header("Location: logDriver.php");
            die;
        } else {
            $errors['general'] = "An error occurred while registering. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO SHDC Signup Page</title>
    <link rel="stylesheet" href="../styles/signup.css">
</head>

<body>

    <div class="container flex">
        <div class="goshdc-page flex">
            <form method="post" onsubmit="return validateForm();">

                <input type="text" id="firstname" name="firstname" placeholder="First Name" required value="<?php echo isset($firstname) ? $firstname : ''; ?>" onblur="checkInputValidity('firstname')">
                <?php if (isset($errors['firstname'])): ?>
                    <div class="error-message"><?php echo $errors['firstname']; ?></div>
                <?php endif; ?><br>

                <input type="text" id="lastname" name="lastname" placeholder="Last Name" required value="<?php echo isset($lastname) ? $lastname : ''; ?>" onblur="checkInputValidity('lastname')">
                <?php if (isset($errors['lastname'])): ?>
                    <div class="error-message"><?php echo $errors['lastname']; ?></div>
                <?php endif; ?><br>

                <input type="text" id="username" name="username" placeholder="Username" required value="<?php echo isset($username) ? $username : ''; ?>" onblur="checkInputValidity('username')">
                <?php if (isset($errors['username'])): ?>
                    <div class="error-message"><?php echo $errors['username']; ?></div>
                <?php endif; ?><br>

                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Password" value="<?php echo isset($password) ? $password : ''; ?>" onblur="checkInputValidity('password')">
                    <?php if (isset($errors['password'])): ?>
                        <div class="error-message"><?php echo $errors['password']; ?></div>
                    <?php endif; ?>
                    <img src="../icon/close-eye.png" alt="Toggle Password Visibility" class="eye-icon" id="eye-icon" onclick="togglePasswordVisibility()">
                </div>

                <input type="text" id="mobile" name="mobile" placeholder="Contact Number" pattern="[0-9]{11}" required value="<?php echo isset($mobile) ? $mobile : ''; ?>" onblur="checkInputValidity('mobile')">
                <?php if (isset($errors['mobile'])): ?>
                    <div class="error-message"><?php echo $errors['mobile']; ?></div>
                <?php endif; ?><br>

                <input type="text" id="address" name="address" placeholder="Address" required value="<?php echo isset($address) ? $address : ''; ?>" onblur="checkInputValidity('address')">
                <?php if (isset($errors['address'])): ?>
                    <div class="error-message"><?php echo $errors['address']; ?></div>
                <?php endif; ?><br>

                <div>
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender">
                        <option value="m">Male</option>
                        <option value="f">Female</option>
                        <option value="o">Other</option>
                    </select><br><br>
                </div>

                <input type="text" id="email" name="email" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" value="<?php echo isset($email) ? $email : ''; ?>" onblur="checkInputValidity('email')">
                <?php if (isset($errors['email'])): ?>
                    <div class="error-message"><?php echo $errors['email']; ?></div>
                <?php endif; ?><br>

                <input type="text" id="age" name="age" placeholder="Age" value="<?php echo isset($age) ? $age : ''; ?>" onblur="checkInputValidity('age')">
                <?php if (isset($errors['age'])): ?>
                    <div class="error-message"><?php echo $errors['age']; ?></div>
                <?php endif; ?><br>


               <input type="text" id="platenumber" name="platenumber" placeholder="Plate Number" required value="<?php echo isset($platenumber) ? $platenumber : ''; ?>" onblur="checkInputValidity('platenumber')">
                <?php if (isset($errors['platenumber'])): ?>
                    <div class="error-message"><?php echo $errors['platenumber']; ?></div>
                <?php endif; ?><br>

                 <input type="text" id="drivers_license" name="drivers_license" placeholder="Driver's License" required value="<?php echo isset($drivers_license) ? $drivers_license : ''; ?>" onblur="checkInputValidity('drivers_license')">
                 <?php if (isset($errors['drivers_license'])): ?>
                     <div class="error-message"><?php echo $errors['drivers_license']; ?></div>
                <?php endif; ?><br>

                 <input type="text" id="area_of_delivery" name="area_of_delivery" placeholder="Area of Delivery" required value="<?php echo isset($area_of_delivery) ? $area_of_delivery : ''; ?>" onblur="checkInputValidity('area_of_delivery')">
                <?php if (isset($errors['area_of_delivery'])): ?>
                     <div class="error-message"><?php echo $errors['area_of_delivery']; ?></div>
                <?php endif; ?><br>


                <?php if (isset($errors['general'])): ?>
                    <div class="error-message"><?php echo $errors['general']; ?></div>
                <?php endif; ?>

                <input type="checkbox" id="agreeTerms" name="agreeTerms" required onclick="myFunction()">
                <label for="agreeTerms" class="checkbox-label">
                    I agree to the <a href="terms.html" class="terms-link">terms & conditions</a> and Privacy Policy
                </label><br>

                <input id="button" type="submit" value="Signup"><br><br>

                <div class="button">
                    <a href="logDriver.php">Already Have an Account</a>
                </div>

            </form>
        </div>
    </div>

    <script>
        // Function to toggle password visibility
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

        // Function to handle checkbox click event
        function myFunction() {
            var checkbox = document.getElementById("agreeTerms");
            var checkboxLabel = document.querySelector(".checkbox-label");

            if (checkbox.checked) {
                checkboxLabel.style.color = "#42b72a";
            } else {
                checkboxLabel.style.color = "#fff";
            }
        }

        // Function to add click and blur event listeners to input field
        function addRedBorderEffect(inputElement) {
            // Add click event listener to the input
            inputElement.addEventListener('click', function () {
                // Change border color to red
                this.style.borderColor = '#ff0000';
            });

            // Add blur event listener to the input
            inputElement.addEventListener('blur', function () {
                // If the input is not empty, remove the red border; otherwise, keep it red
                if (this.value.trim() !== '') {
                    this.style.borderColor = '';
                }
            });
        }

        // Get references to all input fields
        var allInputs = document.querySelectorAll('input[required], select');

        // Apply red border effect to all input fields
        allInputs.forEach(function (input) {
            addRedBorderEffect(input);
        });
    </script>
</body>

</html>
