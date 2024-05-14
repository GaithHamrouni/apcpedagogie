<?php require_once("partials/navbar.php"); ?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-lg-12 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Liste des utilisateurs</h1>
        <div data-aos="fade-up" data-aos-delay="600">
          <?php
          require_once('connexion/connexion.php');

          // Vérifier si l'identifiant de l'utilisateur est passé en paramètre GET
          if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Préparez votre requête SQL pour récupérer les détails de l'utilisateur
            $sql = "SELECT * FROM Utilisateur WHERE id_utilisateur = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Vérifiez s'il y a un résultat
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              // Affichez les détails de l'utilisateur dans un formulaire pour l'édition
          ?>
              <form action="update_utilisateur.php" method="POST">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>Email</th>
                      <th>Mot de passe</th>
                      <th>Adresse</th>
                      <th>Ville</th>
                      <th>Code Postal</th>
                      <th>Pays</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" name="nom" value="<?php echo $row['nom']; ?>"></td>
                      <td><input type="text" name="prenom" value="<?php echo $row['prenom']; ?>"></td>
                      <td><input type="text" name="email" value="<?php echo $row['email']; ?>"></td>
                      <td><input type="text" name="mot_de_passe" value="<?php echo $row['mot_de_passe']; ?>"></td>
                      <td><input type="text" name="adresse" value="<?php echo $row['adresse']; ?>"></td>
                      <td><input type="text" name="ville" value="<?php echo $row['ville']; ?>"></td>
                      <td><input type="text" name="code_postal" value="<?php echo $row['code_postal']; ?>"></td>
                      <td><input type="text" name="pays" value="<?php echo $row['pays']; ?>"></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" name="id_utilisateur" value="<?php echo $row['id_utilisateur']; ?>">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </form>
          <?php
            } else {
              echo "Aucun utilisateur trouvé avec cet identifiant.";
            }
          } else {
            echo "Identifiant d'utilisateur non spécifié.";
          }
          ?>

        </div>
      </div>

    </div>
  </div>

</section><!-- End Hero -->


<?php require_once("partials/footer.php"); ?>
