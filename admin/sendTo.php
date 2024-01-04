<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Courier New', Courier, monospace;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: rgb(15, 16, 53);
            color: #fff;
        }

        .container {
            padding: 0 15px;
            width: 80%;
        }

        h2 {
            text-align: center;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #000;
            color: #fff;
        }

        /* Table header cell styling */
        .th {
            font-size: 1rem;
            padding: 15px;
            text-align: left;

        }

        /* Table data cell styling */
        td {
            padding: 15px;
            border-bottom: 1px solid #ccc;
        }

        /* Add scrollbar to the table body */
        tbody {
            max-height: 400px;
            overflow-y: auto;
            display: block;
        }

        /* Button styling */
        .btn,
        .edit-btn,
        .delete-btn {
            padding: 2px 10px;
            background-color: #42b72a;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 2px;
            cursor: pointer;
            margin-right: 2px;
        }

        /* Align buttons to the right */
        .btn-container {
            text-align: right;
            margin-top: 2px;
        }
#driver-table {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Customer Table</h2>
        <table>
            <thead>
                <tr>
                    <th class="th">Account</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "go_shdc";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM customer";
                $result = $conn->query($sql);

                if ($result !== null && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                           <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td>
                                <a class="edit-btn" href="deleteAcc.php?id=<?php echo $row['id']; ?>">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='2'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table> <br><br>

        <!-- Second table for the driver -->
        <h2>Driver Table</h2>
        <table id="driver-table">
            <thead>
                <tr>
                    <th class="th">Account</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch driver data
                $sql = "SELECT * FROM driver";
                $result = $conn->query($sql);

                if ($result !== null && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td>
                                <a class="edit-btn" href="deleteAcc.php?id=<?php echo $row['id']; ?>">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='2'>No records found</td></tr>";
                }

                // Close the connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>