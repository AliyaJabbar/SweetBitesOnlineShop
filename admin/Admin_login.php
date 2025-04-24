<?php
session_start();

$admin_username = "admin";
$admin_password = "admin123"; // You can hash this for more security

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['username'] == $admin_username && $_POST['password'] == $admin_password) {
        $_SESSION['admin'] = true;
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<form method="post" class="login-form">
    <h2>Admin Login</h2>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet"> <!-- adjust the path based on the page location -->

    <input type="text" name="username" placeholder="Admin Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" class="login-button">Login</button>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
</form>

<style>
    body {
        background-color: #f2f2f2; /* Light background for contrast */
        font-family: Arial, sans-serif;
    }

    .login-form {
        background-color: #ffebf0; /* Rose-colored background */
        padding: 30px;
        width: 300px;
        margin: 100px auto;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .login-form h2 {
        text-align: center;
        color: #d7005f; /* Deep pink color */
        margin-bottom: 20px;
    }

    .login-form input {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .login-button {
        width: 100%;
        padding: 12px;
        background-color: #d7005f; /* Rose color */
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .login-button:hover {
        background-color: #c60053; /* Slightly darker rose */
    }

    .error {
        text-align: center;
        color: red;
        font-weight: bold;
    }
</style>
