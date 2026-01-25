<?php 
include('../layout/header.php');
require_once('bdd.php');
session_start();

$message = "";
$messageType = "";

if (isset($_POST['envoyer'])) {
    // Vérification email
    if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $message = "Veuillez saisir une adresse e-mail valide.";
        $messageType = "warning";
    } else {
        $adresse = trim($_POST['mail']);

        // Vérifier si l'email existe
        $requete = $bddPDO->prepare(
            "SELECT id_utilisateurs, email_utilisateurs, validation_mail 
             FROM utilisateurs 
             WHERE email_utilisateurs = :mail"
        );
        $requete->execute(['mail' => $adresse]);
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        if (!$utilisateur) {
            $message = "Adresse e-mail non trouvée.";
            $messageType = "danger";
        } elseif ($utilisateur['validation_mail'] != 1) {
            $message = "Veuillez valider votre adresse e-mail avant de réinitialiser le mot de passe.";
            $messageType = "info";
            $_SESSION['email_utilisateurs'] = $utilisateur['email_utilisateurs'];
        } else {
            // Génération du token
            $token = bin2hex(random_bytes(32));
            
            // Date d'expiration (1 heure)
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Mise à jour du token ET de l'expiration
            $update = $bddPDO->prepare(
                "UPDATE utilisateurs 
                 SET token_utilisateurs = :token,
                     reset_expires_at = :expires
                 WHERE id_utilisateurs = :id"
            );
            $update->execute([
                'token'   => $token,
                'expires' => $expires,
                'id'      => $utilisateur['id_utilisateurs']
            ]);

            // Envoi du mail
            require_once 'sendmail2.php';

            $message = "Un lien de réinitialisation a été envoyé sur votre adresse e-mail.";
            $messageType = "success";
        }
    }
}
?>
        <title>Réinitialisation du mot de passe - FitSport</title>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <main class="d-flex align-items-center justify-content-center min-vh-100 py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-header bg-danger text-white text-center py-4 rounded-top-4">
                                <h2 class="mb-0 fw-bold">Mot de passe oublié ?</h2>
                                <p class="text-white-50 small mb-0 mt-2">Réinitialise ton accès</p>
                            </div>
                            <div class="card-body p-4">
                                <?php if (!empty($message)) : ?>
                                    <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show rounded-3" role="alert">
                                        <?php if ($messageType === 'success') : ?>
                                            <i class="fas fa-check-circle me-2"></i>
                                        <?php elseif ($messageType === 'danger') : ?>
                                            <i class="fas fa-times-circle me-2"></i>
                                        <?php elseif ($messageType === 'warning') : ?>
                                            <i class="fas fa-exclamation-circle me-2"></i>
                                        <?php else : ?>
                                            <i class="fas fa-info-circle me-2"></i>
                                        <?php endif; ?>
                                        <?php echo htmlspecialchars($message); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <div class="alert alert-info rounded-3 mb-4" role="alert">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Saisis ton adresse email</strong> afin que nous te envoyions un lien de réinitialisation.
                                </div>

                                <form id="forgotForm" method="POST" novalidate>
                                    <div class="mb-4">
                                        <label for="inputEmail" class="form-label fw-500">Adresse email</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-envelope text-danger"></i>
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

                                    <div class="d-grid gap-2 mb-3">
                                        <button type="submit" name="envoyer" class="btn btn-danger btn-lg fw-bold rounded-3">
                                            <i class="fas fa-paper-plane me-2"></i>Envoyer le lien
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-light border-top py-3 rounded-bottom-4">
                                <p class="text-center mb-2">
                                    <a href="login.php" class="btn btn-link btn-sm fw-bold p-0">Retour à la connexion</a>
                                </p>
                                <p class="text-center mb-0">
                                    Pas de compte ? 
                                    <a href="inscription.php" class="btn btn-link btn-sm fw-bold p-0">Inscris-toi !</a>
                                </p>
                            </div>
                        </div>

                        <!-- Info de sécurité -->
                        <div class="alert alert-warning mt-4 rounded-3" role="alert">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-shield-alt me-3 mt-1 text-warning"></i>
                                <div>
                                    <h6 class="alert-heading">Sécurité du lien</h6>
                                    <small>Le lien de réinitialisation expire après 1 heure pour des raisons de sécurité. Si tu ne reçois pas l'email, vérifie tes spams.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script>
            // Validation Bootstrap
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    const forms = document.querySelectorAll('#forgotForm');
                    Array.prototype.slice.call(forms).forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
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

        <div id="layoutAuthentication_footer">
            <?php include('../layout/footer.php'); ?>
