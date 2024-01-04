
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


</body>

</html>