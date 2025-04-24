<?php
// $host = "localhost";
// $user = "root";
// $pass = "";
// $dbname = "sweetbite";
$conn = new mysqli("127.0.0.1", "root", "", "sweetbite", 4306);

//$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
