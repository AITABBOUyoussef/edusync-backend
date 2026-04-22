<?php
// 1. Récupération de la session existante
session_start();

// 2. Vidage de toutes les variables de session (on efface les données)
$_SESSION = array();

// 3. Destruction complète de la session côté serveur (US8)
session_destroy();

// 4. Redirection vers la page de connexion
header("Location: ../public/login.php");
exit();
?>