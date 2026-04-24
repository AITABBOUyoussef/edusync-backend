# 🎓 EduSync - Système d'Authentification Sécurisé

## 📝 Description
EduSync est une application web développée en PHP natif et MySQL. Ce projet se concentre sur la création d'un système d'authentification robuste et sécurisé, en respectant les bonnes pratiques de développement web et en appliquant des mesures strictes de cybersécurité.

## ✨ Fonctionnalités Principales
* **Inscription (Register)** : Validation stricte des données entrantes (longueur du nom, format email) et hachage des mots de passe en utilisant l'algorithme `Bcrypt`.
* **Connexion (Login)** : Vérification sécurisée des identifiants avec la fonction `password_verify()`.
* **Tableau de Bord (Dashboard)** : Espace personnel protégé par le système de sessions PHP (`$_SESSION`), empêchant tout accès non autorisé.
* **Sécurité Avancée** : 
  * Prévention des failles **XSS** via `htmlspecialchars()`.
  * Prévention des **Injections SQL** via `mysqli_real_escape_string()`.

## 🛠️ Technologies Utilisées
* **Back-end** : PHP 8
* **Base de données** : MySQL
* **Front-end** : HTML5, Tailwind CSS
* **Environnement** : XAMPP / Apache

## 🚀 Installation & Déploiement
1. Placez le dossier du projet dans le répertoire `htdocs` de votre serveur XAMPP.
2. Configuration de la base de données :
   - Ouvrez phpMyAdmin et créez une base de données nommée `edu`.
   - Créez une table `users` contenant les colonnes : `id` (A_I, Primary), `nom`, `email`, et `password`.
3. Configuration du serveur :
   - Vérifiez vos accès dans le fichier `inclu/connect.php` (par défaut : `$user = 'root'`, `$pass = ''`).
4. Lancez les modules Apache et MySQL sur XAMPP.
5. Accédez à l'application via : `http://localhost/edu/login.php`

## **Youssef Ait Abo**
