

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO SHDC Driver Page</title>
    <link rel="stylesheet" href="../styles/signup.css">
</head>

<body>

    <div class="container flex">
        <div class="goshdc-page flex">
            <form method="post" onsubmit="return validateForm();">

                 <div>
                    <label for="carname">Car Name:</label>
                    <select id="carname" name="carname">
                        <option value="Compact Car">Compact Car</option>
                        <option value="Sedan">Sedan</option>
                        <option value="SUV">SUV</option>
                        <option value="Pickup Truck">Pickup Truck</option>
                        <option value="Van">Van</option>
                        <option value="Box Truck (Small)">Box Truck (Small)</option>
                        <option value="Box Truck (Medium)">Box Truck (Medium)</option>
                        <option value="Box Truck (Large)">Box Truck (Large)</option>
                        <option value="Bus (Standard)">Bus (Standard)</option>
                        <option value="Tractor Trailer">Tractor Trailer</option>
                        <option value="Motorcycle">Motorcycle</option>

                    </select><br><br>
                </div>

                <input type="text" id="maxweight" name="maxweight" placeholder="Max Weight" required value="<?php echo isset($maxweight) ? $maxweight : ''; ?>" onblur="checkInputValidity('maxweight')">
                <?php if (isset($errors['maxweight'])): ?>
                    <div class="error-message"><?php echo $errors['maxweight']; ?></div>
                <?php endif; ?><br>


                <input type="text" id="location" name="location" placeholder="Location" required value="<?php echo isset($location) ? $location : ''; ?>" onblur="checkInputValidity('location')">
                <?php if (isset($errors['location'])): ?>
                    <div class="error-message"><?php echo $errors['location']; ?></div>
                <?php endif; ?><br>

                

                <div>
                    <label for="loadingtime">Loading Time:</label>
                    <select id="loadingtime" name="loadingtime">
                        <option value="Special Time">Special Time</option>
                        <option value="6:00 am">6:00 am</option>
                        <option value="7:00 am">7:00 am</option>
                        <option value="8:00 am">8:00 am</option>
                        <option value="9:00 pm">9:00 pm</option>
                        <option value="10:00 pm">10:00 pm</option>
                        <option value="12:00 pm">12:00 pm</option>

                    </select><br><br>
                </div>

                   <div>
                    <label for="unloadingtime">Unloading Time:</label>
                    <select id="unloadingtime" name="unloadingtime">
                        <option value="Special Time">Special Time</option>
                        <option value="6:00 am">6:00 am</option>
                        <option value="7:00 am">7:00 am</option>
                        <option value="8:00 am">8:00 am</option>
                        <option value="9:00 pm">9:00 pm</option>
                        <option value="10:00 pm">10:00 pm</option>
                        <option value="12:00 pm">12:00 pm</option>

                    </select><br><br>
                </div>


                


                 <input type="text" id="length" name="length" placeholder="Length " required value="<?php echo isset($length) ? $length : ''; ?>" onblur="checkInputValidity('legth')">
                <?php if (isset($errors['length'])): ?>
                    <div class="error-message"><?php echo $errors['length']; ?></div>
                <?php endif; ?><br>

                <input type="text" id="width" name="width" placeholder="Width " required value="<?php echo isset($width) ? $width : ''; ?>" onblur="checkInputValidity('width')">
                <?php if (isset($errors['width'])): ?>
                    <div class="error-message"><?php echo $errors['width']; ?></div>
                <?php endif; ?><br>

                <input type="text" id="height" name="height" placeholder="Height " required value="<?php echo isset($height) ? $height : ''; ?>" onblur="checkInputValidity('height')">
                <?php if (isset($errors['height'])): ?>
                    <div class="error-message"><?php echo $errors['height']; ?></div>
                <?php endif; ?><br>

                <?php if (isset($errors['general'])): ?>
                    <div class="error-message"><?php echo $errors['general']; ?></div>
                <?php endif; ?>


                <input id="button" type="submit" value="Go Deliver"><br><br>
                 
                <div class="button">
                    <a href="progressLogic.php">See your package to deliver</a>
                </div>

            </form>
        </div>
    </div>

    <script>
       

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
