<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="public/img/logo_fitsport.png" type="image/x-icon">
    <title>Fitsport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&family=Oswald:wght@400;600&display=swap">
    <link rel="stylesheet" href="src/assets/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="src/assets/img/logo_fitsport.png" alt="Logo" width="30" height="24"
                 class="d-inline-block align-text-top"> FITSPORT
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100"> <!-- Utilisation de w-100 pour étendre la barre de navigation sur toute la largeur -->
                <li class="nav-item">
                    <a class="nav-link" href="src/views/abonnements/abonnements.php">ABONNEMENTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="src/views/activites/index.php">ACTIVITÉS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="src/views/contact.php">CONTACT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="src/views/apropos.php">À PROPOS</a>
                </li>
                 <li class="nav-item ms-auto"> <!-- Utilisation de ms-auto pour pousser l'élément vers la droite -->
                    <a class="nav-link" href="#">LISTE D'INSCRITS</a>
                </li>
                <li class="nav-item "> 
                    <a class="nav-link" href="src/views/auth/login.php"><i class="bi bi-person-circle "> CONNEXION</i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<section class="container-fluid" style="background-image: url('src/assets/img/fitness_image.png'); background-size: cover; background-position: center; height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 0;">
    <div style="z-index: 10;">
        <h1 style="color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.7); font-family: 'Anton', sans-serif; font-size: 7rem;">
            Bienvenue chez Fitsport
        </h1>
        <p style="font-family: 'Oswald', sans-serif; font-size: 3rem;" class="text-danger">
            Votre club de sport préféré pour rester en forme et en bonne santé.
        </p>
        <a href="src/views/abonnements/abonnements.php" class="btn btn-danger btn-lg">Voir les abonnements</a>

        <div class="row g-4" style="margin-top: 100px;">
            <div class="col-md-4">
                <div class="promo-card" style="background-image: url('src/assets/img/musculation.png');">
                    <div class="promo-content">
                        <p class="promo-title">4 SEMAINES + FRAIS D'ADHÉSION</p>
                        <p class="promo-highlight" style="color: #DC3545;">OFFERTS</p>
                        <p class="promo-date">DU 29 DÉCEMBRE AU 18 JANVIER</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="promo-card" style="background-image: url('src/assets/img/sport.png');">
                        <a href="src/views/abonnements/abonnements.php" class="text-decoration-none">
                        <div class="promo-content">
                            <p class="promo-title" style="color: #ffffffff;">-30% SUR LES ABONNEMENTS</p>
                            <p class="promo-highlight" style="color: #DC3545;">ANNUELS</p>
                            <p class="promo-date" style="color: #ffffffff;">JANVIER & FÉVRIER</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="promo-card" style="background-image: url('src/assets/img/coach.png');">
                    <div class="promo-content">
                        <p class="promo-title">PREMIÈRE SÉANCE</p>
                        <p class="promo-highlight" style="color: #DC3545;">GRATUITE</p>
                        <p class="promo-date">POUR LES NOUVEAUX MEMBRES</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background-color: #acb6c0b0;">
    <div class="container-fluid px-3">
        <h2 class="text-center mb-3" style="font-family: 'Anton', sans-serif; font-size: 4rem;">nos Disciplines</h2>
        <p class="text-center mb-4" style="sans-serif; font-size: 1.5rem;">
            Musculation, Yoga, Boxe, Lutte. viens découvrir nos disciplines et profite de nos offres spéciales !
        </p>
        <div class="promo-scroll-container">
            <div class="promo-card-wrapper">
                <div class="promo-card" style="background-image: url('src/assets/img/musculation.png');">
                    <div class="promo-content">
                        <p class="promo-title">accès illimité</p>
                        <p class="promo-highlight" style="color: #DC3545;">MUSCULATION</p>
                        <p class="promo-date">
                            Développe ta force grâce aux dernières machines Technogym et Hammer Strength.
                            Des équipements haut de gamme pour tes entraînements
                        </p>
                    </div>
                </div>
            </div>
            <div class="promo-card-wrapper">
                <div class="promo-card" style="background-image: url('src/assets/img/yoga.png');">
                    <div class="promo-content">
                        <p class="promo-title">accès illimité</p>
                        <p class="promo-highlight" style="color: #DC3545;">YOGA</p>
                        <p class="promo-date">
                            Développe ta flexibilité et ton esprit grâce à nos cours de yoga.
                            Des séances relaxantes pour améliorer ta posture et ton bien-être.
                        </p>
                    </div>
                </div>
            </div>
            <div class="promo-card-wrapper">
                <div class="promo-card" style="background-image: url('src/assets/img/boxe.png');">
                    <div class="promo-content">
                        <p class="promo-title">Lundi , Mardi & Vendredi</p>
                        <p class="promo-highlight" style="color: #DC3545;">BOXE</p>
                        <p class="promo-date">
                            Développe ton esprit et ta force grâce à nos cours de boxe.
                            Des entraînements intensifs pour améliorer ta condition physique et ta technique.
                        </p>
                    </div>
                </div>
            </div>
            <div class="promo-card-wrapper">
                <div class="promo-card" style="background-image: url('src/assets/img/lute.png');">
                    <div class="promo-content">
                        <p class="promo-title">Mercredi, Jeudi & Samedi</p>
                        <p class="promo-highlight" style="color: #DC3545;">LUTE</p>
                        <p class="promo-date">
                            Développe ta technique et ta force grâce à nos cours de lutte.
                            Des séances dynamiques pour améliorer ton agilité et ta condition physique.
                        </p>
                    </div>
                </div>
            </div>
            <div class="promo-card-wrapper">
                <div class="promo-card" style="background-image: url('src/assets/img/mma.png');">
                    <div class="promo-content">
                        <p class="promo-title">Lundi, Mardi & Vendredi</p>
                        <p class="promo-highlight" style="color: #DC3545;">MMA</p>
                        <p class="promo-date">
                            Développe ta technique et ta force grâce à nos cours de MMA.
                            Des entraînements intensifs pour améliorer ta condition physique et ta technique.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        <footer class="bg-dark text-white py-5 mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 mb-4"> 
                <a class="navbar-brand" href="../../../index.php">
            <h5 class="mb-3" style="font-family: 'Anton', sans-serif; color: #DC3545;"><img src="src/assets/img/logo_fitsport.png" alt="Logo" width="30" height="24"
                 class="d-inline-block align-text-top"> FITSPORT</h5>

        </a>
                    <p>Votre club de sport préféré pour rester en bonne santé.</p>
                    <div>
                        <a href="#" class="text-white me-3"><i class="bi bi-github"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3" style="font-family: 'Oswald', sans-serif;">LIENS RAPIDES</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white text-decoration-none">Accueil</a></li>
                        <li><a href="src/views/abonnements/abonnements.php" class="text-white text-decoration-none">Abonnements</a></li>
                        <li><a href="src/views/activites/index.php" class="text-white text-decoration-none">Activités</a></li>
                        <li><a href="src/views/contact.php" class="text-white text-decoration-none">Contact</a></li>
                        <li><a href="src/views/apropos.php" class="text-white text-decoration-none">À propos</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3" style="font-family: 'Oswald', sans-serif;">NOUS CONTACTER</h5>
                    <p><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
                    <p><i class="fas fa-envelope"></i> info@fitsport.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Rue du Sport, 75000 Paris</p>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 FITSPORT. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3">Politique de confidentialité</a>
                    <a href="#" class="text-white text-decoration-none">Conditions d'utilisation</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>


