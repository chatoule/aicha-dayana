<?php
class UserController {
    private $userModel;

    // Constructeur pour initialiser le modèle
    public function __construct($pdo) {
        $this->userModel = new UserModel($pdo);
    }

    // Méthode pour afficher le formulaire de connexion
    public function showLoginForm() {
        include 'views/loginForm.php';
    }

    // Méthode pour traiter la soumission du formulaire de connexion
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Vérifier si l'utilisateur existe
            $user = $this->userModel->authenticate($email, $password);

            if ($user) {
                // L'utilisateur est authentifié
                $_SESSION['user'] = $user; // Sauvegarder les infos de l'utilisateur dans la session
                header('Location: dashboard.php'); // Rediriger vers la page d'accueil
            } else {
                // L'utilisateur ou mot de passe est incorrect
                $error = "Identifiants incorrects.";
                include 'views/loginForm.php'; // Afficher à nouveau le formulaire avec un message d'erreur
            }
        }
    }
}
