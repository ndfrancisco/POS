<?php

$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "db1";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch menu data
$sql = "SELECT `Menu ID`, `Item Name`, `Description`, `Unit Price` FROM menu";
$result = $conn->query($sql);

$menu_items = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menu_items[] = $row;
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
    <link rel="stylesheet" href="menu.css">
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
                    <ion-icon name="cart-outline"></ion-icon>
                </div>
            </div>
            <div class="details">
                <div class="cardBox">
                    <div class="card">
                        <div class="cardHeader">
                            <h2>Menu</h2>
                        </div>
                        <div class="cardBody">
                            <?php foreach ($menu_items as $item): ?>
                                <div class="menu-item">
                                    <span><?php echo htmlspecialchars($item['Item Name']); ?> - ₱<?php echo htmlspecialchars($item['Unit Price']); ?></span>
                                    <div class="button-group">
                                        <button class="plus-button" data-id="<?php echo htmlspecialchars($item['Menu ID']); ?>" data-name="<?php echo htmlspecialchars($item['Item Name']); ?>" data-price="<?php echo htmlspecialchars($item['Unit Price']); ?>">+</button>
                                        <button class="minus-button" data-id="<?php echo htmlspecialchars($item['Menu ID']); ?>" data-name="<?php echo htmlspecialchars($item['Item Name']); ?>">-</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardHeader">
                            <h2>Order</h2>
                        </div>
                        <div class="cardBody" id="order-list">
                            <!-- Order items will be added here -->
                        </div>
                        <div class="cardFooter">
                            <button onclick="checkout()">Checkout</button>
                            <button onclick="clearOrder()">Clear Order</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardHeader">
                            <h2>Receipt</h2>
                        </div>
                        <div class="cardBody" id="receipt">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
    <script>
        // Function to add item to order
        function addToOrder(itemId, itemName, itemPrice) {
            const orderList = document.getElementById('order-list');
            const newItem = document.createElement('div');
            newItem.setAttribute('data-id', itemId);
            newItem.textContent = `${itemName} - ₱${itemPrice}`;
            orderList.appendChild(newItem);
        }

        // Function to remove item from order
        function removeFromOrder(itemId) {
            const orderItems = document.querySelectorAll('#order-list div');
            orderItems.forEach(item => {
                if (item.getAttribute('data-id') == itemId) {
                    item.remove();
                }
            });
        }
		
		function checkout() {
			const orderItems = document.querySelectorAll('#order-list div');
			let total = 0;
			let items = [];
			orderItems.forEach(item => {
				const itemId = item.getAttribute('data-id');
				const price = parseFloat(item.textContent.split(' - ₱')[1]);
				total += price;
				items.push(itemId);
			});
			const receipt = document.getElementById('receipt');
			receipt.textContent = `Total: ₱${total.toFixed(2)}`;
    
			fetch('update_inventory.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({ items: items })
			}).then(response => response.json())
			.then(data => {
				if (data.success) {
					alert('Inventory updated successfully');
					clearOrder();
				} else {
					alert('Failed to update inventory: ' + data.message);
				}
			}).catch(error => {
				console.error('Error:', error);
				alert('An error occurred while updating inventory.');
			});
		}

        // Function to clear order
        function clearOrder() {
            const orderList = document.getElementById('order-list');
            orderList.innerHTML = '';
            const receipt = document.getElementById('receipt');
            receipt.textContent = '';
        }

        // Add event listener to plus buttons
        document.querySelectorAll('.plus-button').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const price = button.getAttribute('data-price');
                addToOrder(id, name, price);
            });
        });

        // Add event listener to minus buttons
        document.querySelectorAll('.minus-button').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                removeFromOrder(id);
            });
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
