<?php
require_once('connexion/connexion.php');

// Vérifier si l'identifiant de la vidéo est passé en paramètre POST
if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Assurez-vous que l'ID est un entier

    // Préparez votre requête SQL pour supprimer la vidéo
    $sql = "DELETE FROM Vidéo WHERE id_video = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    // Exécutez la requête et vérifiez si la suppression a réussi
    if ($stmt->execute()) {
        // Redirigez vers la page des vidéos après la suppression
        header("Location: Video.php");
        exit();
    } else {
        // Affichez un message d'erreur si la suppression a échoué
        echo "Erreur lors de la suppression de la vidéo.";
    }
} else {
    // Affichez un message si l'identifiant de la vidéo n'est pas spécifié
    echo "L'identifiant de la vidéo n'est pas spécifié.";
}
?>
