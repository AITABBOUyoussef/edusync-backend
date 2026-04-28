<?php  
session_start();
// Middleware de sécurité : Vérifier si connecté ET si c'est un Étudiant
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header('Location: ../login.php');
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Étudiant - EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-extrabold text-pink-600 tracking-tight">EduSync</span>
                </div>
                <div class="flex items-center space-x-6">
                    <span class="text-gray-600 font-medium hidden sm:block">
                        👋 Salut, <span class="text-pink-600 font-bold"><?php echo htmlspecialchars($_SESSION['usernom']); ?></span>
                    </span>
                    <a href="../logout.php" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-2 rounded-md text-sm font-bold transition duration-200">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="bg-gradient-to-r from-pink-600 to-pink-400 rounded-2xl shadow-md p-8 mb-8 text-white flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Bienvenue sur votre espace personnel !</h1>
                <p class="text-pink-100 text-lg">Accédez à votre programme, découvrez vos professeurs et votre classe.</p>
            </div>
            <div class="hidden md:block text-6xl">🎓</div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-pink-300 transition duration-300">
                <div class="text-4xl mb-4">📖</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Mon Programme</h3>
                <p class="text-gray-500 text-sm mb-4">Consulter la liste de mes cours et les détails des modules (Volume horaire, etc.).</p>
<a href="program.php" class="text-pink-600 font-semibold hover:text-pink-700 flex items-center">
    Voir mes cours →
</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-pink-300 transition duration-300">
                <div class="text-4xl mb-4">🤝</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Ma Promotion</h3>
                <p class="text-gray-500 text-sm mb-4">Voir la liste de mes camarades de classe pour faciliter le travail en groupe.</p>
                <a href="class.php" class="text-pink-600 font-semibold hover:text-pink-700 flex items-center">
    Voir ma classe →
</a>

            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-pink-300 transition duration-300">
                <div class="text-4xl mb-4">👤</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Mon Profil</h3>
                <p class="text-gray-500 text-sm mb-4">Visualiser mes informations personnelles et le statut de mon cursus pédagogique.</p>
                <a href="profile.php" class="text-pink-600 font-semibold hover:text-pink-700 flex items-center">
    Mon compte →
</a>
            </div>

        </div>
    </main>
</body>
</html>zip_entry_open