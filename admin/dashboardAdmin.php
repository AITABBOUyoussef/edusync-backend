<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - EduSync Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', system-ui, sans-serif;
        }

        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: translateY(-2px);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ec4899, #8b5cf6);
        }

        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .slide-in {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .badge-prof {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .badge-etudiant {
            background: linear-gradient(135deg, #10b981, #059669);
        }
    </style>
</head>
<?php
include 'functions.php';
include 'connectDB.php';
$conn = ConnectionDb();
$users = getAllUsers($conn, "student");



?>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans flex min-h-screen">

    <!-- Sidebar améliorée -->
    <aside class="w-72 bg-white border-r border-gray-200 flex-shrink-0 hidden lg:flex flex-col shadow-xl">
        <div class="p-6 bg-gradient-to-br from-pink-600 to-purple-600 text-white rounded-br-3xl">
            <h1 class="text-3xl font-bold">EduSync</h1>
            <p class="text-pink-100 text-sm mt-1">Administration Pro</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="#overview" class="nav-link flex items-center px-4 py-3 text-pink-600 bg-pink-50 rounded-xl mb-1 font-medium">
                <i class="fa-solid fa-chart-pie mr-3"></i> Vue d'ensemble
            </a>
            <a href="#accounts" class="nav-link flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-xl mb-1 transition">
                <i class="fa-solid fa-users-gear mr-3"></i> Gestion Comptes
            </a>
            <a href="#classes" class="nav-link flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-xl mb-1 transition">
                <i class="fa-solid fa-school mr-3"></i> Classes
            </a>
            <a href="#courses" class="nav-link flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-xl mb-1 transition">
                <i class="fa-solid fa-book-open mr-3"></i> Catalogue Cours
            </a>
            <a href="#enrollments" class="nav-link flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-xl mb-1 transition">
                <i class="fa-solid fa-user-plus mr-3"></i> Inscriptions
            </a>
        </nav>

        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center space-x-3 mb-4 p-3 bg-gray-50 rounded-xl">
                <div class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center text-white font-bold">
                    A
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Admin Principal</p>
                    <p class="text-xs text-gray-500">admin@edusync.ma</p>
                </div>
            </div>
            <a href="#" class="flex items-center px-4 py-2 text-red-500 hover:bg-red-50 rounded-xl transition">
                <i class="fa-solid fa-right-from-bracket mr-3"></i> Déconnexion
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        <!-- Header avec contrôles -->
        <header class="bg-white border-b border-gray-200 px-6 py-4 sticky top-0 z-10 shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Tableau de Bord</h2>
                    <p class="text-gray-500 text-sm" id="currentDateTime"></p>
                </div>
                <div class="flex items-center space-x-3">
                    <!-- Window Controls -->
                    <div class="flex items-center space-x-1 bg-gray-100 p-1 rounded-lg">
                        <button onclick="" class="p-2 hover:bg-red-100 rounded transition" title="Fermer">
                            Log out
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-6 space-y-8">
            <!-- US19: Vue d'ensemble - Statistiques -->
            <section id="overview">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fa-solid fa-chart-line text-pink-600 mr-2"></i>
                    Vue d'ensemble (US19)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="stat-card bg-white p-6 rounded-2xl shadow-sm hover-scale cursor-pointer" onclick="highlightStat('students')">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total Étudiants</p>
                                <p class="text-4xl font-bold text-gray-800 mt-2" id="totalStudents">0</p>
                                
                            </div>
                            <span class="text-pink-600 bg-pink-50 p-4 rounded-2xl">
                                <i class="fa-solid fa-user-graduate text-2xl"></i>
                            </span>
                        </div>
                    </div>

                    <div class="stat-card bg-white p-6 rounded-2xl shadow-sm hover-scale cursor-pointer" onclick="highlightStat('courses')">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Cours Actifs</p>
                                <p class="text-4xl font-bold text-gray-800 mt-2" id="totalCourses">0</p>
                                <p class="text-blue-600 text-sm mt-1">
                                    <i class="fa-solid fa-circle"></i> En session
                                </p>
                            </div>
                            <span class="text-blue-600 bg-blue-50 p-4 rounded-2xl">
                                <i class="fa-solid fa-laptop-code text-2xl"></i>
                            </span>
                        </div>
                    </div>

                    <div class="stat-card bg-white p-6 rounded-2xl shadow-sm hover-scale cursor-pointer" onclick="highlightStat('classes')">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Classes Actives</p>
                                <p class="text-4xl font-bold text-gray-800 mt-2" id="totalClasses">0</p>
                                <p class="text-purple-600 text-sm mt-1">
                                    <i class="fa-solid fa-check-circle"></i> Opérationnelles
                                </p>
                            </div>
                            <span class="text-purple-600 bg-purple-50 p-4 rounded-2xl">
                                <i class="fa-solid fa-door-open text-2xl"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Répartition des élèves par classe -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h4 class="font-bold text-gray-800 mb-4">Répartition des élèves par classe</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="classDistribution">
                        <!-- Dynamically populated -->
                    </div>
                </div>
            </section>

            <!-- US15: Gestion des Comptes -->
            <section id="accounts" class="bg-white rounded-2xl shadow-sm">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-gray-800 text-lg flex items-center">
                            <i class="fa-solid fa-users-gear text-pink-600 mr-2"></i>
                            Gestion des Comptes (US15)
                        </h3>
                        <button onclick="openUserModal()" class="bg-pink-600 text-white px-6 py-2.5 rounded-xl font-medium hover:bg-pink-700 transition transform hover:scale-105">
                            <i class="fa-solid fa-plus mr-2"></i> Nouvel Utilisateur
                        </button>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 flex gap-4 flex-wrap">
                    <div class="relative flex-1 min-w-[200px]">
                        <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" id="searchUser" placeholder="Rechercher par nom ou email..."
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition">
                    </div>
                    <select id="filterRole" class="border border-gray-300 rounded-xl px-4 py-2.5 focus:border-pink-500 outline-none">
                        <option value="student">Étudiants</option>
                        <option value="teacher">Professeurs</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">ID</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Nom Complet</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Rôle</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Email</th>
                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Date Création</th>
                                <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody" class="divide-y divide-gray-100">
           <?php foreach($users as $user) : ?>
    <tr class="hover:bg-gray-50 transition">
        <!-- ID Column -->
        <td class="px-6 py-4 text-sm font-medium text-gray-900">#<?= $user['id'] ?></td>
        
        <!-- Name Column with Avatar -->
        <td class="px-6 py-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gradient-to-br from-pink-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                    <?= strtoupper(substr($user['nom'], 0, 1)) ?>
                </div>
                <span class="font-medium text-gray-800"><?= htmlspecialchars($user['nom']) ?></span>
            </div>
        </td>
        
        <!-- Role Column with Dynamic Badges -->
        <td class="px-6 py-4">
            <?=  $user['role'] ?>
 
        </td>
        
        <!-- Email Column -->
        <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($user['email']) ?></td>
        
        <!-- Class ID Column (Added based on your table) -->
        <td class="px-6 py-4 text-sm text-gray-500">
            <?= $user['classe_id'] ? "Classe " . $user['classe_id'] : '—' ?>
        </td>
        
        <!-- Actions -->
        <td class="px-6 py-4 text-right">
            <button onclick="editUser(<?= $user['id'] ?>)" class="text-blue-600 hover:text-blue-800 mr-3 transition">
                <i class="fa-solid fa-edit"></i>
            </button>
            <button onclick="deleteUser(<?= $user['id'] ?>)" class="text-red-600 hover:text-red-800 transition">
                <i class="fa-solid fa-trash"></i>
            </button>
        </td>
    </tr>
<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- US16 & US17: Classes et Cours -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- US16: Création de Classes -->
                <section id="classes" class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fa-solid fa-school text-purple-600 mr-2"></i>
                        Créer une Classe (US16)
                    </h3>
                    <form id="classForm" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ID de la Classe</label>
                            <input type="text" id="classId" placeholder="ex: CLS-001"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom de la Classe</label>
                            <input type="text" id="className" placeholder="ex: Terminale Scientifique A"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Salle</label>
                            <input type="text" id="classRoom" placeholder="ex: Salle 301"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none transition">
                        </div>
                        <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-xl font-semibold hover:bg-purple-700 transition transform hover:scale-105">
                            <i class="fa-solid fa-plus mr-2"></i> Créer la Classe
                        </button>
                    </form>

                    <!-- Liste des classes -->
                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-700 mb-3">Classes Existantes</h4>
                        <div id="classesList" class="space-y-2 max-h-60 overflow-y-auto">
                            <!-- Dynamic content -->
                        </div>
                    </div>
                </section>

                <!-- US17: Création de Cours -->
                <section id="courses" class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fa-solid fa-book-open text-blue-600 mr-2"></i>
                        Créer un Cours (US17)
                    </h3>
                    <form id="courseForm" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Matière</label>
                            <input type="text" id="courseName" placeholder="ex: Mathématiques Avancées"
                                class="w-full border border-gray-300 p-3 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Professeur Responsable</label>
                            <select id="professorSelect" class="w-full border border-gray-300 p-3 rounded-xl focus:border-blue-500 outline-none transition">
                                <option value="">Sélectionner un professeur</option>
                                <!-- Dynamically populated -->
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea id="courseDescription" rows="2" placeholder="Description du cours..."
                                class="w-full border border-gray-300 p-3 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition transform hover:scale-105">
                            <i class="fa-solid fa-plus mr-2"></i> Créer le Cours
                        </button>
                    </form>

                    <!-- Liste des cours -->
                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-700 mb-3">Cours Existants</h4>
                        <div id="coursesList" class="space-y-2 max-h-60 overflow-y-auto">
                            <!-- Dynamic content -->
                        </div>
                    </div>
                </section>
            </div>

            <!-- US18: Inscriptions -->
            <section id="enrollments" class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fa-solid fa-user-plus text-green-600 mr-2"></i>
                    Inscription aux Cours (US18)
                </h3>

                <form id="enrollmentForm" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Étudiant</label>
                        <select id="studentSelect" class="w-full border border-gray-300 p-3 rounded-xl focus:border-green-500 outline-none transition">
                            <option value="">Sélectionner un étudiant</option>
                            <!-- Dynamically populated -->
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cours</label>
                        <select id="courseSelect" class="w-full border border-gray-300 p-3 rounded-xl focus:border-green-500 outline-none transition">
                            <option value="">Sélectionner un cours</option>
                            <!-- Dynamically populated -->
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition transform hover:scale-105">
                            <i class="fa-solid fa-check mr-2"></i> Valider l'Inscription
                        </button>
                    </div>
                </form>

                <!-- Liste des inscriptions -->
                <div>
                    <h4 class="font-semibold text-gray-700 mb-3">Inscriptions Récentes</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">ID</th>
                                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Étudiant</th>
                                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Cours</th>
                                    <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Date</th>
                                    <th class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="enrollmentsTableBody" class="divide-y divide-gray-100">
                                <!-- Dynamic content -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Modal pour ajouter/modifier un utilisateur -->
    <div id="userModal" class="fixed inset-0 z-50 hidden items-center justify-center modal-overlay">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 p-8 slide-in">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Ajouter un Utilisateur</h3>
                <button onclick="closeUserModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form action='managementUsers.php' id="userForm" class="space-y-4" method="POST">
                <input type="hidden" id="userId">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom Complet</label>
                    <input type="text" name="nom" type="text" id="userName" required placeholder="ex: Ahmed Bennani"
                        class="w-full border border-gray-300 p-3 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="text" name="email" required placeholder="ex: ahmed@edusync.ma"
                        class="w-full border border-gray-300 p-3 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                    <select id="userRole" name="role" required class="w-full border border-gray-300 p-3 rounded-xl focus:border-pink-500 outline-none transition">
                        <option value="">Sélectionner un rôle</option>
                        <option value="Professeur">Professeur</option>
                        <option value="Étudiant">Étudiant</option>
                        <option value="admin">admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                    <div class="relative">
                        <input type="password" id="userPassword" name="password" required placeholder="Minimum 8 caractères"
                            class="w-full border border-gray-300 p-3 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition pr-12"
                            minlength="8">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                    <div class="relative">
                        <input type="password" id="userConfirmPassword" name="confirmpass" required placeholder="Répéter le mot de passe"
                            class="w-full border border-gray-300 p-3 rounded-xl focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition pr-12">

                    </div>
                    <p id="passwordMatchMessage" class="text-xs mt-1 hidden"></p>
                </div>
                <div class="flex space-x-3">
                    <button type="submit" name="submit" class="flex-1 bg-pink-600 text-white py-3 rounded-xl font-semibold hover:bg-pink-700 transition">
                        <i class="fa-solid fa-save mr-2"></i> Enregistrer
                    </button>
                    <button type="button" onclick="closeUserModal()" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-300 transition">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast notifications -->
    <div id="toastContainer" class="fixed bottom-6 right-6 z-50 space-y-3"></div>

    <script>
        function openUserModal(userId = null) {
            const modal = document.getElementById('userModal');
            const title = document.getElementById('modalTitle');
            const form = document.getElementById('userForm');

            if (userId) {
                const user = db.users.find(u => u.id === userId);
                if (user) {
                    title.textContent = 'Modifier l\'Utilisateur';
                    document.getElementById('userId').value = user.id;
                    document.getElementById('userName').value = user.name;
                    document.getElementById('userEmail').value = user.email;
                    document.getElementById('userRole').value = user.role;
                }
            } else {
                title.textContent = 'Ajouter un Utilisateur';
                form.reset();
                document.getElementById('userId').value = '';
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeUserModal() {
            const modal = document.getElementById('userModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

</body>

</html>