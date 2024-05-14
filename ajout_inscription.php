<?php
require_once('connexion/connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : "";
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $dob = isset($_POST['dob']) ? $_POST['dob'] : "";
    $city = isset($_POST['city']) ? $_POST['city'] : "";
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $hashed_confirm_password = password_hash($confirm_password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO inscription (first_name, last_name, email, dob, city, telephone, password, confirm_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$first_name, $last_name, $email, $dob, $city, $telephone, $hashed_password, $hashed_confirm_password]);

    if ($stmt->rowCount() > 0) {
        header("Location: index.php");
        exit;
    } else {
        echo "Une erreur s'est produite lors de l'insertion de l'enregistrement.";
    }
}
?>
