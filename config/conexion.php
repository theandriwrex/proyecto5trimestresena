<?php
$host = "localhost"; 
$user = "root";      
$pass = "andres";          
$db   = "proyecto_login";

function getConnection(){
  global $host, $user, $pass, $db;
  try {
    $conn = new PDO("mysql:host=$host;dbname=$db", "$user", "$pass");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  } catch (PDOExeption $e) {
    die("Error de conexión: " . $e->getMessage());
  }
 }
?>