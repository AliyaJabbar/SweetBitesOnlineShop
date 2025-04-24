<?php
session_start();

// Check if the cart exists and is not empty
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: cart.php"); // Redirect to cart page if cart is empty
    exit();
}

// Calculate total price from cart items
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - SweetBites</title>
    <!-- Link to External Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Internal CSS for custom styles -->
    <style>
        body {
            background-color: #f8f0f4; /* Rose light background for the page */
        }

        .card {
            background-color: #fce4ec; /* Rose background for the card */
        }

        .btn-rose {
            background-color: #e91e63; /* Rose color for the button */
            color: white;
            font-size: 1.1em;
        }

        .btn-rose:hover {
            background-color: #c2185b; /* Darker rose shade for the button hover */
        }

        .btn-rose:focus {
            box-shadow: none;
        }

        .container {
            max-width: 800px;
        }

        h2 {
            color: #e91e63;
        }

        .card-header {
            background-color: #f8f0f4;
        }

        .order-details {
            margin-top: 20px;
        }

        .order-details h4 {
            color: #e91e63;
        }

        .order-summary {
            margin-top: 15px;
        }

        .order-summary .item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .order-summary .item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Checkout</h2>

        <div class="order-details">
            <h4>Your Order</h4>
            <div class="order-summary">
                <?php foreach ($_SESSION['cart'] as $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                ?>
                    <div class="item">
                        <strong><?php echo $item['name']; ?></strong><br>
                        Price: ₹<?php echo $item['price']; ?><br>
                        Quantity: <?php echo $item['quantity']; ?><br>
                        Subtotal: ₹<?php echo $subtotal; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <h4 class="text-end">Total: ₹<?php echo $total; ?></h4>

        <!-- Checkout form -->
        <h4 class="mt-4">Enter your Details</h4>
        <form action="process_checkout.php" method="post" class="mt-3">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Shipping Address:</label>
                <textarea name="address" rows="3" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number:</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="payment" class="form-label">Payment Method:</label>
                <select name="payment" class="form-select" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="debit_card">Debit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <button type="submit" class="btn btn-rose px-4">Confirm Order</button>
        </form>
    </div>
</div>

<!-- Link to External Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
