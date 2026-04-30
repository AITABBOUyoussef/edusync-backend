<?php
session_start();
require_once '../inclu/connect.php';
require_once 'auth.php';

$stmt = $con->prepare("
    SELECT 
        courses.nom,
        courses.description,
        courses.volume_horaire,
        users.nom AS professeur
    FROM enrollments
    JOIN courses ON enrollments.cours_id = courses.id
    JOIN users ON courses.professeur_id = users.id
    WHERE enrollments.etudiant_id = ?
");

$stmt->execute([$_SESSION['user_id']]);
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Cours - EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">

    <h1 class="text-3xl font-bold text-pink-600 mb-8">
        📚 Mes Cours
    </h1>

    <?php if(empty($courses)): ?>
        <div class="bg-white p-6 rounded-xl shadow text-gray-600">
            Aucun cours trouvé.
        </div>
    <?php else: ?>

    <div class="grid md:grid-cols-2 gap-6">

        <?php foreach($courses as $c): ?>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">

            <h2 class="text-xl font-bold text-gray-800 mb-2">
                <?= htmlspecialchars($c['nom']) ?>
            </h2>

            <p class="text-gray-600 mb-4">
                <?= htmlspecialchars($c['description']) ?>
            </p>

            <div class="flex justify-between items-center text-sm">

                <span class="text-gray-700">
                    👨‍🏫 <?= htmlspecialchars($c['professeur']) ?>
                </span>

                <span class="bg-pink-100 text-pink-600 px-3 py-1 rounded-full font-semibold">
                    ⏱ <?= htmlspecialchars($c['volume_horaire']) ?>h
                </span>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

    <?php endif; ?>

</body>
</html>