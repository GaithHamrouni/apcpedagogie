<?php
require_once('connexion/connexion.php');

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si toutes les données nécessaires sont présentes
    if (isset($_POST['id_cours']) && isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['categorie']) && isset($_POST['prix']) && isset($_POST['duree'])) {
        // Récupère les données du formulaire
        $id_cours = $_POST['id_cours'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $categorie = $_POST['categorie'];
        $prix = $_POST['prix'];
        $duree = $_POST['duree'];

        // Prépare la requête SQL de mise à jour
        $sql = "UPDATE Cours SET titre = :titre, description = :description, categorie = :categorie, prix = :prix, duree = :duree WHERE id_cours = :id_cours";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':categorie', $categorie);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':duree', $duree);
        $stmt->bindParam(':id_cours', $id_cours);

        // Exécute la requête
        if ($stmt->execute()) {
            // Redirige vers une page de succès
            header("Location:Cours.php");
            exit();
        } else {
            echo "Erreur lors de la mise à jour du cours.";
        }
    } else {
        echo "Toutes les données nécessaires n'ont pas été fournies.";
    }
} else {
    echo "Accès invalide à cette page.";
}
?>
