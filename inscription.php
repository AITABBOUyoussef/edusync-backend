<?php 
require "inclu/connect.php";
    
$error = '';
if($_SERVER["REQUEST_METHOD"] === "POST"){

    if (empty($_POST["nom"])  || empty($_POST["email"]) || empty($_POST["password"]) ) {
        echo "les champs sont vides  ";
    } else {
        if(strlen($_POST["nom"]) <= 5) {
            $error = "le nom doit comporter 5 caracteres <br>";
        }
        if(is_numeric($_POST["nom"][0])) {
            $error  .= "le nom doit commencer par une lettre <br>";
        }
        
        $email_propre = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        if(!filter_var($email_propre, FILTER_VALIDATE_EMAIL)) {
            $error .= "Le format de l'adresse email n'est pas valide <br>"; 
        }
        
        if(strlen($_POST["password"]) <= 8) {
            $error .= "le password doit comporter 8 caracteres <br>";
        }
        
        if (empty($error)) {
     
        $nom = htmlspecialchars(trim($_POST["nom"]));
           
        $email = $email_propre;
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
          
            $req = "INSERT INTO users (nom, password, email) VALUES (:nom, :password, :email)";
            $stmt = $con->prepare($req);
           
            $insuser = $stmt->execute([
                ':nom' => $nom,
                ':password' => $password,
                ':email' => $email
            ]);
            
            if($insuser) {
                header('Location: login.php');
                exit();
            }
        }
    }
}

echo $error;
?>