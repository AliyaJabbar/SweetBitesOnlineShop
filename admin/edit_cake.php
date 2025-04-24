<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM cakes WHERE id = $id");
    $cake = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Image update (optional)
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $tmp_image = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_image, "../images1/cakes/$image");

        mysqli_query($conn, "UPDATE cakes SET name='$name', description='$description', price='$price', image='$image' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE cakes SET name='$name', description='$description', price='$price' WHERE id=$id");
    }

    header("Location: Admin_panel.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Cake - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card p-4">
                <h3 class="text-center text-danger mb-4">Edit Cake</h3>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Cake Name</label>
                        <input type="text" name="name" value="<?= $cake['name']; ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" required><?= $cake['description']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price (₹)</label>
                        <input type="number" name="price" value="<?= $cake['price']; ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Current Image</label><br>
                        <img src="../images1/<?= $cake['image']; ?>" width="120" class="img-thumbnail">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Image </label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" name="update" class="btn btn-rose">Update Cake</button>
                        <a href="Admin_panel.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
