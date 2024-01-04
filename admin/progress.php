
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Input</title>
    <link rel="stylesheet" href="../styles/progress.css">
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Cargo Progress</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result !== null && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td>[<?php echo $row['timestamp']; ?>]</td>
                        <td>Progress:<?php echo $row['message']; ?></td
                        <td></td>
                        <td>From: <?php echo $row['username']; ?> </td>
                        <td>item:<?php echo $row['item']; ?></td>
                        <td>cargo:<?php echo $row['cargo']; ?></td>
                        <td>driver: <?php echo $row['deliver']; ?></td>
                    </tr>
                <?php
                }
            } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h1>Update the Customer or Driver</h1>
    <form action="messagesLogic.php" method="post">
        <?php
        // Fetch usernames from the 'customer' table
        $customerQuery = "SELECT username FROM customer";
        $customerResult = $con->query($customerQuery);

        // Fetch usernames from the 'driver' table
        $driverQuery = "SELECT username FROM driver";
        $driverResult = $con->query($driverQuery);

        // Fetch cargo details from the 'cargo_details' table
        $cargoDetailsQuery = "SELECT cargo_name FROM cargo_details";
        $cargoDetailsResult = $con->query($cargoDetailsQuery);

        // Fetch cargo names from the 'cargo' table
        $cargoQuery = "SELECT carname FROM cargo";
        $cargoResult = $con->query($cargoQuery);
        ?>

        <!-- Add a dropdown list for selecting the recipient (Customer) -->
        <label for="recipient">Recipient:</label>
        <select name="recipient" required>
            <?php
            while ($customerRow = $customerResult->fetch_assoc()) {
                echo "<option value='{$customerRow['username']}'>{$customerRow['username']} (Customer)</option>";
            }
            ?>
        </select><br>

        <!-- Add a new dropdown list for selecting the driver -->
        <label for="driver">Select Driver:</label>
        <select name="driver" required>
            <?php
            while ($driverRow = $driverResult->fetch_assoc()) {
                echo "<option value='{$driverRow['username']}'>{$driverRow['username']}</option>";
            }
            ?>
        </select><br>

        <!-- Add the dropdown list for selecting the cargo_details -->
        <label for="cargo_details">Select Item:</label>
        <select name="cargo_details" required>
            <?php
            while ($cargoDetailsRow = $cargoDetailsResult->fetch_assoc()) {
                echo "<option value='{$cargoDetailsRow['cargo_name']}'>{$cargoDetailsRow['cargo_name']}</option>";
            }
            ?>
        </select><br>

        <!-- Add the dropdown list for selecting the cargo -->
        <label for="cargo">Select Cargo:</label>
        <select name="cargo" required>
            <?php
            while ($cargoRow = $cargoResult->fetch_assoc()) {
                echo "<option value='{$cargoRow['carname']}'>{$cargoRow['carname']}</option>";
            }
            ?>
        </select><br>

        <!-- Label for the message -->
        <label for="message">Details:</label>
        <textarea name="message" rows="4" cols="50" required></textarea><br>

        <!-- Submit button -->
        <input type="submit" name="submit" value="Item Progress">
    </form>

</body>

</html>