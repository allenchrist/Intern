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

// Handle form submission for adding data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $quotes = $_POST['quotes'];
    $email = $_POST['email'];

    // Insert the data into the database
    $sql = "INSERT INTO datatable (full_name, quotes, email) VALUES ('$full_name', '$quotes', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully.";
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
    <title>Add Data</title>
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

<h1>Add New Data</h1>

<form method="POST" action="add_data.php">
    <label for="full_name">Full Name:</label>
    <input type="text" name="full_name" required>

    <label for="quotes">Quotes:</label>
    <textarea name="quotes" required></textarea>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <button type="submit">Add Data</button>
</form>

</body>
</html>

