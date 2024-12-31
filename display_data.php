<?php
// Database connection
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
$sql = "SELECT * FROM datatable";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Data</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f1f1f1;
        }
        .action-btn {
            margin: 5px;
            padding: 5px 10px;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .add-btn {
            background-color: #008CBA;
            color: white;
            margin: 20px auto;
            display: block;
            padding: 10px 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1 style="text-align: center;">Manage Data</h1>
    
    <a href="add_data.php" class="add-btn">Add New Data</a>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Quotes</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['quotes']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="edit_data.php?id=<?php echo $row['id']; ?>" class="action-btn edit-btn">Edit</a>
                            <a href="delete_data.php?id=<?php echo $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center;">No records found.</p>
    <?php endif; ?>

    <?php
    // Close the connection
    $conn->close();
    ?>

</body>
</html>
