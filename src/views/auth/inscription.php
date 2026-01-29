<?php include('bdd.php'); ?>
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
                                 <?php
if(isset($_POST['envoyer'])){
    $identifiant = $_POST['identifiant'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['mail'];
    $password = $_POST['password'];
    
    if (!empty($nom) && !empty($adresse) && !empty($prenom) && !empty($password) && !empty($identifiant)) {
        // Vérifier si l'email existe déjà
        $req = $bddPDO->prepare('SELECT * FROM utilisateurs WHERE email_utilisateurs = :adresse');
        $req->bindValue(":adresse", $_POST['mail']);
        $req->execute();
        $result = $req->fetch();
        
        // Vérifier si l'identifiant existe déjà (corrigé)
        $req1 = $bddPDO->prepare('SELECT * FROM utilisateurs WHERE identifiant = :identifiant');
        $req1->bindValue(":identifiant", $_POST['identifiant']);
        $req1->execute();
        $result1 = $req1->fetch();
        
        if ($result) {
            $message = "Cette adresse email existe déjà";
        } elseif ($result1) {
            $message = "Cet identifiant existe déjà";
        } else {
            require_once('token.php');
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // INSERT correct maintenant
            $requete = $bddPDO->prepare('INSERT INTO utilisateurs (identifiant, nom_utilisateurs, prenom_utilisateurs, email_utilisateurs, password_utilisateurs, token_utilisateurs) VALUES(:identifiant, :nom, :prenom, :adresse, :password, :token)');
            $requete->bindValue(':identifiant', $identifiant);
            $requete->bindValue(':nom', $nom);
            $requete->bindValue(':prenom', $prenom);
            $requete->bindValue(':adresse', $adresse);
            $requete->bindValue(':password', $password);
            $requete->bindValue(':token', $token);
            
            $result = $requete->execute();
            $emailDestinataire = $adresse;
            
            require_once('sendmail.php');
        }
    }
}
?>

                                <p class="text-white-50 small mb-0 mt-2">Rejoins la communauté FitSport
                                    <?php if (isset($message)) { echo '<div class="alert alert-warning mt-2" role="alert">' . htmlspecialchars($message) . '</div>'; } ?>
                                </p>
                            </div>
                            <div class="card-body p-4">
                                <form id="inscriptionForm" method="post" novalidate>
                                    <div class="mb-3">
                                    <label for="inputIdentifiant" class="form-label fw-500">Identifiant</label>
                                    <input 
                                                 type="text" 
                                                 class="form-control form-control-lg" 
                                                 id="inputIdentifiant" 
                                                 name="identifiant"
                                                 placeholder="Votre identifiant unique" 
                                                 required 
    />
</div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputFirstName" class="form-label fw-500">Prénom</label>
                                            <input 
                                                type="text" 
                                                class="form-control form-control-lg" 
                                                id="inputFirstName" 
                                                name="prenom"
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
                                                name="nom"
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
                                            name="mail"
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
                                        <button type="submit" name="envoyer" value="envoyer" class="btn btn-danger btn-lg fw-bold rounded-3">
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
            const form = document.getElementById('inscriptionForm');
            
            form.addEventListener('submit', function(event) {
                const password = document.getElementById('inputPassword').value;
                const passwordConfirm = document.getElementById('inputPasswordConfirm').value;
                
                // Vérifier si les mots de passe correspondent
                if (password !== passwordConfirm) {
                    document.getElementById('inputPasswordConfirm').setCustomValidity('Les mots de passe ne correspondent pas');
                } else {
                    document.getElementById('inputPasswordConfirm').setCustomValidity('');
                }
                
                // Vérifier la validité du formulaire
                if (form.checkValidity() === false) {
                    event.preventDefault(); // ✅ Bloque SEULEMENT si invalide
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





