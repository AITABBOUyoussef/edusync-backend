<?php 
require "inclu/connect.php";
    
$error = '';
if($_SERVER["REQUEST_METHOD"]==="POST"){

 if (empty($_POST["nom"])  || empty($_POST["email"]) || empty($_POST["password"]) )
{
    echo "les champs sont vides  ";
}
else {
    if(strlen($_POST["nom"]) <= 5)
          {
            $error = "le nom doit comporter 5 caracteres <br>";
          }
           if(is_numeric($_POST["nom"][0]))
          {
            $error  .= "le nom doit commencer par une lettre <br>";
          }
$email_propre = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email_propre,FILTER_VALIDATE_EMAIL))
        {
       $error .= "Le format de l'adresse email n'est pas valide <br>"; }
    if(strlen($_POST["password"]) <= 8)
         {
            $error .= "le password doit comporter 8 caracteres <br>";
          }
   if (empty($error))       
    {
     
        $email = mysqli_real_escape_string($con,$email_propre);
        // $password = password_hash($_POST["password"],PASSWORD_BCRYPT);
        // $password= mysqli_real_escape_string($con,$password);

             $nom_propre = htmlspecialchars(trim($_POST["nom"]));
                $nom = mysqli_real_escape_string($con,$nom_propre);
        // $email = htmlspecialchars(trim($_POST["email"]));
        $password = password_hash($_POST["password"],PASSWORD_BCRYPT);
        // $password= htmlspecialchars($password);
        $req = "INSERT INTO  users (nom,password,email) VALUES('$nom','$password','$email')";
        $insuser = mysqli_query($con,$req);
        if($insuser)
            {
                // echo "valide ";
                header('Location: login.php');
            }

    }
}
}

echo $error;
?>