<?php
$item_id = $_POST['item_id'];
$new_item_name = $_POST['item_name'];
$new_description = $_POST['description'];

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "db1");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Update the item details in the database
$sql = "UPDATE inventory SET `Item Name` = '$new_item_name', `Description` = '$new_description' WHERE `Item ID` = $item_id";
if (mysqli_query($conn, $sql)) {
    header("Location: inventory.php");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
