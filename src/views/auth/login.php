<?php 
include('../layout/header.php');
require_once ('bdd.php');

$isLogged = isset($_SESSION['identifiant']) && !empty($_SESSION['identifiant']);
 if (isset($_POST['envoyer'])){
    $adresse = $_POST['mail'];
    $password = $_POST['password'];

    $requete = $bddPDO->prepare('SELECT * FROM sport.utilisateurs WHERE email_utilisateurs =:email');
    $requete->execute(array('email'=>$adresse));
    $result = $requete->fetch();

    if (!$result) {
          $message = "veuillez saisir une adresse email valide";}
    elseif ($result['validation_mail'] == 0) {
      require_once "token.php";
      $update = $bddPDO->prepare('UPDATE sport.utilisateurs SET token_utilisateurs =:token WHERE email_utilisateurs =:adresse');
      $update->bindValue(':adresse',$_POST['mail']);
      $update->bindValue(':token',$token);
      $update->execute();
      require_once "sendmail.php";
    }else{
      $passwordISOK = password_verify($_POST['password'], $result['password_utilisateurs']);
      if ($passwordISOK) {
        session_start();
        $_SESSION['prenom_utlisateurs'] = $result['prenom_utlisateurs'];
        $_SESSION['identifiant'] = $result['id_utilisateurs'];
        $_SESSION['email_utilisateurs'] = $adresse;
        header('location:../../../index.php');
    } else{
      $message = "veuillez saisir un mots de passe valide!";
    
    }
    }                           
  }

?>
        <title>Connexion - FitSport</title>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light"> <!-- c'est ici que je veux commencer le main bg light est pour le fond gris clair -->
        <main class="d-flex align-items-center justify-content-center min-vh-100 py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-header bg-danger text-white text-center py-4 rounded-top-4">
                                <h2 class="mb-0 fw-bold">Se connecter</h2>
                                <p class="text-white-50 small mb-0 mt-2">Bienvenue sur FitSport</p>
                            </div>
                            <div class="card-body p-4">
                                <?php if (!empty($message)) : ?>
                                    <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show rounded-3" role="alert">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <?php echo htmlspecialchars($message); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                                 <?php if ($isLogged): ?>
                                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Vous êtes déjà connecté.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php else: ?>

                                <form id="loginForm" method="POST" novalidate>
                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label fw-500">Adresse email</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-envelope text-"></i>
                                            </span>
                                            <input 
                                                type="email" 
                                                class="form-control form-control-lg border-start-0" 
                                                id="inputEmail" 
                                                name="mail"
                                                placeholder="vous@example.com" 
                                                required 
                                            />
                                            <div class="invalid-feedback">
                                                Veuillez entrer une adresse email valide.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="inputPassword" class="form-label fw-500">Mot de passe</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-lock text-danger"></i>
                                            </span>
                                            <input 
                                                type="password" 
                                                class="form-control form-control-lg border-start-0" 
                                                id="inputPassword" 
                                                name="password"
                                                placeholder="Votre mot de passe" 
                                                required 
                                            />
                                            <div class="invalid-feedback">
                                                Veuillez entrer votre mot de passe.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                id="rememberMe" 
                                                name="rememberMe"
                                            />
                                            <label class="form-check-label" for="rememberMe">
                                                Se souvenir de moi
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 mb-3">
                                        <button type="submit" name="envoyer" class="btn btn-danger btn-lg fw-bold rounded-3">
                                            <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-light border-top py-3 rounded-bottom-4">
                                <p class="text-center mb-2">
                                    Pas de compte ? 
                                    <a href="inscription.php" class="btn btn-link btn-sm fw-bold p-0 text-decoration-none text-danger">Inscris-toi !</a>
                                </p>
                                <p class="text-center mb-0">
                                    <a href="oublier.php" class="btn btn-link btn-sm fw-bold p-0 text-danger text-decoration-none">Mot de passe oublié ?</a>
                                </p>
                            </div>
                        </div>
                </div>
            </div>
        </main>

       <script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            const form = document.getElementById('loginForm');
            
            form.addEventListener('submit', function(event) {
                // Si le formulaire est INVALIDE, on bloque l'envoi
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();
</script>

        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .min-vh-100 {
                min-height: 100vh;
            }
            .form-control-lg {
                padding: 0.75rem 1rem;
                font-size: 1rem;
                border-radius: 0.5rem;
            }
            .form-control-lg:focus {
                border-color: #0d6efd;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            }
            .input-group-text {
                border-color: #dee2e6;
            }
            .btn-lg {
                padding: 0.75rem 1.5rem;
            }
            .card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
            }
        </style>
        <?php endif; ?>
       

        <div id="layoutAuthentication_footer">
          
            <?php include('../layout/footer.php'); ?>
