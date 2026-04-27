<?php 
session_start();

if(isset($_SESSION['user'])) {
    header('Location:profile.php');
    exit();
}

require "inclu/connect.php";
    

$error = "";

if (isset($_POST["submit"])) {
    
$email = trim($_POST["email"]);
    $password = $_POST["password"];

    $req = "SELECT * FROM users WHERE email = :email";
    $stmt = $con->prepare($req);
   
    $stmt->execute([':email' => $email]);
   
    $sel_user = $stmt->fetch(PDO::FETCH_OBJ);
   
    if($sel_user) {
        
        $pass = $sel_user->password;
        
        if(password_verify($password, $pass)) {
            $_SESSION['usernom'] = $sel_user->nom;
            $_SESSION['user'] = $email;
            header('Location:profile.php');
            exit();
        } else {
            echo "le mot de passe incorrecte";
        }
        
    } else {
        echo "nom d'utilisateur incorrecte ";  
    }
}
?>