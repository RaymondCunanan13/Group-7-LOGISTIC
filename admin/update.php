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

if (isset($_POST['update'])) {
    $cargo_id = $_POST['cargo_id'];
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
    $situation = $_POST['situation']; // Added situation field

    $sql = "UPDATE `cargo_details` SET `cargo_name`='$cargo_name', `pickup_point`='$pickup_point', `dropoff_point`='$dropoff_point', `weight`='$weight', `length`='$length', `width`='$width', `height`='$height', `distance`='$distance', `rate`='$rate', `currency`='$currency', `situation`='$situation' WHERE `id`='$cargo_id'";

    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $cargo_id = $_GET['id'];
    $sql = "SELECT * FROM `cargo_details` WHERE `id`='$cargo_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cargo_name = $row['cargo_name'];
            $pickup_point = $row['pickup_point'];
            $dropoff_point = $row['dropoff_point'];
            $weight = $row['weight'];
            $length = $row['length'];
            $width = $row['width'];
            $height = $row['height'];
            $distance = $row['distance'];
            $rate = $row['rate'];
            $currency = $row['currency'];
            $situation = $row['situation']; // Added situation field
            $cargo_id = $row['id'];
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>GO SHDC Update</title>
            <link rel="stylesheet" href="../styles/signup.css">
        </head>

        <body style="background: rgb(15, 16, 53);">
            <form action="" method="post">
                <fieldset>
                    <h2>Cargo Update Form</h2><br>
                    Cargo Name:<br>
                    <input type="text" name="cargo_name" value="<?php echo $cargo_name; ?>">
                    <input type="hidden" name="cargo_id" value="<?php echo $cargo_id; ?>">
                    <br>
                    Pickup Point:<br>
                    <input type="text" name="pickup_point" value="<?php echo $pickup_point; ?>">
                    <br>
                    Dropoff Point:<br>
                    <input type="text" name="dropoff_point" value="<?php echo $dropoff_point; ?>">
                    <br>
                    Weight:<br>
                    <input type="text" name="weight" value="<?php echo $weight; ?>">
                    <br>
                    Length:<br>
                    <input type="text" name="length" value="<?php echo $length; ?>">
                    <br>
                    Width:<br>
                    <input type="text" name="width" value="<?php echo $width; ?>">
                    <br>
                    Height:<br>
                    <input type="text" name="height" value="<?php echo $height; ?>">
                    <br>
                    Distance:<br>
                    <input type="text" name="distance" value="<?php echo $distance; ?>">
                    <br>
                    Rate:<br>
                    <input type="text" name="rate" value="<?php echo $rate; ?>">
                    <br>
                    Currency:<br>
                    <input type="text" name="currency" value="<?php echo $currency; ?>">
                    <br>
                    Situation:<br>
                    <input type="text" name="situation" value="<?php echo $situation; ?>">
                    <br><br>
                    <input type="submit" value="Update" name="update">

                     <div class="button">
                    <a href="adminDashboardLogic.php">Go Back</a>
                </div>
                </fieldset>
            </form>
        </body>

        </html>
        <?php
    } else {
        header('Location: pend.php');
    }
}
?>
