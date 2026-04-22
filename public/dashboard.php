<?php
// 1. Démarrage de la session (Obligatoire avant tout code HTML ou vérification)
session_start();

// 2. Restriction d'accès (US7) - Le vigile à la porte
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, on le redirige vers la page de login
    header("Location: ../public/login.php?error=access_denied");
    exit(); // On arrête l'exécution ici (très important !)
}

// 3. Inclusion de l'en-tête
require_once '../includes/header.php';
?>

<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white p-8 border border-gray-200 rounded-lg shadow-sm mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Bienvenue, <span class="text-pink-600"><?php echo htmlspecialchars($_SESSION['user_prenom'] . ' ' . $_SESSION['user_nom']); ?></span> !
            </h2>
            <p class="text-gray-600 mt-2">Vous êtes connecté en tant que : <strong class="uppercase"><?php echo htmlspecialchars($_SESSION['user_role']); ?></strong></p>
        </div>
        
        <a href="../scripts/logout.php" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-200">
            Déconnexion
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-sm">
            <h3 class="text-xl font-bold text-gray-800 mb-2">📚 Mes Cours</h3>
            <p class="text-gray-600">Accédez à vos modules et ressources.</p>
        </div>
        <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-sm">
            <h3 class="text-xl font-bold text-gray-800 mb-2">📅 Emploi du temps</h3>
            <p class="text-gray-600">Consultez vos horaires de la semaine.</p>
        </div>
        <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-sm">
            <h3 class="text-xl font-bold text-gray-800 mb-2">✉️ Messages</h3>
            <p class="text-gray-600">Communiquez avec l'administration.</p>
        </div>
    </div>
</div>

<?php 
// 4. Inclusion du pied de page
require_once '../includes/footer.php'; 
?>