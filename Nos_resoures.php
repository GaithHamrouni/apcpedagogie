<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos ressources</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <div class="col-md-8">
            <div class="container custom-container mb-4"> 
                <h1 class="display-3">Nos Ressources</h1> 
                <div class="row">
                    <div class="col-md-3">
                        <i class="fas fa-book fa-5x"></i>
                    </div>
                    <div class="col-md-9"> 
                        <p class="lead">Ressource pour les programmeurs débutants, avec tutoriels et exemples pratiques.</p>
                    </div>
                </div>
            </div>
            <div class="container custom-container mb-4"> 
                <h1 class="display-3">Autre Ressource</h1> 
                <div class="row">
                    <div class="col-md-3">
                        <i class="fas fa-tools fa-5x"></i>
                    </div>
                    <div class="col-md-9">
                        <p class="lead">Guides avancés sur le développement web, la gestion de projet, etc.</p> 
                    </div>
                </div>
            </div>
            <div class="container custom-container mb-4"> 
                <h1 class="display-3"> Mise à jour</h1> 
                <div class="row">
                    <div class="col-md-3">
                        <i class="fas fa-newspaper fa-5x"></i>
                    </div>
                    <div class="col-md-9"> 
                        <p class="lead">Restez à jour avec nos dernières nouvelles et annonces concernant nos produits et services.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4"> 
            <div class="container custom-container mb-4"> 
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold text-danger">Documentation</h5> 
                        <p class="card-text">Documentation complète sur nos services.</p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold text-danger">Communauté</h5>
                        <p class="card-text">Rejoignez notre communauté en ligne pour discuter et partager des connaissances.</p>
                    </div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
