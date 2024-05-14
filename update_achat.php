<?php
require_once('connexion/connexion.php');

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si toutes les données nécessaires sont présentes
    if (isset($_POST['id_utilisateur']) && isset($_POST['id_cours']) && isset($_POST['id_video']) && isset($_POST['date_achat']) && isset($_POST['montant']) && isset($_POST['mode_paiement'])) {
        // Récupère les données du formulaire
        $id_utilisateur = $_POST['id_utilisateur'];
        $id_cours = $_POST['id_cours'];
        $id_video = $_POST['id_video'];
        $date_achat = $_POST['date_achat'];
        $montant = $_POST['montant'];
        $mode_paiement = $_POST['mode_paiement'];
        $adresse_livraison = $_POST['adresse_livraison'];
        $ville_livraison = $_POST['ville_livraison'];
        $code_postal_livraison = $_POST['code_postal_livraison'];
        $pays_livraison = $_POST['pays_livraison'];

        // Prépare la requête SQL d'insertion
        $sql = "INSERT INTO Achat (id_utilisateur, id_cours, id_video, date_achat, montant, mode_paiement, adresse_livraison, ville_livraison, code_postal_livraison, pays_livraison) VALUES (:id_utilisateur, :id_cours, :id_video, :date_achat, :montant, :mode_paiement, :adresse_livraison, :ville_livraison, :code_postal_livraison, :pays_livraison)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->bindParam(':id_cours', $id_cours);
        $stmt->bindParam(':id_video', $id_video);
        $stmt->bindParam(':date_achat', $date_achat);
        $stmt->bindParam(':montant', $montant);
        $stmt->bindParam(':mode_paiement', $mode_paiement);
        $stmt->bindParam(':adresse_livraison', $adresse_livraison);
        $stmt->bindParam(':ville_livraison', $ville_livraison);
        $stmt->bindParam(':code_postal_livraison', $code_postal_livraison);
        $stmt->bindParam(':pays_livraison', $pays_livraison);

        // Exécute la requête
        if ($stmt->execute()) {
            // Redirige vers une page de succès
            header("Location:Achat.php");
            exit();
        } else {
            echo "Erreur lors de l'achat.";
        }
    } else {
        echo "Toutes les données nécessaires n'ont pas été fournies.";
    }
} else {
    echo "Accès invalide à cette page.";
}
?>
