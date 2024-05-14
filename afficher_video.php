<?php require_once("partials/navbar.php");?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container-fluid mt-5">
      <div class="row">
        <div class="col-lg-12 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Détails de la vidéo</h1>
          <div data-aos="fade-up" data-aos-delay="600">
         
           <?php
            require_once('connexion/connexion.php');

            // Vérifie si l'identifiant de la vidéo est passé en paramètre GET
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                // Préparez votre requête SQL pour récupérer les détails de la vidéo
                $sql = "SELECT * FROM Vidéo WHERE id_video = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                // Vérifie s'il y a un résultat
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Affichez les détails de la vidéo dans un tableau
            ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Durée</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $row['titre']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['categorie']; ?></td>
                            <td><?php echo $row['prix']; ?></td>
                            <td><?php echo $row['duree']; ?></td>
                        </tr>
                    </tbody>
                </table>
                 <!-- Bouton de retour -->
                 <a href="video.php" class="btn btn-secondary">Retour</a>
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

  
 <?php require_once("partials/footer.php");?>
