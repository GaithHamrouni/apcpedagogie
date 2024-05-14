<?php
require_once('connexion/connexion.php');

// Vérifier si l'identifiant de l'utilisateur est passé en paramètre POST
if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Assurez-vous que l'ID est un entier

    // Préparez votre requête SQL pour supprimer l'utilisateur
    $sql = "DELETE FROM Utilisateur WHERE id_utilisateur = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    // Exécutez la requête et vérifiez si la suppression a réussi
    if ($stmt->execute()) {
        // Redirigez vers la page des utilisateurs après la suppression
        header("Location: utilisateur.php");
        exit();
    } else {
        // Affichez un message d'erreur si la suppression a échoué
        echo "Erreur lors de la suppression de l'utilisateur.";
    }
} else {
    // Affichez un message si l'identifiant de l'utilisateur n'est pas spécifié
    echo "L'identifiant de l'utilisateur n'est pas spécifié.";
}
?>
