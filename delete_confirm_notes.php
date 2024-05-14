<?php
require_once('connexion/connexion.php');

// Vérifier si l'identifiant de la note est passé en paramètre POST
if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Assurez-vous que l'ID est un entier

    // Préparez votre requête SQL pour supprimer la note
    $sql = "DELETE FROM Note WHERE id_note = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    // Exécutez la requête et vérifiez si la suppression a réussi
    if ($stmt->execute()) {
        // Redirigez vers la page des notes après la suppression
        header("Location: Note.php");
        exit();
    } else {
        // Affichez un message d'erreur si la suppression a échoué
        echo "Erreur lors de la suppression de la note.";
    }
} else {
    // Affichez un message si l'identifiant de la note n'est pas spécifié
    echo "L'identifiant de la note n'est pas spécifié.";
}
?>
