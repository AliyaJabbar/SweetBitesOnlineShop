<?php
session_start();
include("includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SweetBites - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .header-title {
            margin-top: 30px;
            color: #e91e63;
            font-weight: bold;
        }

        .cake-box {
            background-color: white;
            border: 1px solid #f8bbd0;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }

        .cake-box:hover {
            transform: scale(1.03);
        }

        .cake-box img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .btn-rose {
            background-color: #e91e63;
            color: white;
            border: none;
        }

        .btn-rose:hover {
            background-color: #c2185b;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center header-title">Welcome to SweetBites</h2>
        <!-- <a href="dashboard.php">Dahboard</a> -->

        <div class="row mt-5">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM cakes");

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-4">
                    <div class="cake-box">
                        <img src="images1/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                        <h4><?php echo $row['name']; ?></h4>
                        <p><?php echo $row['description']; ?></p>
                        <p class="fw-bold">₹<?php echo $row['price']; ?></p>

                        <form action="cart.php" method="post">
                            <input type="hidden" name="cake_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="cake_name" value="<?php echo $row['name']; ?>">
                            <input type="hidden" name="cake_price" value="<?php echo $row['price']; ?>">
                            <button type="submit" name="buy_now" class="btn btn-rose">Buy Now</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>
</html>
