<?php
session_start();

// Inclure les fichiers nécessaires
require_once 'database.php';
require_once 'controllers/UserController.php';

// Créer une instance du contrôleur
$userController = new UserController($pdo);

// Traiter le formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->login();
} else {
    // Afficher le formulaire de connexion
    $userController->showLoginForm();
}
?>
