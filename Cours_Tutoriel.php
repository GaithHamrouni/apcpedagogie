<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours et Tutoriel</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> 
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20">
                <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" fill="#8e9215"></path>
            </svg>
            <span style="color: #8e9215;">apc</span><span style="color:white;">pedagogie</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Cours_Tutoriel.php">Cours et Tutoriel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Nos_resoures.php">Nos resoures</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Contact.php">Contact</a>
                </li>
                   <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pages
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <a class="dropdown-item" href="Utilisateur.php"><i class="fas fa-user"></i> Utilisateur</a>
                        <a class="dropdown-item" href="Cours.php"><i class="fas fa-book"></i> Cours</a>
                        <a class="dropdown-item" href="Video.php"><i class="fas fa-video"></i> Vidéo</a>
                        <a class="dropdown-item" href="Achat.php"><i class="fas fa-shopping-cart"></i> Achat</a>
                        <a class="dropdown-item" href="Note.php"><i class="fas fa-sticky-note"></i> Note</a>
                        </div>
                    </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Connexion
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php">Deconnexion</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <div class="row">
        <div class="col mx-auto">
            <h1 class="text-center mb-4">Cours et Tutoriel</h1>
            <div class="card-deck">
                <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-code fa-5x mb-3"></i>
                    <h5 class="card-title">Introduction to Programming</h5>
                    <p class="card-text">Apprenez les bases de la programmation avec ce cours complet couvrant les concepts de programmation, la syntaxe et les techniques de résolution de problèmes.</p>
                    <a href="#" class="btn btn-info" onclick="toggleInfo('additional-info')">Learn More</a>
                    <div id="additional-info" style="display: none;">
                        <ul>
                            <li>Programming concepts</li>
                            <li>Syntax</li>
                            <li>Problem-solving techniques</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-laptop-code fa-5x mb-3"></i>
                        <h5 class="card-title">Web Development Fundamentals</h5>
                        <p class="card-text">Maîtrisez les bases du développement Web, notamment HTML, CSS et JavaScript, pour créer des sites Web interactifs et réactifs.</p>
                        <a href="#" class="btn btn-info" onclick="toggleInfo('web-dev-info')">Learn More</a>
                        <div id="web-dev-info" style="display: none;">
                                <ul>
                                <li>HTML</li>
                                <li>CSS</li>
                                <li>JavaScript</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-database fa-5x mb-3"></i>
                    <h5 class="card-title">Data Science with Python</h5>
                    <p class="card-text">Explorez le monde de la science des données et de l'apprentissage automatique à l'aide de Python, le langage de programmation le plus populaire pour l'analyse de données.</p>
                    <a href="#" class="btn btn-info" onclick="toggleInfo('data-science-info')">Learn More</a>
                    <div id="data-science-info" style="display: none;">
                <ul>
                <li>Data Science fundamentals</li>
                <li>Machine Learning with Python</li>
                <li>Data analysis and visualization</li>
            </ul>
        </div>
    </div>
</div>
            </div>          
        </div>
    </div>
</div>
 
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h3 class="text-center mb-0">Boostez Vos Compétences</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Découvrez une variété de cours et tutoriels pour enrichir vos compétences professionnelles.</li>
                        <li class="list-group-item">Explorez nos ressources éducatives sur la technologie, la créativité, et bien plus encore.</li>
                        <li class="list-group-item">Entamez votre parcours vers l'excellence grâce à nos cours interactifs et tutoriels pratiques.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h3 class="text-center mb-0">Cours et Guides</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Accédez à une vaste bibliothèque de tutoriels couvrant la programmation.</li>
                        <li class="list-group-item">Intégrez une communauté dynamique d'apprenants et d'instructeurs passionnés.</li>
                        <li class="list-group-item">Explorez nos sessions de formation en direct pour un apprentissage interactif.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h2 class="text-center mb-0">Nos Offres de Cours et Tutoriels</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fas fa-check-circle mr-3 text-success"></i>
                            Découvrez nos cours et tutoriels exclusifs.
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-check-circle mr-3 text-success"></i>
                            Ressources variées pour acquérir de nouvelles compétences.
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-check-circle mr-3 text-success"></i>
                            Apprenez les bases ou approfondissez avec nos experts.
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-check-circle mr-3 text-success"></i>
                            Parcourez notre catalogue pour des cours interactifs et plus.
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-check-circle mr-3 text-success"></i>
                            Offres de qualité pour votre réussite.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="text-light py-4" style="background-color: #d9edf6;">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-md-12 text-center">
          <ul class="list-inline">
            <a href="https://www.facebook.com/"><img src="images/facebook.png" alt="Facebook" style="width: 25px;height: 25px;"></a>
            <a href="https://www.gmail.com/"><img src="images/gmail.png" alt="Email" style="width: 25px;height: 25px;"></a>
            <a href="https://www.Twitter.com/"><img src="images/Twitter.png" alt="Twitter" style="width: 25px;height: 25px;"></a>
            <a href="https://www.youtube.com/"><img src="images/youtube.png" alt="YouTube" style="width: 25px;height: 25px;"></a>
          </ul>
        </div>
      </div>
      <div class="row justify-content-center align-items-center">
        <div class="col-md-12 text-center">
          <p style="color: #86b4d5;">Copyright © 2016 apcpedagogie</p>
        </div>
      </div>
    </div>
  </footer>
  <script>
    function toggleInfo(infoId) {
        var info = document.getElementById(infoId);
        if (info.style.display === "none") {
            info.style.display = "block";
        } else {
            info.style.display = "none";
        }
    }

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
