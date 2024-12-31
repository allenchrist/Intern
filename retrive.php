<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname,3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve data
$sql = "SELECT full_name, quotes, email FROM datatable";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Data from Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f1f1f1;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .no-data {
            text-align: center;
            font-size: 18px;
            color: #999;
        }
    </style>
</head>
<body>

    <h1>Data from Database</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Quotes</th>
                    <th>Email</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['full_name']); ?></td>
                        <td><?= htmlspecialchars($row['quotes']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">No records found</p>
    <?php endif; ?>

    <?php
    // Close the connection
    $conn->close();
    ?>

</body>
</html>
