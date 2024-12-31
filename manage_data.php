<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Data (Create)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $full_name = $_POST['full_name'];
    $quotes = $_POST['quotes'];
    $email = $_POST['email'];

    // Insert the data into the database
    $sql = "INSERT INTO datatable (full_name, quotes, email) VALUES ('$full_name', '$quotes', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully.<br>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Edit Data (Update)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $quotes = $_POST['quotes'];
    $email = $_POST['email'];

    // Update the record in the database
    $sql = "UPDATE datatable SET full_name='$full_name', quotes='$quotes', email='$email' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.<br>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Delete Data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Delete the record from the database
    $sql = "DELETE FROM datatable WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.<br>";
    } else {
        echo "Error: " . $conn->error;
    }
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
        label, input, textarea {
            display: block;
            width: 100%;
            margin: 10px 0;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1 style="text-align: center;">Manage Data</h1>

<!-- Add New Data Form -->
<h2>Add New Data</h2>
<form method="POST" action="manage_data.php">
    <label for="full_name">Full Name:</label>
    <input type="text" name="full_name" required>

    <label for="quotes">Quotes:</label>
    <textarea name="quotes" required></textarea>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <button type="submit" name="add">Add Data</button>
</form>

<!-- Display All Data -->
<h2>All Data</h2>
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
                        <!-- Edit Button -->
                        <a href="manage_data.php?edit=<?php echo $row['id']; ?>" class="action-btn edit-btn">Edit</a>
                        <!-- Delete Button -->
                        <a href="manage_data.php?delete=<?php echo $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p style="text-align: center;">No records found.</p>
<?php endif; ?>

<!-- Edit Data Form (if editing) -->
<?php
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    // SQL query to retrieve the record based on the ID
    $sql = "SELECT * FROM datatable WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <h2>Edit Data</h2>
        <form method="POST" action="manage_data.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" value="<?php echo $row['full_name']; ?>" required>

            <label for="quotes">Quotes:</label>
            <textarea name="quotes" required><?php echo $row['quotes']; ?></textarea>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

            <button type="submit" name="edit">Update Data</button>
        </form>
        <?php
    }
}
?>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
