<?php 
include '../includes/header.php';
?>
<div class="max-w-md mx-auto mt-10 bg-white p-8 border border-gray-200 rounded-lg shadow-sm">
    <h2 class="text-2xl font-bold text-center text-pink-600 mb-6">Créer un compte</h2>
    
    <form action="../scripts/authprocess.php" method="POST">
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Nom </label>
            <input type="text" name="nom" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-pink-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Prénom </label>
            <input type="text" name="prenom" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-pink-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" name="email" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-pink-500" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Mot de passe</label>
            <input type="password" name="password" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-pink-500" required>
        </div>
        
        <button type="submit" class="w-full bg-pink-600 text-white font-bold py-2 px-4 rounded hover:bg-pink-700 transition duration-200">
            S'inscrire
        </button>
    </form>
</div>

<?php 

include '../includes/footer.php'; 
?>