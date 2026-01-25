<?php include('../layout/header.php'); ?>
        <title>Inscription - FitSport</title>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <main class="d-flex align-items-center justify-content-center min-vh-100 py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-header bg-danger text-white text-center py-4 rounded-top-4">
                                <h2 class="mb-0 fw-bold">Créer un compte</h2>
                                <p class="text-white-50 small mb-0 mt-2">Rejoins la communauté FitSport</p>
                            </div>
                            <div class="card-body p-4">
                                <form id="inscriptionForm" method="POST" novalidate>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label fw-500">Prénom</label>
                                            <input 
                                                type="text" 
                                                class="form-control form-control-lg" 
                                                id="inputFirstName" 
                                                name="firstName"
                                                placeholder="Jean" 
                                                required 
                                            />
                                            <div class="invalid-feedback">
                                                Veuillez entrer votre prénom.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputLastName" class="form-label fw-500">Nom</label>
                                            <input 
                                                type="text" 
                                                class="form-control form-control-lg" 
                                                id="inputLastName" 
                                                name="lastName"
                                                placeholder="Dupont" 
                                                required 
                                            />
                                            <div class="invalid-feedback">
                                                Veuillez entrer votre nom.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label fw-500">Adresse email</label>
                                        <input 
                                            type="email" 
                                            class="form-control form-control-lg" 
                                            id="inputEmail" 
                                            name="email"
                                            placeholder="vous@example.com" 
                                            required 
                                        />
                                        <div class="invalid-feedback">
                                            Veuillez entrer une adresse email valide.
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputPassword" class="form-label fw-500">Mot de passe</label>
                                            <input 
                                                type="password" 
                                                class="form-control form-control-lg" 
                                                id="inputPassword" 
                                                name="password"
                                                placeholder="Créez un mot de passe" 
                                                required 
                                            />
                                            <small class="text-muted d-block mt-2">
                                                Minimum 8 caractères, 1 majuscule, 1 chiffre
                                            </small>
                                            <div class="invalid-feedback">
                                                Veuillez entrer un mot de passe.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputPasswordConfirm" class="form-label fw-500">Confirmer le mot de passe</label>
                                            <input 
                                                type="password" 
                                                class="form-control form-control-lg" 
                                                id="inputPasswordConfirm" 
                                                name="passwordConfirm"
                                                placeholder="Confirmez votre mot de passe" 
                                                required 
                                            />
                                            <div class="invalid-feedback">
                                                Les mots de passe ne correspondent pas.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                id="acceptTerms" 
                                                name="acceptTerms"
                                                required 
                                            />
                                            <label class="form-check-label" for="acceptTerms">
                                                J'accepte les <a href="#" class="text-decoration-none text-danger">conditions d'utilisation</a> et la <a href="#" class="text-decoration-none text-danger">politique de confidentialité</a>
                                            </label>
                                            <div class="invalid-feedback">
                                                Vous devez accepter les conditions.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 mb-3">
                                        <button type="submit" class="btn btn-danger btn-lg fw-bold rounded-3">
                                            <i class="fas fa-user-check me-2"></i>Créer un compte
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-light border-top py-3 rounded-bottom-4">
                                <p class="text-center mb-0">
                                    Tu as déjà un compte ? 
                                    <a href="login.php" class="btn btn-link btn-sm fw-bold p-0 text-decoration-none text-danger">Connecte-toi !</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script>
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    const forms = document.querySelectorAll('#inscriptionForm');
                    Array.prototype.slice.call(forms).forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            const password = document.getElementById('inputPassword').value;
                            const passwordConfirm = document.getElementById('inputPasswordConfirm').value;
                            
                            if (password !== passwordConfirm) {
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



