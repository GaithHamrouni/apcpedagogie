<?php
session_start();

require_once('connexion/connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT password FROM login WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch();
    if ($row) {
        $hashed_password = $row['password'];
        if (password_verify($password, $hashed_password)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $email;
            header('Location: Success.php');
            exit;
        } else {
            $_SESSION['error_message'] = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        $_SESSION['error_message'] = "Nom d'utilisateur ou mot de passe incorrect.";
    }
    header('Location: index.php');
    exit;
}
?>
