
<?php
// Start the session to access session data
session_start();

// Clear the cart (if it's stored in the session)
unset($_SESSION['cart']);  // This will remove the cart from the session

// Destroy the session (log out the user)
session_destroy();

// Redirect to homepage (or login page)
header("Location: index.php");
exit();
?>
