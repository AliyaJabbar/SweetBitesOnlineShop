<?php
session_start();

// If 'Buy Now' is clicked
if (isset($_POST['buy_now'])) {
    $cake_id = $_POST['cake_id'];
    $cake_name = $_POST['cake_name'];
    $cake_price = (float) $_POST['cake_price'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $found = false;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $cake_id) {
            $_SESSION['cart'][$key]['quantity'] += 1;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = array(
            'id' => $cake_id,
            'name' => $cake_name,
            'price' => $cake_price,
            'quantity' => 1
        );
    }

    header("Location: cart.php");
    exit();
}

// Remove item from cart
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            break;
        }
    }
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .cart-item {
            background-color: white;
            border: 1px solid #f8bbd0;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .btn-rose {
            background-color: #e91e63;
            color: white;
        }

        .btn-rose:hover {
            background-color: #c2185b;
        }

        .btn-remove {
            text-decoration: none;
            color: #e91e63;
        }

        .btn-remove:hover {
            color: #c2185b;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center text-danger mb-5">Your Cart</h2>

    <?php
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            ?>
            <div class="cart-item">
                <h5><?php echo $item['name']; ?></h5>
                <p>Price: ₹<?php echo $item['price']; ?></p>
                <p>Quantity: <?php echo $item['quantity']; ?></p>
                <p><strong>Subtotal: ₹<?php echo $subtotal; ?></strong></p>
                <a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn-remove">🗑 Remove</a>
            </div>
            <?php
        }
        ?>
        <h3 class="text-end">Total: ₹<?php echo $total; ?></h3>
        <div class="text-end mt-4">
           
        <form action="checkout.php" method="post">
           
           <button type="submit" class="btn btn-rose px-4">Proceed to Checkout</button>
           <a href="home.php" class="btn btn-secondary px-4">Continue Shopping</a>
       </form>
       

        </div>
        <?php
    } else {
        echo "<div class='alert alert-warning text-center'>Your cart is empty!</div>";
    }
    ?>
</div>

</body>
</html>
