<?php 
require_once '../includes/header.php0';
?>

<div class="max-w-md mx-auto mt-10 bg-white p-8 border border-gray-200 rounded-lg shadow-sm">
    <h2 class="text-2xl font-bold text-center text-pink-600 mb-6">Connexion</h2>
    <?php
    // Gestion des notifications (Feedback utilisateur) basées sur les paramètres GET
    if (isset($_GET['success']) && $_GET['succes'] === 'registered'){
        echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center font-medium'>
                ✅ Compte créé avec succès ! Veuillez vous connecter.
              </div>";
    }
    if (isset($_GET['error'])){
        $errorMessage ='';
        switch($_GET['error']){
            case 'invalid_credentials' : 
                $errorMessage = "❌ Email ou mot de passe incorrect.";
                break ;
                case 'empty_fields':
                $errorMessage = "⚠️ Veuillez remplir tous les champs.";
                break;
            case 'access_denied':
                $errorMessage = "🔒 Vous devez être connecté pour accéder au tableau de bord.";
                break;
        }
        if (!empty($errorMessage)){
            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-center font-medium'>
                    $errorMessage
                  </div>";
        }
    }
    ?>
    <form action="../scripts/authprocess.php" method="POST">
        <input type="hidden" name="action" value="login">
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="email">Adresse Email</label>
            <input type="email" id="email" name="email" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-pink-500" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2" for="password">Mot de passe</label>
            <input type="password" id="password" name="password" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-pink-500" required>
        </div>
        
        <button type="submit" class="w-full bg-pink-600 text-white font-bold py-2 px-4 rounded hover:bg-pink-700 transition duration-200">
            Se connecter
        </button>
    </form>
    <div class="mt-4 text-center">
        <p class="text-gray-600 text-sm">Vous n'avez pas de compte ? <a href="register.php" class="text-pink-600 hover:underline font-medium">S'inscrire</a></p>
    </div>
</div>

<?php 
// Inclusion du pied de page (Footer)
require_once '../includes/footer.php'; 
?>