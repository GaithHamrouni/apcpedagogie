<?php require_once("partials/navbar.php"); ?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
<div class="container-fluid mt-5">
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
              <form action="delete_confirm_notes.php" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette note ?');">
                <h2>Voulez-vous vraiment supprimer la note suivante ?</h2>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Utilisateur</th>
                      <th>Cours</th>
                      <th>Vidéo</th>
                      <th>Note</th>
                      <th>Commentaire</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $row['id_utilisateur']; ?></td>
                      <td><?php echo $row['id_cours']; ?></td>
                      <td><?php echo $row['id_video']; ?></td>
                      <td><?php echo $row['note']; ?></td>
                      <td><?php echo $row['commentaire']; ?></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" name="id" value="<?php echo $row['id_note']; ?>">
                <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                <a href="Note.php" class="btn btn-secondary">Annuler</a>
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
