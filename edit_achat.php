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
              <form action="update_achat.php" method="POST">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID Utilisateur</th>
                      <th>ID Cours</th>
                      <th>ID Vidéo</th>
                      <th>Date d'achat</th>
                      <th>Montant</th>
                      <th>Mode de paiement</th>
                      <th>Adresse de livraison</th>
                      <th>Ville de livraison</th>
                      <th>Code Postal de livraison</th>
                      <th>Pays de livraison</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" name="id_utilisateur" value="<?php echo $row['id_utilisateur']; ?>"></td>
                      <td><input type="text" name="id_cours" value="<?php echo $row['id_cours']; ?>"></td>
                      <td><input type="text" name="id_video" value="<?php echo $row['id_video']; ?>"></td>
                      <td><input type="date" name="date_achat" value="<?php echo $row['date_achat']; ?>"></td>
                      <td><input type="text" name="montant" value="<?php echo $row['montant']; ?>"></td>
                      <td><input type="text" name="mode_paiement" value="<?php echo $row['mode_paiement']; ?>"></td>
                      <td><input type="text" name="adresse_livraison" value="<?php echo $row['adresse_livraison']; ?>"></td>
                      <td><input type="text" name="ville_livraison" value="<?php echo $row['ville_livraison']; ?>"></td>
                      <td><input type="text" name="code_postal_livraison" value="<?php echo $row['code_postal_livraison']; ?>"></td>
                      <td><input type="text" name="pays_livraison" value="<?php echo $row['pays_livraison']; ?>"></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" name="id_achat" value="<?php echo $row['id_achat']; ?>">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
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
