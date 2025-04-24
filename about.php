<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us - SweetBite</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <header>
    <h1>🎂 SweetBite</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="contact.php">Contact</a>
      <?php
      if (isset($_SESSION['user_id'])) {
          echo '<a href="logout.php">Logout</a>';
      } else {
          echo '<a href="login.php">Login</a>';
      }
      ?>
      <a href="admin/Admin_login.php">Admin</a>
      <a href="register.php">Register</a>
    </nav>
  </header>

  <section class="about">
    <h2>About SweetBite</h2>
    <p>Welcome to <strong>SweetBite</strong>, your one-stop destination for heavenly cakes and sweet treats! 🍰</p>
    
    <p>Founded with love and passion for baking, SweetBite is a family-run bakery delivering freshly baked cakes straight to your doorstep. From birthdays to weddings, or just your daily dose of dessert — we’ve got something for every celebration.</p>

    <p>✨ Our specialties include:</p>
    <ul>
      <li>Customized Cakes for every occasion</li>
      <li>100% Eggless Options</li>
      <li>Freshly Baked Daily</li>
      <li>Online Ordering & Home Delivery</li>
    </ul>

    <p>We use only the finest ingredients to make sure every bite brings a smile. At SweetBite, it’s more than just dessert — it’s a moment of joy.</p>

    <p><em>SweetBite – Spreading happiness, one cake at a time!</em> 🎉</p>
  </section>

  <footer>
    <p>&copy; 2025 SweetBite Bakery</p>
  </footer>

</body>
</html>
