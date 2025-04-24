<?php
session_start();
include("../includes/db.php");

if (isset($_GET['id'])) {
    $cake_id = $_GET['id'];
    $query = "DELETE FROM cakes WHERE id = $cake_id";
    mysqli_query($conn, $query);
}

header("Location: admin_panel.php");
exit();
?>
