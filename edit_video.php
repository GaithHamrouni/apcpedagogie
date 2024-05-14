<?php require_once("partials/navbar.php"); ?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
<div class="container-fluid mt-5">
    <div class="row">
      <div class="col-lg-12 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Liste des vidéos</h1>
        <div data-aos="fade-up" data-aos-delay="600">
          <?php
          require_once('connexion/connexion.php');

          // Vérifier si l'identifiant de la vidéo est passé en paramètre GET
          if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Préparez votre requête SQL pour récupérer les détails de la vidéo
            $sql = "SELECT * FROM Vidéo WHERE id_video = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Vérifiez s'il y a un résultat
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              // Affichez les détails de la vidéo dans un formulaire pour l'édition
          ?>
              <form action="update_video.php" method="POST">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Titre</th>
                      <th>Description</th>
                      <th>Catégorie</th>
                      <th>Prix</th>
                      <th>Durée (en minutes)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" name="titre" value="<?php echo $row['titre']; ?>"></td>
                      <td><textarea name="description"><?php echo $row['description']; ?></textarea></td>
                      <td><input type="text" name="categorie" value="<?php echo $row['categorie']; ?>"></td>
                      <td><input type="text" name="prix" value="<?php echo $row['prix']; ?>"></td>
                      <td><input type="text" name="duree" value="<?php echo $row['duree']; ?>"></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" name="id_video" value="<?php echo $row['id_video']; ?>">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </form>
          <?php
            } else {
              echo "Aucune vidéo trouvée avec cet identifiant.";
            }
          } else {
            echo "Identifiant de vidéo non spécifié.";
          }
          ?>

        </div>
      </div>

    </div>
  </div>

</section><!-- End Hero -->


<?php require_once("partials/footer.php"); ?>
