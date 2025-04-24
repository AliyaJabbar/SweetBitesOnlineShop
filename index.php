<!-- index.php -->
<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SweetBite - Home</title>
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

  <section class="hero">
    <h2>Delicious Cakes Delivered To Your Doorstep</h2>
    <p>Freshly baked, beautifully crafted.</p>
    <a href="login.php" class="btn">Order Now</a>
  </section>

  <section class="featured">
    <h3>Our Best Cakes</h3>
    <div class="cake-list">
      <div class="cake">
        <img src="images1/HoneyCake.jpg" alt="Honey Cake">
        <p>Honey Cake</p>
      </div>
      <div class="cake">
        <img src="images1/cupcake1.jpg" alt="Choco Cupcake">
        <p>Choco Cupcake</p>
      </div>
      <div class="cake">
        <img src="images1/weddingCake.jpg" alt="Wedding Cake">
        <p>HighRich Whity Cake</p>
      </div>
    
      
      <div class="cake">
        <img src="images1/Cheri blueberry.jpg" alt="Cheri Blueberry">
        <p>Cheri Blueberry Cream</p>
      </div>
      <div class="cake">
        <img src="images1/tankilavich.jpg" alt="Cherryberry Cake">
        <p>Cherryberry Cake</p>
      </div>
      <div class="cake">
        <img src="images1/Karonila Cake.jpg" alt="Karonila cake">
        <p>Kar Glass Cake</p>
    </div>
    <div class="cake">
        <img src="images1/White cream cake.jpg" alt="Karonila cake">
        <p>White cream Cake</p>
    </div>
    <div class="cake">
        <img src="images1/Rosy cream Cake.jpg" alt="Karonila cake">
        <p>Rosy cream Cake</p>
    </div>
    
    </div>
  </section>
    

  <footer>
    <p>&copy;All rights resevered 2025 Aliya Jabbar</p>
  </footer>
</body>
</html>
