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

// Check if an ID is passed to delete the record
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the record based on the ID
    $sql = "DELETE FROM datatable WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
        header("Location: display_data.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

