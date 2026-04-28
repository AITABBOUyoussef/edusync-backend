<?php  
session_start();
require "../inclu/connect.php";
// Middleware de sécurité : Vérifier si connecté ET si c'est un Prof
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header('Location: ../login.php');
    exit(); 
}

$professeur_id = $_SESSION['user_id'] ;
try {
    $requete = "SELECT * FROM courses WHERE professeur_id = :prof_cours";
$stmt = $con->prepare($requete);

$stmt->execute([
    ':prof_cours' => $professeur_id
]);

$mes_cours = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo $e->getMessage();
}



try {
    $requete = "SELECT users.nom AS nom_etu  , courses.nom AS nom_cours, courses.description AS cour_des, enrollments.status , enrollments.etudiant_id , enrollments.cours_id
     FROM enrollments 
     join users on etudiant_id = users.id
     join courses on cours_id = courses.id
     where professeur_id = :prof_id ";
$stm = $con->prepare($requete);

$stm->execute([
    ':prof_id' => $professeur_id
]);

$mes_etu = $stm->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo $e->getMessage();
}

if(isset($_POST['marquer_termine'])){
try {
    $id_etudiant = $_POST['id_etudiant'];
    $id_cours = $_POST['id_cours'];
    $req = "UPDATE enrollments 
    SET status ='Termine'
    where etudiant_id = :etu_id AND cours_id = :cour_id";
    $st=$con->prepare(($req));
    $st ->execute([
        ':etu_id' => $id_etudiant,
        ':cour_id'=> $id_cours
    ]);
    header('Location: index.php'); 
    exit();
    // $actif = $st->fetch(PDO::FETCH_OBJ); 
} catch (PDOException $e) {
    echo $e->getMessage();
}
}



// foreach($mes_cours as $cour){
//     // $id_cours=$cour->id  ;

// try {
//     $requete = "SELECT * FROM enrollments WHERE cours_id = :id_etu ";
// $stmt = $con->prepare($requete);

// $stmt->execute([
//     ':id_etu' => $cour->id 
// ]);

// $mes_etu = $stmt->fetchAll(PDO::FETCH_OBJ);
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }
// }



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
                <p class="text-gray-500 text-sm mb-4">Voir la liste exclusive des cours qui me sont assignés et les détails des classes.
                    <?php echo htmlspecialchars($_SESSION['usernom']); ?>
                </p>

                <a href="#" class="text-blue-600 font-semibold hover:text-blue-700 flex items-center">
                    <?php 
               foreach($mes_cours as $cour){
   
    echo  $cour->nom."<br>";
} ?>
</a>
            </div>

            <!-- <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-blue-400 transition duration-300">
                <div class="text-4xl mb-4">📝</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Gestion des Effectifs</h3>
                <p class="text-gray-500 text-sm mb-4">Suivre les étudiants inscrits et modifier leur statut pédagogique (Actif/Terminé).</p>
                <a href="#" class="text-blue-600 font-semibold hover:text-blue-700 flex items-center">

                  <!-- <?php 
               foreach($mes_etu as $etu){
   
    echo  "<br>"."Étudiant(e) :".$etu->nom_etu."<br>"
    ."Module suivi :".$etu->nom_cours."<br>"
    ."Aperçu :".$etu->cour_des."<br>";
} ?> -->



                <!-- </a> -->
            <!-- </div> --> 
<?php foreach($mes_etu as $etu): ?>

<div class="bg-white border border-gray-200 rounded-xl p-5 mb-4 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    
    <div class="flex items-start gap-4">
        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xl font-bold shrink-0">
            <?php echo strtoupper(substr($etu->nom_etu, 0, 1)); ?>
        </div>
        
        <div>
            <h4 class="text-lg font-bold text-gray-900">
                <?php echo htmlspecialchars($etu->nom_etu); ?>
            </h4>
            <p class="text-sm font-semibold text-blue-600 mt-0.5 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <?php echo htmlspecialchars($etu->nom_cours); ?>
            </p>
            <p class="text-xs text-gray-500 mt-1 italic line-clamp-2">
                "<?php echo htmlspecialchars($etu->cour_des); ?>"
            </p>
        </div>
    </div>

    <div class="shrink-0">
        <?php 
        // كنبدلو اللون ديال البادج على حساب الحالة
        $statusClass = ($etu->status === 'Actif') 
            ? 'bg-green-100 text-green-700 border-green-200' 
            : 'bg-gray-100 text-gray-600 border-gray-200';
        ?>
        <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full border <?php echo $statusClass ?>">
            <?php echo htmlspecialchars($etu->status); ?>
        </span>
        <form method="POST" action="">
    
    <input type="hidden" name="id_etudiant" value="<?php echo $etu->etudiant_id; ?>">
    <input type="hidden" name="id_cours" value="<?php echo $etu->cours_id; ?>">
    
    <button type="submit" name="marquer_termine" class="text-xs bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
        Marquer Terminé
    </button>
</form>
    </div>

</div>

<?php endforeach; ?>
        </div>
    </main>
</body>
</html>