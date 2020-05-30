<?php
$servername = "localhost";
$username = "abdullah";
$password = "12S162364";
$dbname = "facultydatabase";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>