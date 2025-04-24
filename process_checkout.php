<?php
session_start();

// Check if the checkout form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user details from the form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $payment_method = $_POST['payment'];

    // Calculate total price
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Normally, here you would save the order details to the database
    // For demonstration purposes, let's assume we save it successfully

    // Empty the cart
    unset($_SESSION['cart']);
    
    // HTML starts here
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Order Confirmation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <div class="alert alert-success text-center p-5 shadow rounded">
                <h2 class="mb-4">🎉 Thank You, <?php echo htmlspecialchars($name); ?>!</h2>
                <p class="fs-5">Your order has been successfully placed.</p>
                <p><strong>Total Paid:</strong> ₹<?php echo number_format($total, 2); ?></p>
                <p><strong>Payment Method:</strong> <?php echo ucfirst(str_replace('_', ' ', $payment_method)); ?></p>
                <hr>
                <a href="index.php" class="btn btn-primary mt-3">Return to Home</a>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
} else {
    echo "<div style='margin: 50px; text-align:center; color:red; font-size: 1.5rem;'>Invalid request.</div>";
}
?>
