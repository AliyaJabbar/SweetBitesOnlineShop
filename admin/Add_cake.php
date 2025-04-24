<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp_name, "../images1/cakes/" . $image);

    $query = "INSERT INTO cakes (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
    mysqli_query($conn, $query);

    header("Location: Admin_panel.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Cake - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f6f9;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
        }
        .btn-success {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="style1.css" rel="stylesheet"> <!-- adjust the path based on the page location -->

            <h2 class="text-center mb-4 text-primary">🍰 Add New Cake</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Cake Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Chocolate Cake" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Delicious chocolate cream cake..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price (₹)</label>
                    <input type="number" name="price" class="form-control" placeholder="price" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cake Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-rose">Add Cake</button>
                    <a href="Admin_panel.php" class="btn btn-secondary">Back to Dashboard</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
