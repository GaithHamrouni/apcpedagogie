<?php require_once("partials/navbar.php"); ?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
<div class="container-fluid mt-5">
    <div class="row">
      <div class="col-lg-12 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Liste des achats</h1>
        <div data-aos="fade-up" data-aos-delay="600">
          <?php
          require_once('connexion/connexion.php');

          // Vérifier si l'identifiant de l'achat est passé en paramètre GET
          if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Préparez votre requête SQL pour récupérer les détails de l'achat
            $sql = "SELECT * FROM Achat WHERE id_achat = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Vérifiez s'il y a un résultat
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              // Affichez les détails de l'achat dans un formulaire pour l'édition
          ?>
              <form action="delete_confirm_achats.php" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet achat ?');">
                <h2>Voulez-vous vraiment supprimer l'achat suivant ?</h2>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Utilisateur</th>
                      <th>Cours</th>
                      <th>Vidéo</th>
                      <th>Date d'achat</th>
                      <th>Montant</th>
                      <th>Mode de paiement</th>
                      <th>Adresse de livraison</th>
                      <th>Ville de livraison</th>
                      <th>Code postal de livraison</th>
                      <th>Pays de livraison</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $row['id_utilisateur']; ?></td>
                      <td><?php echo $row['id_cours']; ?></td>
                      <td><?php echo $row['id_video']; ?></td>
                      <td><?php echo $row['date_achat']; ?></td>
                      <td><?php echo $row['montant']; ?></td>
                      <td><?php echo $row['mode_paiement']; ?></td>
                      <td><?php echo $row['adresse_livraison']; ?></td>
                      <td><?php echo $row['ville_livraison']; ?></td>
                      <td><?php echo $row['code_postal_livraison']; ?></td>
                      <td><?php echo $row['pays_livraison']; ?></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" name="id" value="<?php echo $row['id_achat']; ?>">
                <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                <a href="Achat.php" class="btn btn-secondary">Annuler</a>
              </form>
          <?php
            } else {
              echo "Aucun achat trouvé avec cet identifiant.";
            }
          } else {
            echo "Identifiant d'achat non spécifié.";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero -->
<?php require_once("partials/footer.php"); ?>
