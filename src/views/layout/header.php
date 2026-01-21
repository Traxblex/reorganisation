<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../public/img/logo_fitsport.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&family=Oswald:wght@400;600&display=swap">
    <link rel="stylesheet" href="../assets/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="../../../../public/img/logo_fitsport.png" alt="Logo" width="30" height="24"
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


