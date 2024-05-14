<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}
?>
<?php require_once("partials/navbar.php");?>
<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-lg-12 d-flex flex-column justify-content-center">
    <h1 data-aos="fade-up" class="text-center mb-4">Liste des achats</h1>
      <div data-aos="fade-up" data-aos-delay="600">
        <?php
          require_once('connexion/connexion.php');
          $limit = 2;
          $search = ""; 
          $page = isset($_GET['page']) ? $_GET['page'] : 1;
          if (isset($_GET['search']) && !empty($_GET['search'])) {
              $search = $_GET['search'];
          }
          if (!empty($search)) {
              $sql = "SELECT COUNT(*) AS total FROM Achat WHERE 
                      id_utilisateur IN (SELECT id_utilisateur FROM Utilisateur WHERE nom LIKE :search OR prenom LIKE :search) OR
                      id_cours IN (SELECT id_cours FROM Cours WHERE titre LIKE :search) OR
                      id_video IN (SELECT id_video FROM Video WHERE titre LIKE :search) OR
                      adresse_livraison LIKE :search OR
                      ville_livraison LIKE :search OR
                      code_postal_livraison LIKE :search OR
                      pays_livraison LIKE :search";
              $stmt = $pdo->prepare($sql);
              $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
              $stmt->execute();
          } else {
              $sql = "SELECT COUNT(*) AS total FROM Achat";
              $stmt = $pdo->query($sql);
          }

          $result = $stmt->fetch(PDO::FETCH_ASSOC);
          $total_pages = ceil($result['total'] / $limit);
          $offset = ($page - 1) * $limit;
          if (!empty($search)) {
              $sql = "SELECT * FROM Achat WHERE 
                      id_utilisateur IN (SELECT id_utilisateur FROM Utilisateur WHERE nom LIKE :search OR prenom LIKE :search) OR
                      id_cours IN (SELECT id_cours FROM Cours WHERE titre LIKE :search) OR
                      id_video IN (SELECT id_video FROM Video WHERE titre LIKE :search) OR
                      adresse_livraison LIKE :search OR
                      ville_livraison LIKE :search OR
                      code_postal_livraison LIKE :search OR
                      pays_livraison LIKE :search
                      LIMIT :limit OFFSET :offset";
          } else {
              $sql = "SELECT * FROM Achat LIMIT :limit OFFSET :offset";
          }

          $stmt = $pdo->prepare($sql);
          $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
          $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
          if (!empty($search)) {
              $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
          }
          $stmt->execute();

        ?>

                    <div class="row mb-3">
                    <div class="col-12 col-md-6 mb-2">
                        <button id="addAchatBtn" class="btn btn-outline-primary me-2">
                            <i class="bi bi-plus"></i>
                            Ajouter un Achats
                        </button>
                    </div>
                    <div class="col-12 col-md-6">
                        <form class="d-flex" action="" method="GET">
                            <input class="form-control me-2" name="search" type="search" placeholder="Recherche..." aria-label="Search" value="<?php if (isset($search)) {echo htmlentities($search);} ?>">
                            <button class="btn btn-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID Achat</th>
              <th>ID Utilisateur</th>
              <th>ID Cours</th>
              <th>ID Vidéo</th>
              <th>Date d'Achat</th>
              <th>Montant</th>
              <th>Mode de Paiement</th>
              <th>Adresse de Livraison</th>
              <th>Ville de Livraison</th>
              <th>Code Postal de Livraison</th>
              <th>Pays de Livraison</th>
              <th>Actions</th>
            </tr>
          </thead>
          <?php
            // Récupération des résultats
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>"; 
              echo "<td>".$row["id_achat"]."</td>";
              echo "<td>".$row["id_utilisateur"]."</td>";
              echo "<td>".$row["id_cours"]."</td>";
              echo "<td>".$row["id_video"]."</td>";
              echo "<td>".$row["date_achat"]."</td>";
              echo "<td>".$row["montant"]."</td>";
              echo "<td>".$row["mode_paiement"]."</td>";
              echo "<td>".$row["adresse_livraison"]."</td>"; 
              echo "<td>".$row["ville_livraison"]."</td>";
              echo "<td>".$row["code_postal_livraison"]."</td>";
              echo "<td>".$row["pays_livraison"]."</td>";
              echo "<td>"; 
              echo "<a href='edit_achat.php?id=".$row['id_achat']."'class='btn btn-outline-primary btn-sm'><i class='bi bi-pencil'></i></a>";
              echo "<a href='delete_achat.php?id=".$row['id_achat']."'class='btn btn-outline-danger btn-sm'><i class='bi bi-trash'></i></a>";
              echo "<a href='afficher_achat.php?id=".$row['id_achat']."'class='btn btn-outline-success btn-sm'><i class='bi bi-eye'></i></a>";
              echo "</td>";
              echo "</tr>";
            }
          ?>
        </table>
        <!-- Pagination -->
        <div class="d-flex justify-content-center"> 
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?search=<?php echo $search; ?>&page=<?php echo ($page - 1); ?>">&laquo; Précédent</a></li>
              <?php endif; ?>
              <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($page == $i) echo 'active'; ?>"><a class="page-link" href="?search=<?php echo $search; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
              <?php endfor; ?>
              <?php if ($page < $total_pages): ?>
                <li class="page-item"><a class="page-link" href="?search=<?php echo $search; ?>&page=<?php echo ($page + 1); ?>">Suivant &raquo;</a></li>
              <?php endif; ?>
            </ul>
          </nav>
        </div> 
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="showBtnModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Enregistrer un Achat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <?php                
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $id_utilisateur = htmlspecialchars($_POST['id_utilisateur']);
                    $id_cours = htmlspecialchars($_POST['id_cours']);
                    $id_video = htmlspecialchars($_POST['id_video']);
                    $date_achat = htmlspecialchars($_POST['date_achat']);
                    $montant = htmlspecialchars($_POST['montant']);
                    $mode_paiement = htmlspecialchars($_POST['mode_paiement']);
                    $adresse_livraison = htmlspecialchars($_POST['adresse_livraison']);
                    $ville_livraison = htmlspecialchars($_POST['ville_livraison']);
                    $code_postal_livraison = htmlspecialchars($_POST['code_postal_livraison']);
                    $pays_livraison = htmlspecialchars($_POST['pays_livraison']);
                    
                    // Assuming $pdo is your database connection object
                    $sql = "INSERT INTO Achat (id_utilisateur, id_cours, id_video, date_achat, montant, mode_paiement, adresse_livraison, ville_livraison, code_postal_livraison, pays_livraison) 
                            VALUES (:id_utilisateur, :id_cours, :id_video, :date_achat, :montant, :mode_paiement, :adresse_livraison, :ville_livraison, :code_postal_livraison, :pays_livraison)";
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
                    
                    if ($stmt->execute()) {
                        echo '<div class="alert alert-success" role="alert">Achat enregistré avec succès!</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'enregistrement de l\'achat.</div>';
                    }
                }
                ?>
                    <div class="row">
                    <div class="col-md-6">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="id_utilisateur">ID Utilisateur</label>
                                <input type="text" class="form-control" id="id_utilisateur" name="id_utilisateur" required>
                            </div>
                            <div class="form-group">
                                <label for="id_cours">ID Cours</label>
                                <input type="text" class="form-control" id="id_cours" name="id_cours" required>
                            </div>
                            <div class="form-group">
                                <label for="id_video">ID Vidéo</label>
                                <input type="text" class="form-control" id="id_video" name="id_video" required>
                            </div>
                            <div class="form-group">
                                <label for="date_achat">Date d'Achat</label>
                                <input type="date" class="form-control" id="date_achat" name="date_achat" required>
                            </div>
                            <div class="form-group">
                                <label for="montant">Montant</label>
                                <input type="text" class="form-control" id="montant" name="montant" required>
                            </div>
                            <div class="form-group">
                                <label for="mode_paiement">Mode de Paiement</label>
                                <input type="text" class="form-control" id="mode_paiement" name="mode_paiement" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="adresse_livraison">Adresse de Livraison</label>
                                <input type="text" class="form-control" id="adresse_livraison" name="adresse_livraison">
                            </div>
                            <div class="form-group">
                                <label for="ville_livraison">Ville de Livraison</label>
                                <input type="text" class="form-control" id="ville_livraison" name="ville_livraison">
                            </div>
                            <div class="form-group">
                                <label for="code_postal_livraison">Code Postal de Livraison</label>
                                <input type="text" class="form-control" id="code_postal_livraison" name="code_postal_livraison">
                            </div>
                            <div class="form-group">
                                <label for="pays_livraison">Pays de Livraison</label>
                                <input type="text" class="form-control" id="pays_livraison" name="pays_livraison">
                            </div>

                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("addAchatBtn").addEventListener("click", function() {
        $('#showBtnModal').modal('show');
    });
</script>


<?php require_once("partials/footer.php");?>
