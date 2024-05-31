<?php

$x = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$y = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db1';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die ("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM `login` WHERE `Username`=? AND `Password`=?");
$stmt->bind_param("ss", $x, $y);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: index.php");
} else {
    echo "Invalid username or password";
}

$stmt->close();
$conn->close();
?>
