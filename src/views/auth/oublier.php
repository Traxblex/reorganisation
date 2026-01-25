<?php include('../layout/header.php'); ?>
        <title>Réinitialisation du mot de passe - FitSport</title>
        <link href="../../assets/oublier.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<?php
require_once('bdd.php');
session_start();

$message = "";

if (isset($_POST['envoyer'])) {

    // Vérification email
    if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $message = "Veuillez saisir une adresse e-mail valide.";
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

        } elseif ($utilisateur['validation_mail'] != 1) {

            $message = "Veuillez valider votre adresse e-mail avant de réinitialiser le mot de passe.";
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

            // Envoi du mail (sendmail qui marche chez toi)
            require_once 'sendmail2.php';

            $message = "Un lien de réinitialisation a été envoyé sur votre adresse e-mail.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - FitSport</title>
        <link href="../../assets/oublier.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Mots de passe oublier ?</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            
                                            </div>
                                            <p>saisisser votre adresse email afin  que nous vous envoyons un mails de verrification </p>
                                             <?php if (!empty($message)) : ?>
                                             <p><?= htmlspecialchars($message) ?></p>
                                             <?php endif; ?>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="mail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">adresse email</label>
                                            </div>
                                            
                                            <div class="mt-4 mb-0">
                                                <input name="envoyer" type="submit" ></input>
                                     
                                                <div class="small"><a href="index.php">pas de compte ? inscrit toi !</a></div>
                                                <div class="small"><a href="login.php">tu as deja un compte? connecte toi !</a></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <?php include('../layout/footer.php'); ?>
