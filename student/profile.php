<?php
require_once 'auth.php';
require_once '../inclu/connect.php';

$stmt = $con->prepare("
    SELECT users.nom, users.email, classes.nom AS class_name
    FROM users
    LEFT JOIN classes ON users.classe_id = classes.id
    WHERE users.id = ?
");

$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8 border border-gray-100">

    <h2 class="text-2xl font-bold text-pink-600 mb-6">👤 Mon Profil</h2>

    <div class="space-y-4">

        <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
            <span class="font-semibold text-gray-600">Nom</span>
            <span class="text-gray-900 font-medium"><?= $user['nom'] ?></span>
        </div>

        <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
            <span class="font-semibold text-gray-600">Email</span>
            <span class="text-gray-900 font-medium"><?= $user['email'] ?></span>
        </div>

        <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
            <span class="font-semibold text-gray-600">Classe</span>
            <span class="text-pink-600 font-bold"><?= $user['class_name'] ?? 'Aucune' ?></span>
        </div>

    </div>
</div>
</body>
</html>