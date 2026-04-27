<?php  
session_start();
// Middleware de sécurité : Vérifier si connecté ET si c'est un Prof
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header('Location: ../login.php');
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Professeur - EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-extrabold text-pink-600 tracking-tight">EduSync <span class="text-sm font-medium text-gray-400">| Professeur</span></span>
                </div>
                <div class="flex items-center space-x-6">
                    <span class="text-gray-600 font-medium hidden sm:block">
                        👋 Bonjour Prof. <span class="text-pink-600 font-bold"><?php echo htmlspecialchars($_SESSION['usernom']); ?></span>
                    </span>
                    <a href="../logout.php" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-2 rounded-md text-sm font-bold transition duration-200">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-2xl shadow-md p-8 mb-8 text-white flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Espace Enseignant</h1>
                <p class="text-blue-100 text-lg">Gérez vos modules, suivez vos étudiants et mettez à jour leurs statuts pédagogiques.</p>
            </div>
            <div class="hidden md:block text-6xl">👨‍🏫</div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-blue-400 transition duration-300">
                <div class="text-4xl mb-4">📚</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Mes Enseignements</h3>
                <p class="text-gray-500 text-sm mb-4">Voir la liste exclusive des cours qui me sont assignés et les détails des classes.</p>
                <a href="#" class="text-blue-600 font-semibold hover:text-blue-700 flex items-center">Afficher mes cours &rarr;</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-blue-400 transition duration-300">
                <div class="text-4xl mb-4">📝</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Gestion des Effectifs</h3>
                <p class="text-gray-500 text-sm mb-4">Suivre les étudiants inscrits et modifier leur statut pédagogique (Actif/Terminé).</p>
                <a href="#" class="text-blue-600 font-semibold hover:text-blue-700 flex items-center">Gérer les étudiants &rarr;</a>
            </div>

        </div>
    </main>
</body>
</html>