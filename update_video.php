<?php
require_once('connexion/connexion.php');

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si toutes les données nécessaires sont présentes
    if (isset($_POST['id_video']) && isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['categorie']) && isset($_POST['prix']) && isset($_POST['duree'])) {
        // Récupère les données du formulaire
        $id_video = $_POST['id_video'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $categorie = $_POST['categorie'];
        $prix = $_POST['prix'];
        $duree = $_POST['duree'];

        // Prépare la requête SQL de mise à jour
        $sql = "UPDATE Vidéo SET titre = :titre, description = :description, categorie = :categorie, prix = :prix, duree = :duree WHERE id_video = :id_video";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':categorie', $categorie);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':duree', $duree);
        $stmt->bindParam(':id_video', $id_video);

        // Exécute la requête
        if ($stmt->execute()) {
            // Redirige vers une page de succès
            header("Location:Video.php");
            exit();
        } else {
            echo "Erreur lors de la mise à jour de la vidéo.";
        }
    } else {
        echo "Toutes les données nécessaires n'ont pas été fournies.";
    }
} else {
    echo "Accès invalide à cette page.";
}
?>
