<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS and Inventory Management</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
		
		form {
			display: flex;
			flex-direction: column;
		}

		form label {
			margin: 10px 0 5px;
			font-weight: bold;
		}

		form input[type="text"],
		form input[type="submit"] {
			padding: 10px;
			margin-bottom: 15px;
			border: 1px solid #ccc;
			border-radius: 5px;
			font-size: 16px;
		}

		form input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		form input[type="submit"]:hover {
			background-color: #45a049;
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
				transform: scale(0.95);
			}
			to {
				opacity: 1;
				transform: scale(1);
			}
		}

		
    </style>
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
                <div class="recentInfor">
                    <div class="cardHeader">
                        <h2>Inventory</h2>
                    </div>
                    <div class="inventory-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Item Id</th>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Unit Price</th>
                                    <th>Quantity in stock</th>
                                    <th>Last Purchase</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conn = mysqli_connect("localhost", "root", "", "db1");
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }
                                $sql = "SELECT * FROM inventory";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row["Item ID"] . "</td>";
                                        echo "<td>" . $row["Item Name"] . "</td>";
                                        echo "<td>" . $row["Description"] . "</td>";
                                        echo "<td>" . $row["Unit Price"] . "</td>";
                                        echo "<td>" . $row["Quantity in Stock"] . "</td>";
                                        echo "<td>" . $row["Last Purchase"] . "</td>";
                                        echo "<td><a href='#' class='edit-btn' data-id='" . $row["Item ID"] . "' data-name='" . $row["Item Name"] . "' data-description='" . $row["Description"] . "' data-price='" . $row["Unit Price"] . "' data-quantity='" . $row["Quantity in Stock"] . "'>Edit</a></td>";
                                        echo "<td><a href='#' class='add-btn'>Add</a></td>";
										echo "</tr>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Edit Item</h2>
            <form id="edit-form" action="update item.php" method="post">
                <input type="hidden" name="item_id" id="modal-item-id">
                <label for="modal-item-name">Item Name:</label>
                <input type="text" name="item_name" id="modal-item-name"><br>
                <label for="modal-description">Description:</label>
                <input type="text" name="description" id="modal-description"><br>
                <label for="modal-unit-price">Unit Price:</label>
                <input type="text" name="unit_price" id="modal-unit-price"><br>
                <label for="modal-quantity">Quantity in Stock:</label>
                <input type="text" name="quantity" id="modal-quantity"><br>
                <input type="submit" value="Save Changes">
            </form>
        </div>
    </div>


	<div id="add-modal" class="modal">
	<label for="add-last-purchase">Last Purchase:</label>
	<div class="input-group">
		<span class="calendar-icon">
			<ion-icon name="calendar-outline"></ion-icon>
		</span>
	</div>

    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Add Item</h2>
        <form id="add-form" action="process_add_item.php" method="post">
            <label for="add-item-name">Item Name:</label>
            <input type="text" name="item_name" id="add-item-name" required>
            <label for="add-description">Description:</label>
            <input type="text" name="description" id="add-description" required>
            <label for="add-unit-price">Unit Price:</label>
            <input type="text" name="unit_price" id="add-unit-price" required>
            <label for="add-quantity">Quantity in Stock:</label>
            <input type="text" name="quantity" id="add-quantity" required>
            <label for="add-last-purchase">Last Purchase:</label>
            <input type="date" name="last_purchase" id="add-last-purchase" required>
            <input type="submit" value="Add Item">
			</form>
		</div>
	</div>
	
	<script>
	// JavaScript to handle calendar icon click
	document.querySelector('.calendar-icon').addEventListener('click', function() {
		// Open date picker when the calendar icon is clicked
		document.getElementById('add-last-purchase').focus();
	});

	
    document.addEventListener('DOMContentLoaded', (event) => {
        var addModal = document.getElementById("add-modal");
        var addBtn = document.querySelector('.add-btn');

        // Function to open add item modal
        function openAddModal() {
            addModal.style.display = "block";
        }

        // Close modal when clicking the close button
        document.querySelector('#add-modal .close-btn').onclick = function() {
            addModal.style.display = "none";
        }

        // Close modal when clicking outside the modal
        window.onclick = function(event) {
            if (event.target == addModal) {
                addModal.style.display = "none";
            }
        }

        // Open add item modal when clicking the add button
        addBtn.onclick = function() {
            openAddModal();
        };
    });
	</script>

    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var modal = document.getElementById("edit-modal");
            var closeBtn = document.querySelector(".close-btn");

            function openModal(itemId, itemName, description, unitPrice, quantity) {
                document.getElementById('modal-item-id').value = itemId;
                document.getElementById('modal-item-name').value = itemName;
                document.getElementById('modal-description').value = description;
                document.getElementById('modal-unit-price').value = unitPrice;
                document.getElementById('modal-quantity').value = quantity;
                modal.style.display = "block";
            }

            closeBtn.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    var itemId = this.getAttribute('data-id');
                    var itemName = this.getAttribute('data-name');
                    var description = this.getAttribute('data-description');
                    var unitPrice = this.getAttribute('data-price');
                    var quantity = this.getAttribute('data-quantity');
                    openModal(itemId, itemName, description, unitPrice, quantity);
                });
            });
        });
    </script>
</body>
</html>
