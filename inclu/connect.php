<?php
$host = 'localhost';
$user = 'root';
$pass = ''; 
$db = 'edu';

try {
     $con = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    
     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
   
    die("Erreur de connexion : " . $e->getMessage());
}
?>