<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Input</title>
    <link rel="stylesheet" href="../styles/messages.css">
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Notification</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result !== null && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                   <tr>
                        <td><?php echo $row['username']; ?> </td>
                        <td></td>
                        <td>Messages:<?php echo $row['message']; ?></td>
                        <td>[<?php echo $row['timestamp']; ?>]</td>
                        <td>reply to: <?php echo $row['account']; ?></td>
                    </tr>
                <?php
                }
            } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h1>Message the Custoner and Admin</h1>
    <form action="messagesLogic.php" method="post">
        <?php
        // Fetch usernames from the 'admin' table
        $adminQuery = "SELECT username FROM admin";
        $adminResult = $con->query($adminQuery);

        // Fetch usernames from the 'customer' table (updated from 'driver' table)
        $customerQuery = "SELECT username FROM customer";
        $customerResult = $con->query($customerQuery);
        ?>

        <!-- Add a dropdown list for selecting the recipient -->
        <label for="recipient">Recipient:</label>
        <select name="recipient" required>
            <?php
            // Display usernames from the 'admin' table
            while ($adminRow = $adminResult->fetch_assoc()) {
                echo "<option value='{$adminRow['username']}'>{$adminRow['username']}</option>";
            }

            // Display usernames from the 'customer' table
            while ($customerRow = $customerResult->fetch_assoc()) {
                echo "<option value='{$customerRow['username']}'>{$customerRow['username']}</option>";
            }
            ?>
        </select><br>

        <!-- Label for the message -->
        <label for="message">Message:</label>
        <textarea name="message" rows="4" cols="50" required></textarea><br>

        <!-- Submit button -->
        <input type="submit" name="submit" value="Send Message">
    </form>
</body>

</html>

<?php
// Close the database connection
$con->close();
?>
