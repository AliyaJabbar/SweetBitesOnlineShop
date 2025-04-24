<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : "";

// Pagination setup
$limit = 5; // cakes per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total cakes for summary
$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM cakes WHERE name LIKE '%$search%'");
$total_row = mysqli_fetch_assoc($total_result);
$total_cakes = $total_row['total'];

// Get total price
$price_result = mysqli_query($conn, "SELECT SUM(price) as total_price FROM cakes");
$price_row = mysqli_fetch_assoc($price_result);
$total_price = $price_row['total_price'] ?? 0;

// Fetch cakes with pagination and search
$query = "SELECT * FROM cakes WHERE name LIKE '%$search%' LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

// Total pages
$total_pages = ceil($total_cakes / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Cake List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SweetBites Admin</a>
        <a href="Admin_dashboard.php" class="btn btn-primary">Go to Dashboard</a>

        <div class="d-flex">
            <a class="btn btn-outline-light me-2" href="add_cake.php">Add New Cake</a>
            <a class="btn btn-danger" href="admin_logout.php">Logout</a>
        </div>
    </div>
</nav>

<!-- Dashboard Summary -->
<div class="container mt-4">
    <div class="row text-center">
        <div class="col-md-6 mb-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Total Cakes
                    <h4><?= $total_cakes ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    Total Price
                    <h4>₹<?= $total_price ?></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <form method="GET" class="d-flex justify-content-end mb-3">
        <input class="form-control w-25 me-2" type="text" name="search" value="<?= $search ?>" placeholder="Search cake...">
        <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>

    <!-- Cake Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price (₹)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><img src="../images1/<?= $row['image']; ?>" width="60" class="rounded"></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['description']; ?></td>
                        <td>₹<?= $row['price']; ?></td>
                        <td>
                            <a href="edit_cake.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                            <a href="delete_cake.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this cake?');">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr><td colspan="6">No cakes found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
