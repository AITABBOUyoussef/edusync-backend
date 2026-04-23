<?php  
session_start();
if(!isset($_SESSION['user']))
{
    header('Location:login.php');
    exit(); // هادي زدتها ليك غير باش السيرفر يحبس وميكملش قراية الديزاين يلا كان اليوزر مامكونيكطيش
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - EduSync</title>
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
                        👋 Bonjour, <span class="text-pink-600 font-bold"><?php echo htmlspecialchars($_SESSION['usernom']); ?></span>
                    </span>
                    <a href="logout.php" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-2 rounded-md text-sm font-bold transition duration-200">
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="bg-gradient-to-r from-pink-600 to-pink-400 rounded-2xl shadow-md p-8 mb-8 text-white flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Bienvenue sur votre espace personnel !</h1>
                <p class="text-pink-100 text-lg">C'est ici que vous pouvez gérer vos cours, consulter votre emploi du temps et suivre votre progression.</p>
            </div>
            <div class="hidden md:block">
                <span class="text-6xl">🎓</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-pink-300 transition duration-300">
                <div class="text-4xl mb-4">📚</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Mes Cours</h3>
                <p class="text-gray-500 text-sm mb-4">Accédez à vos modules, téléchargez les supports et suivez vos devoirs.</p>
                <a href="#" class="text-pink-600 font-semibold hover:text-pink-700 hover:underline flex items-center">
                    Voir les cours 
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-pink-300 transition duration-300">
                <div class="text-4xl mb-4">📅</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Emploi du temps</h3>
                <p class="text-gray-500 text-sm mb-4">Consultez vos horaires de la semaine et les dates des prochaines évaluations.</p>
                <a href="#" class="text-pink-600 font-semibold hover:text-pink-700 hover:underline flex items-center">
                    Voir le planning
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-pink-300 transition duration-300">
                <div class="text-4xl mb-4">⚙️</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Paramètres</h3>
                <p class="text-gray-500 text-sm mb-4">Modifiez vos informations personnelles et sécurisez votre compte utilisateur.</p>
                <a href="#" class="text-pink-600 font-semibold hover:text-pink-700 hover:underline flex items-center">
                    Gérer le profil
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

        </div>
    </main>

</body>
</html>