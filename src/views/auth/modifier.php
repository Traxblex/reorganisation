<?php 
include('../layout/header.php');
require_once('bdd.php');

$email = $_POST['mail'] ?? $_GET['mail'] ?? null;
$token = $_POST['token'] ?? $_GET['token'] ?? null;

if (!$email || !$token) {
    die("Lien invalide");
}

// Vérifier token directement dans utilisateurs
$stmt = $bddPDO->prepare(
    "SELECT id_utilisateurs
    FROM utilisateurs
    WHERE email_utilisateurs = ?
    AND token_utilisateurs = ?
    AND reset_expires_at > NOW()
    AND validation_mail = 1"
);

$stmt->execute([$email, $token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Lien invalide ou expiré");
}

$message = '';
$messageType = '';
$success = false;

// Traitement formulaire
if (isset($_POST['password'])) {
    if (empty($_POST['password'])) {
        $message = 'Le mot de passe ne peut pas être vide.';
        $messageType = 'warning';
    } elseif (strlen($_POST['password']) < 8) {
        $message = 'Le mot de passe doit contenir au moins 8 caractères.';
        $messageType = 'warning';
    } elseif ($_POST['password'] !== $_POST['confirm']) {
        $message = 'Les mots de passe ne correspondent pas.';
        $messageType = 'danger';
    } else {
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Update password ET vider le token pour éviter réutilisation
        $bddPDO->prepare(
            "UPDATE utilisateurs 
             SET password_utilisateurs = ?, 
                 token_utilisateurs = '', 
                 reset_expires_at = NULL 
             WHERE id_utilisateurs = ?"
        )->execute([$hash, $user['id_utilisateurs']]);

        $message = 'Mot de passe modifié avec succès !';
        $messageType = 'success';
        $success = true;
    }
}
?>
        <title>Réinitialiser le mot de passe - FitSport</title>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <main class="d-flex align-items-center justify-content-center min-vh-100 py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-header bg-danger text-white text-center py-4 rounded-top-4">
                                <h2 class="mb-0 fw-bold">Réinitialiser le mot de passe</h2>
                                <p class="text-white-50 small mb-0 mt-2">Crée un nouveau mot de passe sécurisé</p>
                            </div>
                            <div class="card-body p-4">
                                <?php if (!empty($message)) : ?>
                                    <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show rounded-3" role="alert">
                                        <?php if ($messageType === 'success') : ?>
                                            <i class="fas fa-check-circle me-2"></i>
                                        <?php elseif ($messageType === 'danger') : ?>
                                            <i class="fas fa-times-circle me-2"></i>
                                        <?php else : ?>
                                            <i class="fas fa-exclamation-circle me-2"></i>
                                        <?php endif; ?>
                                        <?php echo htmlspecialchars($message); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <?php if ($success) : ?>
                                    <div class="text-center">
                                        <div class="mb-4">
                                            <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                                        </div>
                                        <p class="text-muted mb-4">Ton mot de passe a été réinitialisé avec succès. Tu peux maintenant te connecter avec tes nouvelles identifiants.</p>
                                        <a href="login.php" class="btn btn-danger btn-lg rounded-3 fw-bold w-100">
                                            <i class="fas fa-sign-in-alt me-2"></i>Aller à la connexion
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <form id="resetForm" method="POST" novalidate>
                                        <input type="hidden" name="mail" value="<?php echo htmlspecialchars($email); ?>">
                                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                                        <div class="mb-3">
                                            <label for="inputPassword" class="form-label fw-500">Nouveau mot de passe</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-light border-end-0">
                                                    <i class="fas fa-lock text-danger"></i>
                                                </span>
                                                <input 
                                                    type="password" 
                                                    class="form-control form-control-lg border-start-0" 
                                                    id="inputPassword" 
                                                    name="password"
                                                    placeholder="Nouveau mot de passe" 
                                                    required 
                                                />
                                            </div>
                                            <small class="text-muted d-block mt-2">
                                                Minimum 8 caractères, incluez majuscules et chiffres
                                            </small>
                                            <div class="invalid-feedback">
                                                Veuillez entrer un mot de passe.
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="inputPasswordConfirm" class="form-label fw-500">Confirmer le mot de passe</label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-light border-end-0">
                                                    <i class="fas fa-lock text-danger"></i>
                                                </span>
                                                <input 
                                                    type="password" 
                                                    class="form-control form-control-lg border-start-0" 
                                                    id="inputPasswordConfirm" 
                                                    name="confirm"
                                                    placeholder="Confirmez le mot de passe" 
                                                    required 
                                                />
                                            </div>
                                            <div class="invalid-feedback">
                                                Les mots de passe doivent correspondre.
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 mb-3">
                                            <button type="submit" class="btn btn-danger btn-lg fw-bold rounded-3">
                                                <i class="fas fa-redo me-2"></i>Réinitialiser le mot de passe
                                            </button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer bg-light border-top py-3 rounded-bottom-4">
                                <p class="text-center mb-0">
                                    <a href="login.php" class="btn btn-link btn-sm fw-bold p-0">Retour à la connexion</a>
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>

        <script>
            // Validation Bootstrap
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    const forms = document.querySelectorAll('#resetForm');
                    Array.prototype.slice.call(forms).forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            const password = document.getElementById('inputPassword').value;
                            const confirm = document.getElementById('inputPasswordConfirm').value;
                            
                            if (password !== confirm) {
                                document.getElementById('inputPasswordConfirm').classList.add('is-invalid');
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            
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




