<?php
// Retrieve form data
$item_name = $_POST['item_name'];
$description = $_POST['description'];
$unit_price = $_POST['unit_price'];
$quantity = $_POST['quantity'];
$last_purchase = $_POST['last_purchase'];

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "db1");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert new item into the database
$sql = "INSERT INTO inventory (`Item Name`, `Description`, `Unit Price`, `Quantity in Stock`, `Last Purchase`)
        VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssdis", $item_name, $description, $unit_price, $quantity, $last_purchase);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo "Item added successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close prepared statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
