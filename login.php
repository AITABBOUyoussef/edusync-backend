<?php 
session_start();
// $_SESSION['user']=$email;
// header('Location:profile.php');
if(isset($_SESSION['user']))
    {
        header('Location:profile.php');
        exit();
    }

require "inclu/connect.php";
    
if (isset($_POST["submit"]))
    {
       $email = mysqli_real_escape_string($con,$_POST["email"]);
       $password = $_POST["password"];


       $req = "SELECT * FROM users WHERE email='".$email."' ";
        
        $query = mysqli_query($con,$req);
        $sel_user = mysqli_fetch_object($query);
        // $result = $con->query($req);
        $num = mysqli_num_rows($query);
        if($num)
            {
                $pass = $sel_user->password;
                if(password_verify($password,$pass))
                    {
                //    echo "le mot de passe est correcte ";
                //    session_start();
// while($row = $result->fetch_assoc()){
// //    echo "id: " . $row["id"]. " - Name: " . $row["nom"]. " - Mail: " . $row["email"]. "<br>";
// $_SESSION['usernom']=$row["nom"];
// }
$_SESSION['usernom']=$sel_user->nom;
$_SESSION['user']=$email;
// $_SESSION['usernom']=$row["nom"];
header('Location:profile.php');
exit();
                }
                else{
                    echo "le mot de passe incorrecte";
                }
               
            }
       else {
        echo "nom d'utilisateur incorrecte ";  
       }
    }




?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="max-w-md mx-auto mt-10 bg-white p-8 border border-gray-200 rounded-lg shadow-sm">
    <h2 class="text-2xl font-bold text-center text-pink-600 mb-6">Créer un compte</h2>
     <form action=''  method="POST">
        <input type="hidden" name="action" value="login">
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="email">Adresse Email</label>
            <input type="email" id="email" name="email" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-pink-500" >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2" for="password">Mot de passe</label>
            <input type="password" id="password" name="password" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-pink-500" >
        </div>
        
        <button type="submit" name="submit" class="w-full bg-pink-600 text-white font-bold py-2 px-4 rounded hover:bg-pink-700 transition duration-200">
            Se connecter
        </button>
    </form>
    <div class="mt-4 text-center">
        <p class="text-gray-600 text-sm">Vous n'avez pas de compte ? <a href="indexx.php" class="text-pink-600 hover:underline font-medium">S'inscrire</a></p>
    </div>
</div>
</div>

