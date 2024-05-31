<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['items']) || !is_array($data['items'])) {
    echo json_encode(['success' => false, 'message' => 'No items provided']);
    exit;
}

// Initialize variables for sales report calculation
$total_sales = 0;
$net_profit = 0;
$items_sold = count($data['items']);

foreach ($data['items'] as $menu_id) {
    // Retrieve the list of ingredient IDs and quantities for the given menu item ID
    $sql = "SELECT `ItemID`, `Quantity` FROM menu_ingredients WHERE `MenuID` = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'SQL error: ' . $conn->error]);
        exit;
    }
    $stmt->bind_param("i", $menu_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ingredient_id = $row['ItemID'];
            $quantity = $row['Quantity'];

            // Update the inventory quantity for each ingredient
            $update_sql = "UPDATE inventory SET `Quantity in Stock` = `Quantity in Stock` - ? WHERE `Item ID` = ?";
            $update_stmt = $conn->prepare($update_sql);
            if ($update_stmt === false) {
                echo json_encode(['success' => false, 'message' => 'SQL error: ' . $conn->error]);
                exit;
            }
            $update_stmt->bind_param("ii", $quantity, $ingredient_id);
            $update_stmt->execute();

            if ($update_stmt->affected_rows === 0) {
                echo json_encode(['success' => false, 'message' => 'No rows updated, check inventory ID and stock for Item ID: ' . $ingredient_id]);
                exit;
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No ingredients found for menu item ID: ' . $menu_id]);
        exit;
    }
    
    // Calculate total sales for the current item
    $menu_sql = "SELECT `Unit Price` FROM menu WHERE `Menu ID` = ?";
    $menu_stmt = $conn->prepare($menu_sql);
    $menu_stmt->bind_param("i", $menu_id);
    $menu_stmt->execute();
    $menu_result = $menu_stmt->get_result();
    $menu_row = $menu_result->fetch_assoc();
    $item_price = $menu_row['Unit Price'];
    
    $total_sales += $item_price;
    // Assuming a constant cost for ingredients, you can calculate net profit here
    
}

// Update the sales report
$insert_sql = "INSERT INTO sales_report (`Date`, `TotalSales`, `NetProfit`, `ItemsSold`) VALUES (NOW(), ?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("ddi", $total_sales, $net_profit, $items_sold);
$insert_stmt->execute();

if ($insert_stmt->affected_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Failed to update sales report']);
    exit;
}

$conn->close();
echo json_encode(['success' => true, 'message' => 'Inventory and sales report updated successfully']);
?>
