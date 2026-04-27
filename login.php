<?php 
session_start();
require "inclu/connect.php";
if(isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
     if($_SESSION['role']==='admin')
                header('Location: admin/index.php');
            
            elseif($_SESSION['role']==='teacher')
                header('Location: teacher/index.php');
            
    header('Location: student/index.php');
    exit();
}


    

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
            $_SESSION['user_id'] = $sel_user->id;
            $_SESSION['role'] = $sel_user->role;

            if($_SESSION['role']==='admin'){
                header('Location: admin/index.php');
            }
            elseif($_SESSION['role']==='teacher'){
                header('Location: teacher/index.php');
            }
            elseif($_SESSION['role']==='student'){
                header('Location:student/index.php');
            }
           
            exit();
        } else {
           $error =  "le mot de passe incorrecte";
        }
        
    } else {
        $error= "nom d'utilisateur incorrecte ";  
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

<div class="max-w-md mx-auto mt-10 bg-white p-8 border border-gray-200 rounded-lg shadow-sm">
    <h2 class="text-2xl font-bold text-center text-pink-600 mb-6">Se connecter</h2>
    
    <?php if(!empty($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-center font-medium">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="email">Adresse Email</label>
            <input type="email" id="email" name="email" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-pink-500" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2" for="password">Mot de passe</label>
            <input type="password" id="password" name="password" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-pink-500" required>
        </div>
        
        <button type="submit" name="submit" class="w-full bg-pink-600 text-white font-bold py-2 px-4 rounded hover:bg-pink-700 transition duration-200">
            Se connecter
        </button>
    </form>
    
    <div class="mt-4 text-center">
        <p class="text-gray-600 text-sm">Vous n'avez pas de compte ? <a href="inscription.php" class="text-pink-600 hover:underline font-medium">S'inscrire</a></p>
    </div>
</div>

</body>
</html>