<?php
$host = 'localhost';
$dbname = 'edusync'; // تأكد بلي السمية هنا هي نفسها لي صاوبتي فـ phpMyAdmin
$username = 'root';
$password = '';

try {
    // ⚠️ المشكل كيكون غالبا فهاد السطر 
    // تأكد بلي كاتب dbname=$dbname وماكاينش شي فراغ بيناتهم
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>