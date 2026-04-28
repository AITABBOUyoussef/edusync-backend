<?php
session_start();
require_once '../inclu/connect.php';
require_once 'auth.php';
$stmt = $con->prepare("
    SELECT nom, email
    FROM users
    WHERE classe_id = (
        SELECT classe_id FROM users WHERE id = ?
    )
    AND role = 'student'
");
$stmt->execute([$_SESSION['user_id']]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma Classe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">

<h1 class="text-3xl font-bold text-pink-600 mb-8">
👥 Ma Classe
</h1>

<?php if(empty($students)): ?>
    <div class="bg-white p-6 rounded-xl shadow">
        Aucun étudiant trouvé dans votre classe.
    </div>
<?php else: ?>
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <?php foreach($students as $s): ?>

        <div class="flex justify-between items-center p-4 border-b hover:bg-gray-50">

            <div>
                <p class="font-bold text-gray-800">
                    <?= htmlspecialchars($s['nom']) ?>
                </p>

                <p class="text-sm text-gray-500">
                    <?= htmlspecialchars($s['email']) ?>
                </p>
            </div>

            <span class="text-pink-600 font-semibold">
                Étudiant
            </span>

        </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>

</body>
</html>