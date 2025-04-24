<?php
session_start();
include('includes/db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - SweetBites</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="dashboard-container">
    <header class="dashboard-header">
      <h2>Welcome, <?php echo $user_name; ?>!</h2>
      <p>Your personalized dashboard. Browse and order your favorite cakes!</p>
    </header>

    <section class="cakes-section">
      <h3>Available Cakes</h3>
      <div class="cakes-list">
        <?php
        // Fetch cakes from the database
        $query = "SELECT * FROM cakes";
        $result = mysqli_query($con, $query);

        // Display cakes
        while ($cake = mysqli_fetch_assoc($result)) {
            echo "<div class='cake-card'>";
            echo "<img src='" . $cake['image'] . "' alt='" . $cake['name'] . "' class='cake-image'>";
            echo "<div class='cake-info'>";
            echo "<h4>" . $cake['name'] . "</h4>";
            echo "<p>" . $cake['description'] . "</p>";
            echo "<p><strong>Price:</strong> ₹" . $cake['price'] . "</p>";
            echo "<a href='order.php?id=" . $cake['id'] . "' class='order-btn'>Order Now</a>";
            echo "</div>";
            echo "</div>";
        }
        ?>
      </div>
    </section>
  </div>
</body>
</html>
