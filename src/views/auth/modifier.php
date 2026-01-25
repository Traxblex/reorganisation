<?php include('../layout/header.php'); ?>
        <title>Modifier mot de passe - FitSport</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <?php
   require_once('bdd.php');
   $email = $_POST['mail'] ?? $_GET['mail'] ?? null;
$token = $_POST['token'] ?? $_GET['token'] ?? null;

if (!$email || !$token) {
    die("Lien invalide");
}

// Vérifier token directement dans utilisateurs (sans password_resets)
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
$success = false;

// Traitement formulaire
if (isset($_POST['password'])) {
    if ($_POST['password'] === $_POST['confirm']) {
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Update password ET vider le token pour éviter réutilisation
        $bddPDO->prepare(
            "UPDATE utilisateurs 
             SET password_utilisateurs = ?, 
                 token_utilisateurs = '', 
                 reset_expires_at = NULL 
             WHERE id_utilisateurs = ?"
        )->execute([$hash, $user['id_utilisateurs']]);

        $message = 'Mot de passe modifié avec succès.';
        $success = true;
    } else {
        $message = 'Les mots de passe ne correspondent pas.';
    }
}
?>

  
   
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3> 
                                     <?php if ($message) { echo $message; } ?> modifier votre mots de passe</h3></div>
                                    <div class="card-body">
                                        <form method="post">
      <input type="hidden" name="mail" value="<?= htmlspecialchars($email) ?>">
      <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="field">
                                                     <label>confirmation du mots de passe</label>
                                                       <?php if ($success) { ?>
      <p><a href="login.php">Se connecter</a></p>
    <?php } else { ?>
                                                 <input type="password" name="confirm"  placeholder="Confirmation">
                                                    </div>
                                                </div>
                                                    
                                                </div>
                                            </div>
                                           
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="password" name="password"placeholder="Nouveau mot de passe"> 
                                                        <label for="inputPassword">mots de passe</label>
                                                    </div>
                                                </div>
        
                                            </div>
                                            <div class="mt-4 mb-0">
                                                 <input type="submit" value="Modifier">
                                            </div>
                                        </form>
                                        <?php } ?>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                       
                                        <div class="small"><a href="login.php">tu as deja un compte connecte toi !</a></div>
                                        <div class="small"><a href="oublier.php">mots de passe oublier ?</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
            <?php include('../layout/footer.php'); ?>




