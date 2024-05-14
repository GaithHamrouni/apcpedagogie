<?php require_once("partials/navbar.php"); ?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

  <div class="container">
    <div class="row">
      <div class="col-lg-12 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Liste des notes</h1>
        <div data-aos="fade-up" data-aos-delay="600">
          <?php
          require_once('connexion/connexion.php');

          // Vérifier si l'identifiant de la note est passé en paramètre GET
          if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Préparez votre requête SQL pour récupérer les détails de la note
            $sql = "SELECT * FROM Note WHERE id_note = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Vérifiez s'il y a un résultat
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              // Affichez les détails de la note dans un formulaire pour l'édition
          ?>
              <form action="update_note.php" method="POST">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>ID Utilisateur</th>
                      <th>ID Cours</th>
                      <th>ID Vidéo</th>
                      <th>Note</th>
                      <th>Commentaire</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" name="id_utilisateur" value="<?php echo $row['id_utilisateur']; ?>"></td>
                      <td><input type="text" name="id_cours" value="<?php echo $row['id_cours']; ?>"></td>
                      <td><input type="text" name="id_video" value="<?php echo $row['id_video']; ?>"></td>
                      <td><input type="text" name="note" value="<?php echo $row['note']; ?>"></td>
                      <td><textarea name="commentaire"><?php echo $row['commentaire']; ?></textarea></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" name="id_note" value="<?php echo $row['id_note']; ?>">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </form>
          <?php
            } else {
              echo "Aucune note trouvée avec cet identifiant.";
            }
          } else {
            echo "Identifiant de note non spécifié.";
          }
          ?>

        </div>
      </div>

    </div>
  </div>

</section><!-- End Hero -->


<?php require_once("partials/footer.php"); ?>
