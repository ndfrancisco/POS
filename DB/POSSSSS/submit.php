<?php

$x = $_POST['username'];
$y = $_POST['password'];
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db1';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die ("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `login` WHERE `Username`='$x' AND `Password`='$y'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: index.php");
} else {
    echo "Invalid username or password";
}
	exit();

$conn->close();
?>
