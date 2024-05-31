<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch purchase invoice data
$sql = "SELECT PurchaseDate, ReferenceNumber, ItemName, Quantity, Price, Total FROM purchase_invoice";
$result = $conn->query($sql);

$invoices = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $invoices[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS and Inventory Management</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                <div class="user">
                    <img src="" alt="">
                </div>
            </div>
            <div class="details">
                <div class="recentInfor">
                    <div class="cardHeader">
                        <h2>Purchase Invoices</h2>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Purchase Date</th>
                                <th>Reference Number</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($invoices as $invoice): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($invoice['PurchaseDate']); ?></td>
                                    <td><?php echo htmlspecialchars($invoice['ReferenceNumber']); ?></td>
                                    <td><?php echo htmlspecialchars($invoice['ItemName']); ?></td>
                                    <td><?php echo htmlspecialchars($invoice['Quantity']); ?></td>
                                    <td>₱<?php echo htmlspecialchars(number_format($invoice['Price'], 2)); ?></td>
                                    <td>₱<?php echo htmlspecialchars(number_format($invoice['Total'], 2)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
