<?php
session_start();
include("../includes/db.php");

// Ensure the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch total number of cakes
$cake_count_query = "SELECT COUNT(*) AS total_cakes FROM cakes";
$cake_count_result = mysqli_query($conn, $cake_count_query);
$cake_count = mysqli_fetch_assoc($cake_count_result)['total_cakes'];

// Fetch total number of orders (assuming an 'orders' table exists)
$order_count_query = "SELECT COUNT(*) AS total_orders FROM orders";
$order_count_result = mysqli_query($conn, $order_count_query);
$order_count = mysqli_fetch_assoc($order_count_result)['total_orders'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - SweetBites</title>
    <!-- Bootstrap CSS -->
    <style>
        body {
            background-color: #fff1f4;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        .btn-rose {
            background-color: #e91e63;
            color: white;
        }
        .btn-rose:hover {
            background-color: #d81b60;
            color: white;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../style.css" rel="stylesheet"> <!-- adjust the path based on the page location -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SweetBites Admin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container mt-4">
        <h1 class="mb-4">Dashboard</h1>
        <div class="row">
            <!-- Total Cakes Card -->
            <div class="col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Cakes</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $cake_count; ?></h5>
                        <p class="card-text">Number of cakes available in the store.</p>
                    </div>
                </div>
            </div>
            <!-- Total Orders Card -->
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Orders</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $order_count; ?></h5>
                        <p class="card-text">Number of orders placed by customers.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="mt-4">
            <a href="admin_panel.php" class="btn btn-outline-primary">Manage Cakes</a>
            <a href="manage_orders.php" class="btn btn-outline-success">Manage Orders</a>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
