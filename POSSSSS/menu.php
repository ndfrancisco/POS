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
                <!-- Insert the HTML code here -->
                <div class="cardBox">
                    <div class="card">
                        <div class="cardHeader">
                            <h2>Box 1</h2>
                        </div>
                        <div class="cardBody">
                            <!-- Content for Box 1 -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardHeader">
                            <h2>Box 2</h2>
                        </div>
                        <div class="cardBody">
                            <!-- Content for Box 2 -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardHeader">
                            <h2>Box 3</h2>
                        </div>
                        <div class="cardBody">
                            <!-- Content for Box 3 -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="cardHeader">
                            <h2>Box 4</h2>
                        </div>
                        <div class="cardBody">
                            <!-- Content for Box 4 -->
                        </div>
                    </div>
                </div>
                <!-- End of inserted HTML code -->
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
