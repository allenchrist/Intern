<?php
$servername="localhost";
$username="root";
$password="";
$dbname="mydatabase";

$conn=new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error)
{
    die("Connection failed: ". $conn->connect_error);

}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name= $_POST['name'];
    $quotes= $_POST['quotes'];
    $email= $_POST['email'];
    $pass= $_POST['pass'];

   
   

    $sql ="INSERT INTO datatable (full_name,quotes,email,pass) values('$name','$quotes','$email','$pass')";

    if ($conn ->query($sql) === TRUE){
        echo "New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();