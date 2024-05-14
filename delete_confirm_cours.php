<?php
require_once('connexion/connexion.php');

// Vérifier si l'identifiant du cours est passé en paramètre POST
if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Assurez-vous que l'ID est un entier

    // Préparez votre requête SQL pour supprimer le cours
    $sql = "DELETE FROM Cours WHERE id_cours = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    // Exécutez la requête et vérifiez si la suppression a réussi
    if ($stmt->execute()) {
        // Redirigez vers la page des cours après la suppression
        header("Location: Cours.php");
        exit();
    } else {
        // Affichez un message d'erreur si la suppression a échoué
        echo "Erreur lors de la suppression du cours.";
    }
} else {
    // Affichez un message si l'identifiant du cours n'est pas spécifié
    echo "L'identifiant du cours n'est pas spécifié.";
}
?>
