<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

if (empty($nom) || empty($prenom) ||empty($email) ||empty($password)){ //empty===wach khawi
    header("Location: ..public/register.php?error=empty_fields"); //=>  GET Parameter
exit();
    
}else {
    echo "<div style='font-family: sans-serif; padding: 20px;'>";
        echo "<h2 style='color: green;'>Les informations ont ete reçues avec succes ✅ </h2>";
        echo "<p><strong>nom et prenom:</strong> " . $prenom . " " . $nom . "</p>";
        echo "<p><strong> email :</strong> " . $email . "</p>";
        echo "<p><em>(!!!)</em></p>";
        echo "<a href='../public/register.php'> Retour a l'inscription</a>";
        echo "</div>";
}
}else{
    header("Location: ../public/register.php");
    exit();
}


?>