<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $pdo_var = new PDO("mysql:host=$servername;dbname=tp_nixon;charset=UTF8", $username, $password);
  
  // set the PDO error mode to exception
  $pdo_var->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>