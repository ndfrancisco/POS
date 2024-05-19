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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Database connection
                                $conn = mysqli_connect("localhost", "root", "", "db1");
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                // SQL query to fetch inventory data
                                $sql = "SELECT * FROM inventory";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    // Output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row["Item ID"] . "</td>";
                                        echo "<td>" . $row["Item Name"] . "</td>";
                                        echo "<td>" . $row["Description"] . "</td>";
                                        echo "<td>" . $row["Unit Price"] . "</td>";
                                        echo "<td>" . $row["Quantity in Stock"] . "</td>";
                                        echo "<td>" . $row["Last Purchase"] . "</td>";
										echo "<td><a href='edit item.php?id=" . $row["Item ID"] . "'>Edit</a></td>";
										echo "<td><a href='additem.php?id=" . $row["Item ID"] . "'>Add</a></td>";
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
	

    <script src="assets/js/main.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
