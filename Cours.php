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
      <h1 data-aos="fade-up" class="text-center mb-4">Liste des cours</h1>
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
          $sql = "SELECT COUNT(*) AS total FROM Cours WHERE 
                  titre LIKE :search OR 
                  description LIKE :search OR
                  categorie LIKE :search";
          $stmt = $pdo->prepare($sql);
          $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
          $stmt->execute();
      } else {
          $sql = "SELECT COUNT(*) AS total FROM Cours";
          $stmt = $pdo->query($sql);
      }

      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $total_pages = ceil($result['total'] / $limit);
      $offset = ($page - 1) * $limit;
      if (!empty($search)) {
          $sql = "SELECT * FROM Cours WHERE 
                  titre LIKE :search OR 
                  description LIKE :search OR
                  categorie LIKE :search
                  LIMIT :limit OFFSET :offset";
      } else {
          $sql = "SELECT * FROM Cours LIMIT :limit OFFSET :offset";
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
                        <button id="addCoursBtn" class="btn btn-outline-primary me-2">
                            <i class="bi bi-plus"></i>
                            Ajouter un Cours
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
                <th>Titre</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Durée (en heures)</th>
                <th>Actions</th>
              </tr>
            </thead>
            <?php
              // Récupération des résultats
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>"; 
                echo "<td>".$row["titre"]."</td>";
                echo "<td>".$row["description"]."</td>";
                echo "<td>".$row["categorie"]."</td>"; 
                echo "<td>".$row["prix"]."</td>";
                echo "<td>".$row["duree"]."</td>";
                echo "<td>"; 
                echo "<a href='edit_cours.php?id=".$row['id_cours']."'class='btn btn-outline-primary btn-sm'><i class='bi bi-pencil'></i></a>";
                echo "<a href='delete_cours.php?id=".$row['id_cours']."'class='btn btn-outline-danger btn-sm'><i class='bi bi-trash'></i></a>";
                echo "<a href='afficher_cours.php?id=".$row['id_cours']."'class='btn btn-outline-success btn-sm'><i class='bi bi-eye'></i></a>";
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
                <h5 class="modal-title">Créer un Cours</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <?php                
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $titre = htmlspecialchars($_POST['titre']);
                    $description = htmlspecialchars($_POST['description']);
                    $categorie = htmlspecialchars($_POST['categorie']);
                    $prix = htmlspecialchars($_POST['prix']);
                    $duree = htmlspecialchars($_POST['duree']);
                    
                    // Assuming $pdo is your database connection object
                    $sql = "INSERT INTO Cours (titre, description, categorie, prix, duree) 
                            VALUES (:titre, :description, :categorie, :prix, :duree)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':titre', $titre);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':categorie', $categorie);
                    $stmt->bindParam(':prix', $prix);
                    $stmt->bindParam(':duree', $duree);
                    
                    if ($stmt->execute()) {
                        echo '<div class="alert alert-success" role="alert">Cours créé avec succès!</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Erreur lors de la création du cours.</div>';
                    }
                }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categorie">Catégorie</label>
                        <input type="text" class="form-control" id="categorie" name="categorie" required>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" class="form-control" id="prix" name="prix" required>
                    </div>
                    <div class="form-group">
                        <label for="duree">Durée (en heures)</label>
                        <input type="text" class="form-control" id="duree" name="duree" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Créer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("addCoursBtn").addEventListener("click", function() {
        $('#showBtnModal').modal('show');
    });
</script>
<?php require_once("partials/footer.php");?>
