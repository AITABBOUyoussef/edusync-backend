<?php  
session_start();
// Middleware de sécurité : Vérifier si connecté ET si c'est un Admin
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-extrabold text-pink-600 tracking-tight">EduSync <span class="text-sm font-medium text-gray-400">| Admin</span></span>
                </div>
                <div class="flex items-center space-x-6">
                    <span class="text-gray-600 font-medium hidden sm:block">
                        👋 Bonjour, <span class="text-pink-600 font-bold"><?php echo htmlspecialchars($_SESSION['usernom']); ?></span>
                    </span>
                    <a href="../logout.php" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-2 rounded-md text-sm font-bold transition duration-200">
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="bg-gradient-to-r from-gray-800 to-gray-600 rounded-2xl shadow-md p-8 mb-8 text-white flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Centre de Contrôle Administrateur</h1>
                <p class="text-gray-200 text-lg">Gérez les comptes, les classes, les cours et consultez les statistiques globales de l'établissement.</p>
            </div>
            <div class="hidden md:block text-6xl">🛠️</div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-gray-400 transition duration-300">
                <div class="text-4xl mb-4">👥</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Gestion des Comptes</h3>
                <p class="text-gray-500 text-sm mb-4">Créer, modifier et supprimer les utilisateurs (Profs ou Étudiants).</p>
                <a href="#" class="text-gray-800 font-semibold hover:text-pink-600 flex items-center">Gérer les utilisateurs &rarr;</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-gray-400 transition duration-300">
                <div class="text-4xl mb-4">🏫</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Structure Académique</h3>
                <p class="text-gray-500 text-sm mb-4">Créer des classes, des cours et assigner un professeur à chaque matière.</p>
                <a href="#" class="text-gray-800 font-semibold hover:text-pink-600 flex items-center">Gérer les cours & classes &rarr;</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-gray-400 transition duration-300">
                <div class="text-4xl mb-4">📊</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Vue d'ensemble</h3>
                <p class="text-gray-500 text-sm mb-4">Consulter les statistiques globales (inscriptions, cours actifs, etc.).</p>
                <a href="#" class="text-gray-800 font-semibold hover:text-pink-600 flex items-center">Voir les statistiques &rarr;</a>
            </div>

        </div>
    </main>
</body>
</html>