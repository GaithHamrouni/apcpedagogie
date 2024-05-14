<?php
session_start();

require_once('connexion/connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO login (email, password) VALUES (:email, :password)");
    $stmt->execute(['email' => $email, 'password' => $hashed_password]);
    
    header("Location: Success.php");
    exit;
}
?>
