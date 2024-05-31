<?php
include 'db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];
    $address = $_POST['address'];

    if ($_POST['action'] === 'add') {
        $stmt = $pdo->prepare("INSERT INTO suppliers (name, contact_name, contact_email, contact_phone, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $contact_name, $contact_email, $contact_phone, $address]);
    } elseif ($_POST['action'] === 'edit') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("UPDATE suppliers SET name = ?, contact_name = ?, contact_email = ?, contact_phone = ?, address = ? WHERE id = ?");
        $stmt->execute([$name, $contact_name, $contact_email, $contact_phone, $address, $id]);
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM suppliers WHERE id = ?");
    $stmt->execute([$id]);
}

// Fetch suppliers
$stmt = $pdo->prepare("SELECT * FROM suppliers");
$stmt->execute();
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    
    <?php include 'sidebar.php';?>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>

      
            <div class="details">
                <div class="recentInfor">
                    <div class="cardHeader">

			<h2>Supplier Management</h2>

			<h3>Add/Edit Supplier</h3>
			<form action="supplier.php" method="post">
				<input type="hidden" name="id" id="id">
				<input type="hidden" name="action" id="action" value="add">
				<label for="name">Name:</label>
				<input type="text" name="name" id="name" required><br>
				<label for="contact_name">Contact Name:</label>
				<input type="text" name="contact_name" id="contact_name"><br>
				<label for="contact_email">Contact Email:</label>
				<input type="email" name="contact_email" id="contact_email"><br>
				<label for="contact_phone">Contact Phone:</label>
				<input type="text" name="contact_phone" id="contact_phone"><br>
				<label for="address">Address:</label>
				<textarea name="address" id="address"></textarea><br>
				<button type="submit">Submit</button>
			</form>

			<h3>Supplier List</h3>
			<table border="1">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Contact Name</th>
					<th>Contact Email</th>
					<th>Contact Phone</th>
					<th>Address</th>
					<th>Actions</th>
				</tr>
				<?php foreach ($suppliers as $supplier): ?>
					<tr>
						<td><?php echo htmlspecialchars($supplier['id']); ?></td>
						<td><?php echo htmlspecialchars($supplier['name']); ?></td>
						<td><?php echo htmlspecialchars($supplier['contact_name']); ?></td>
						<td><?php echo htmlspecialchars($supplier['contact_email']); ?></td>
						<td><?php echo htmlspecialchars($supplier['contact_phone']); ?></td>
						<td><?php echo htmlspecialchars($supplier['address']); ?></td>
						<td>
							<a href="javascript:void(0);" onclick="editSupplier(<?php echo htmlspecialchars(json_encode($supplier)); ?>)">Edit</a> |
							<a href="supplier.php?delete=<?php echo htmlspecialchars($supplier['id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>

			<script>
			function editSupplier(supplier) {
				document.getElementById('id').value = supplier.id;
				document.getElementById('name').value = supplier.name;
				document.getElementById('contact_name').value = supplier.contact_name;
				document.getElementById('contact_email').value = supplier.contact_email;
				document.getElementById('contact_phone').value = supplier.contact_phone;
				document.getElementById('address').value = supplier.address;
				document.getElementById('action').value = 'edit';
			}
			</script>
