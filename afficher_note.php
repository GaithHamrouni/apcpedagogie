<?php require_once("partials/navbar.php");?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
  <div class="container-fluid mt-5">
      <div class="row">
        <div class="col-lg-12 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Détails de la note</h1>
          <div data-aos="fade-up" data-aos-delay="600">
         
           <?php
            require_once('connexion/connexion.php');

            // Vérifie si l'identifiant de la note est passé en paramètre GET
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                // Préparez votre requête SQL pour récupérer les détails de la note
                $sql = "SELECT * FROM Note WHERE id_note = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                // Vérifie s'il y a un résultat
                if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Affichez les détails de la note dans un tableau
            ?>
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
                 <!-- Bouton de retour -->
                 <a href="Note.php" class="btn btn-secondary">Retour</a>
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

  
 <?php require_once("partials/footer.php");?>
