<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch orders from database
$orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../style.css" rel="stylesheet"> <!-- adjust the path based on the page location -->

    <meta charset="UTF-8">
    <title>Manage Orders - SweetBites Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SweetBites Admin</a>
            <div class="d-flex">
                <a class="btn btn-outline-light me-2" href="Admin_panel.php">Goto panel</a>
                <a class="btn btn-outline-light" href="admin_logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h3 class="mb-4">Manage Orders</h3>

        <?php if (mysqli_num_rows($orders) > 0): ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Cake Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($orders)) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['cake_name']; ?></td>
                        <td><?= $row['quantity']; ?></td>
                        <td>₹<?= $row['total_price']; ?></td>
                        <td><?= $row['order_date']; ?></td>
                        <td><?= $row['status']; ?></td>
                        <td>
                            <a href="edit_order.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_order.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-muted">No orders found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
