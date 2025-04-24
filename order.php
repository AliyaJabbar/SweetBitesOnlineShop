<?php
session_start();
include('includes/db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $cake_id = $_GET['id'];

    // Fetch cake details from the database
    $query = "SELECT * FROM cakes WHERE id = '$cake_id'";
    $result = mysqli_query($con, $query);
    $cake = mysqli_fetch_assoc($result);

    if (!$cake) {
        echo "Cake not found!";
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}

if (isset($_POST['order_submit'])) {
    $user_id = $_SESSION['user_id'];
    $cake_id = $_POST['cake_id'];
    $quantity = $_POST['quantity'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Insert order into the database
    $query = "INSERT INTO orders (user_id, cake_id, quantity, address, phone) 
              VALUES ('$user_id', '$cake_id', '$quantity', '$address', '$phone')";

    if (mysqli_query($con, $query)) {
        echo "<div class='alert alert-success text-center mt-4'>Order placed successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center mt-4'>Error: " . mysqli_error($con) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Cake</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cake-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4">🍰 Order Cake</h2>

            <div class="row g-4">
                <div class="col-md-5">
                    <img src="<?php echo $cake['image']; ?>" alt="<?php echo $cake['name']; ?>" class="cake-image">
                </div>
                <div class="col-md-7">
                    <h3><?php echo $cake['name']; ?></h3>
                    <p><?php echo $cake['description']; ?></p>
                    <p><strong>Price:</strong> ₹<?php echo $cake['price']; ?></p>

                    <form action="order.php?id=<?php echo $cake['id']; ?>" method="POST">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" name="quantity" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Delivery Address:</label>
                            <textarea name="address" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number:</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <input type="hidden" name="cake_id" value="<?php echo $cake['id']; ?>">
                        <button type="submit" name="order_submit" class="btn btn-success w-100">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
