<?php
$host = "localhost"; 
$user = "root";      
$pass = "andres";          
$db   = "proyecto_login";

try {
  $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
  
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  

} catch(PDOException $e) {

  echo "Connection failed: " . $e->getMessage();
  
}
?>