<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}
?>

<?php require_once("partials/navbar.php"); ?>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-12 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up" class="text-center mb-4">Liste des utilisateurs</h1>
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
                    $sql = "SELECT COUNT(*) AS total FROM Utilisateur WHERE 
                            nom LIKE :search OR 
                            prenom LIKE :search OR
                            email LIKE :search OR
                            mot_de_passe LIKE :search OR
                            ville LIKE :search OR
                            adresse LIKE :search OR
                            code_postal LIKE :search OR
                            pays LIKE :search";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                    $stmt->execute();
                } else {
                    $sql = "SELECT COUNT(*) AS total FROM Utilisateur";
                    $stmt = $pdo->query($sql);
                }

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $total_pages = ceil($result['total'] / $limit);
                $offset = ($page - 1) * $limit;
                if (!empty($search)) {
                    $sql = "SELECT * FROM Utilisateur WHERE 
                            nom LIKE :search OR 
                            prenom LIKE :search OR
                            email LIKE :search OR
                            mot_de_passe LIKE :search
                            ville LIKE :search OR
                            adresse LIKE :search OR
                            code_postal LIKE :search OR
                            pays LIKE :search OR
                            LIMIT :limit OFFSET :offset";
                } else {
                    $sql = "SELECT * FROM Utilisateur LIMIT :limit OFFSET :offset";
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
                        <button id="addutilisateursBtn" class="btn btn-outline-primary me-2">
                            <i class="bi bi-plus"></i>
                            Ajouter un utilisateur
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
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Mot de Passe</th>
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Code Postal</th>
                            <th>Pays</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <?php
                    // Récupération des résultats
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row["nom"] . "</td>";
                        echo "<td>" . $row["prenom"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["mot_de_passe"] . "</td>";
                        echo "<td>" . $row["adresse"] . "</td>";
                        echo "<td>" . $row["ville"] . "</td>";
                        echo "<td>" . $row["code_postal"] . "</td>";
                        echo "<td>" . $row["pays"] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_utilisateur.php?id=" . $row['id_utilisateur'] . "'class='btn btn-outline-primary btn-sm'><i class='bi bi-pencil'></i></a>";
                        echo "<a href='delete_utilisateur.php?id=" . $row['id_utilisateur'] . "'class='btn btn-outline-danger btn-sm'><i class='bi bi-trash'></i></a>";
                        echo "<a href='afficher_utilisateur.php?id=" . $row['id_utilisateur'] . "'class='btn btn-outline-success btn-sm'><i class='bi bi-eye'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php if ($page > 1) : ?>
                                <li class="page-item"><a class="page-link" href="?search=<?php echo $search; ?>&page=<?php echo ($page - 1); ?>">&laquo; Précédent</a></li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item <?php if ($page == $i) echo 'active'; ?>"><a class="page-link" href="?search=<?php echo $search; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                            <?php if ($page < $total_pages) : ?>
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
                <h5 class="modal-title">Créer un Utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <?php                
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nom = htmlspecialchars($_POST['nom']);
                    $prenom = htmlspecialchars($_POST['prenom']);
                    $email = htmlspecialchars($_POST['email']);
                    $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
                    $adresse = htmlspecialchars($_POST['adresse']);
                    $ville = htmlspecialchars($_POST['ville']);
                    $code_postal = htmlspecialchars($_POST['code_postal']);
                    $pays = htmlspecialchars($_POST['pays']);
                    
                    $sql = "INSERT INTO Utilisateur (nom, prenom, email, mot_de_passe, adresse, ville, code_postal, pays) 
                            VALUES (:nom, :prenom, :email, :mot_de_passe, :adresse, :ville, :code_postal, :pays)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':prenom', $prenom);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
                    $stmt->bindParam(':adresse', $adresse);
                    $stmt->bindParam(':ville', $ville);
                    $stmt->bindParam(':code_postal', $code_postal);
                    $stmt->bindParam(':pays', $pays);
                    
                    if ($stmt->execute()) {
                        header("Location: users.php"); // Redirect to users.php after successful insertion
                        exit();
                    } else {
                        echo "Erreur lors de la création de l'utilisateur.";
                    }
                }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="mot_de_passe">Mot de passe</label>
                        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville</label>
                        <input type="text" class="form-control" id="ville" name="ville" required>
                    </div>
                    <div class="form-group">
                        <label for="code_postal">Code Postal</label>
                        <input type="text" class="form-control" id="code_postal" name="code_postal" required>
                    </div>
                    <div class="form-group">
                        <label for="pays">Pays</label>
                        <input type="text" class="form-control" id="pays" name="pays" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Créer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("addutilisateursBtn").addEventListener("click", function() {
        $('#showBtnModal').modal('show');
    });
</script>

<?php require_once("partials/footer.php");?>
