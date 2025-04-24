<?php
session_start();
include('includes/db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user orders
$query = "SELECT o.id, o.quantity, o.address, o.phone, o.order_date, c.name AS cake_name, c.price 
          FROM orders o 
          JOIN cakes c ON o.cake_id = c.id 
          WHERE o.user_id = '$user_id' 
          ORDER BY o.order_date DESC";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">📜 Your Order History</h2>

                <?php if (mysqli_num_rows($result) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Cake Name</th>
                                    <th>Quantity</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Order Date</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($order = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $order['cake_name']; ?></td>
                                        <td><?php echo $order['quantity']; ?></td>
                                        <td><?php echo $order['address']; ?></td>
                                        <td><?php echo $order['phone']; ?></td>
                                        <td><?php echo date('d M Y, h:i A', strtotime($order['order_date'])); ?></td>
                                        <td>₹<?php echo $order['quantity'] * $order['price']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info text-center">You haven't placed any orders yet!</div>
                <?php endif; ?>
                
                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-primary">← Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
