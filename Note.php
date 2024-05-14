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
    <h1 data-aos="fade-up" class="text-center mb-4">Liste des notes</h1>
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
              $sql = "SELECT COUNT(*) AS total FROM Note WHERE 
                      id_utilisateur IN (SELECT id_utilisateur FROM Utilisateur WHERE nom LIKE :search OR prenom LIKE :search) OR
                      id_cours IN (SELECT id_cours FROM Cours WHERE titre LIKE :search) OR
                      id_video IN (SELECT id_video FROM Video WHERE titre LIKE :search) OR
                      commentaire LIKE :search";
              $stmt = $pdo->prepare($sql);
              $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
              $stmt->execute();
          } else {
              $sql = "SELECT COUNT(*) AS total FROM Note";
              $stmt = $pdo->query($sql);
          }

          $result = $stmt->fetch(PDO::FETCH_ASSOC);
          $total_pages = ceil($result['total'] / $limit);
          $offset = ($page - 1) * $limit;
          if (!empty($search)) {
              $sql = "SELECT * FROM Note WHERE 
                      id_utilisateur IN (SELECT id_utilisateur FROM Utilisateur WHERE nom LIKE :search OR prenom LIKE :search) OR
                      id_cours IN (SELECT id_cours FROM Cours WHERE titre LIKE :search) OR
                      id_video IN (SELECT id_video FROM Video WHERE titre LIKE :search) OR
                      commentaire LIKE :search
                      LIMIT :limit OFFSET :offset";
          } else {
              $sql = "SELECT * FROM Note LIMIT :limit OFFSET :offset";
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
                        <button id="addNoteBtn" class="btn btn-outline-primary me-2">
                            <i class="bi bi-plus"></i>
                            Ajouter un Notes
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
              <th>ID Note</th>
              <th>ID Utilisateur</th>
              <th>ID Cours</th>
              <th>ID Vidéo</th>
              <th>Note</th>
              <th>Commentaire</th>
              <th>Actions</th>
            </tr>
          </thead>
          <?php
            // Récupération des résultats
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>"; 
              echo "<td>".$row["id_note"]."</td>";
              echo "<td>".$row["id_utilisateur"]."</td>";
              echo "<td>".$row["id_cours"]."</td>";
              echo "<td>".$row["id_video"]."</td>";
              echo "<td>".$row["note"]."</td>";
              echo "<td>".$row["commentaire"]."</td>";
              echo "<td>"; 
              echo "<a href='edit_note.php?id=".$row['id_note']."'class='btn btn-outline-primary btn-sm'><i class='bi bi-pencil'></i></a>";
              echo "<a href='delete_note.php?id=".$row['id_note']."'class='btn btn-outline-danger btn-sm'><i class='bi bi-trash'></i></a>";
              echo "<a href='afficher_note.php?id=".$row['id_note']."'class='btn btn-outline-success btn-sm'><i class='bi bi-eye'></i></a>";
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
                <h5 class="modal-title">Créer une Note</h5>
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
                    $note = htmlspecialchars($_POST['note']);
                    $commentaire = htmlspecialchars($_POST['commentaire']);
                    
                    // Assuming $pdo is your database connection object
                    $sql = "INSERT INTO Note (id_utilisateur, id_cours, id_video, note, commentaire) 
                            VALUES (:id_utilisateur, :id_cours, :id_video, :note, :commentaire)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
                    $stmt->bindParam(':id_cours', $id_cours);
                    $stmt->bindParam(':id_video', $id_video);
                    $stmt->bindParam(':note', $note);
                    $stmt->bindParam(':commentaire', $commentaire);
                    
                    if ($stmt->execute()) {
                        echo '<div class="alert alert-success" role="alert">Note créée avec succès!</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Erreur lors de la création de la note.</div>';
                    }
                }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="id_utilisateur">ID Utilisateur</label>
                        <input type="text" class="form-control" id="id_utilisateur" name="id_utilisateur" required>
                    </div>
                    <div class="form-group">
                        <label for="id_cours">ID Cours</label>
                        <input type="text" class="form-control" id="id_cours" name="id_cours">
                    </div>
                    <div class="form-group">
                        <label for="id_video">ID Vidéo</label>
                        <input type="text" class="form-control" id="id_video" name="id_video">
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <input type="text" class="form-control" id="note" name="note" required>
                    </div>
                    <div class="form-group">
                        <label for="commentaire">Commentaire</label>
                        <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Créer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("addNoteBtn").addEventListener("click", function() {
        $('#showBtnModal').modal('show');
    });
</script>
<?php require_once("partials/footer.php");?>
