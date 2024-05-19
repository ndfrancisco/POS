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
        <?php include 'sidebar.php';?>
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
                <div class="cardBox">
                    <div class="card">
                        <div class="cardHeader">
                            <h2>Menu</h2>
                        </div>
                        <div class="cardBody">
                            <div class="menu-item">
                                <span>Hashbrown - ₱10</span>
                                <div class="button-group">
                                    <button class="plus-button" data-name="Burger" data-price="10">+</button>
                                    <button class="minus-button" data-name="Burger">-</button>
                                </div>
                            </div>
                            <div class="menu-item">
                                <span>Fries - ₱12</span>
                                <div class="button-group">
                                    <button class="plus-button" data-name="Pizza" data-price="12">+</button>
                                    <button class="minus-button" data-name="Pizza">-</button>
                                </div>
                            </div>
                            <div class="menu-item">
                                <span>Burger - ₱8</span>
                                <div class="button-group">
                                    <button class="plus-button" data-name="Salad" data-price="8">+</button>
                                    <button class="minus-button" data-name="Salad">-</button>
                                </div>
                            </div>
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
                            <!-- Receipt will be displayed here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
    <script>
        // Function to add item to order
        // Function to add item to order
		function addToOrder(itemName, itemPrice) {
			const orderList = document.getElementById('order-list');
			const newItem = document.createElement('div');
			newItem.textContent = `${itemName} - ₱${itemPrice}`;
			orderList.appendChild(newItem);
		}

		// Function to remove item from order
		function removeFromOrder(itemName) {
			const orderItems = document.querySelectorAll('#order-list div');
			orderItems.forEach(item => {
				if (item.textContent.includes(itemName)) {
					item.remove();
				}
			});
		}

		// Function to calculate total and display receipt
		function checkout() {
			const orderItems = document.querySelectorAll('#order-list div');
			let total = 0;
			orderItems.forEach(item => {
				const price = parseFloat(item.textContent.split(' - ₱')[1]);
				total += price;
			});
			const receipt = document.getElementById('receipt');
			receipt.textContent = `Total: ₱${total.toFixed(2)}`;
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
				const name = button.getAttribute('data-name');
				const price = button.getAttribute('data-price');
				addToOrder(name, price);
			});
		});

		// Add event listener to minus buttons
		document.querySelectorAll('.minus-button').forEach(button => {
			button.addEventListener('click', () => {
				const name = button.getAttribute('data-name');
				removeFromOrder(name);
			});
		});
	
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
