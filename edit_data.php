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

// Check if an ID is passed to edit data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to retrieve the record based on the ID
    $sql = "SELECT * FROM datatable WHERE id = $id";
    $result = $conn->query($sql);

    // Fetch the data
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $full_name = $row['full_name'];
        $quotes = $row['quotes'];
        $email = $row['email'];
    } else {
        echo "No record found";
        exit;
    }
} else {
    echo "No ID specified for editing.";
    exit;
}

// Handle form submission for updating data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $quotes = $_POST['quotes'];
    $email = $_POST['email'];

    // Update the record in the database
    $sql = "UPDATE datatable SET full_name='$full_name', quotes='$quotes', email='$email' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
        header("Location: display_data.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <style>
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

<h1>Edit Data</h1>

<form method="POST" action="edit_data.php?id=<?php echo $id; ?>">
    <label for="full_name">Full Name:</label>
    <input type="text" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>" required>

    <label for="quotes">Quotes:</label>
    <textarea name="quotes" required><?php echo htmlspecialchars($quotes); ?></textarea>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

    <button type="submit">Update Data</button>
</form>

</body>
</html>
