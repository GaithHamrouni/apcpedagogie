<?php
require_once('connexion/connexion.php');

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si toutes les données nécessaires sont présentes
    if (isset($_POST['id_utilisateur']) && isset($_POST['id_cours']) && isset($_POST['id_video']) && isset($_POST['note'])) {
        // Récupère les données du formulaire
        $id_utilisateur = $_POST['id_utilisateur'];
        $id_cours = $_POST['id_cours'];
        $id_video = $_POST['id_video'];
        $note = $_POST['note'];
        $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : null; // Commentaire peut être facultatif

        // Prépare la requête SQL d'insertion
        $sql = "INSERT INTO Note (id_utilisateur, id_cours, id_video, note, commentaire) VALUES (:id_utilisateur, :id_cours, :id_video, :note, :commentaire)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->bindParam(':id_cours', $id_cours);
        $stmt->bindParam(':id_video', $id_video);
        $stmt->bindParam(':note', $note);
        $stmt->bindParam(':commentaire', $commentaire);

        // Exécute la requête
        if ($stmt->execute()) {
            // Redirige vers une page de succès
            header("Location:Note.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de la note.";
        }
    } else {
        echo "Toutes les données nécessaires n'ont pas été fournies.";
    }
} else {
    echo "Accès invalide à cette page.";
}
?>
