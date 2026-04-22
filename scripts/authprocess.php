<?php
// Initialisation de la session (US6) - Doit être la première instruction
session_start();

// Inclusion de la connexion à la base de données
require_once '../includes/db.php';

// Vérification de la méthode de requête
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Détermination de l'action à exécuter (login ou register)
    $action = isset($_POST['action']) ? $_POST['action'] : 'register';

    /* ==========================================
       TRAITEMENT DE L'INSCRIPTION (REGISTER)
       ========================================== */
    if ($action === 'register') {
        
        // Nettoyage des données (US3: Sanitization)
        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);

        // Validation des champs obligatoires (US2)
        if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
            header("Location: ../public/register.php?error=empty_fields");
            exit();
        }

        // Hachage du mot de passe pour la sécurité
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Insertion sécurisée dans la base de données
            $sql = "INSERT INTO users (nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':email' => $email,
                ':password' => $hashed_password
            ]);

            // Redirection vers la page de connexion avec succès
            header("Location: ../public/login.php?success=registered");
            exit();

        } catch (PDOException $e) {
            // Gestion de l'erreur d'email dupliqué (Code 23000)
            if ($e->getCode() == 23000) {
                header("Location: ../public/register.php?error=email_exists");
                exit();
            } else {
                die("Erreur serveur : " . $e->getMessage());
            }
        }
    }

    /* ==========================================
       TRAITEMENT DE LA CONNEXION (LOGIN)
       ========================================== */
    elseif ($action === 'login') {
        
        // Nettoyage des données de connexion
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);

        // Validation des champs
        if (empty($email) || empty($password)) {
            header("Location: ../public/login.php?error=empty_fields");
            exit();
        }

        try {
            // Récupération de l'utilisateur via son email
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérification des identifiants (US4)
            if ($user && password_verify($password, $user['password'])) {
                
                // Régénération de l'ID de session pour éviter les attaques de fixation
                session_regenerate_id(true);

                // Création des variables de session (US6)
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nom'] = $user['nom'];
                $_SESSION['user_prenom'] = $user['prenom'];
                $_SESSION['user_role'] = $user['role'];

                // Redirection vers le tableau de bord sécurisé
                header("Location: ../public/dashboard.php");
                exit();

            } else {
                // Échec d'authentification (US5)
                header("Location: ../public/login.php?error=invalid_credentials");
                exit();
            }

        } catch (PDOException $e) {
            die("Erreur serveur : " . $e->getMessage());
        }
    }

} else {
    // Redirection si accès direct sans soumission de formulaire
    header("Location: ../public/index.php");
    exit();
}
?>