<?php include('../layout/header.php'); ?>
        <title>Connexion - FitSport</title>
        <link rel="stylesheet" href="../../assets/login.CSS" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <?php
  require_once ('bdd.php');
    ?>
    <?php
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
        header('location:public/index.php');
    } else{
      $message = "veuillez saisir un mots de passe valide!";
    
    }
    }                           
  } ?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">

                                    <div class="card-header">
                                       <p> <?php if (isset($message)) {
      echo $message;
      }
    ?></p><h3 class="text-center font-weight-light my-4">connecter vous <?php if (isset($message)) { echo "$message";}?> </h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="mail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">adresse email</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Create a password" />
                                                        <label for="inputPassword">mots de passe</label>
                                                    </div>
                                                </div>
                                                <div class="mt-4 mb-0">
                                                    <input name="envoyer" type="submit" ></input>
                        
                                                <div class="card-footer text-center py-3">
                                        <div class="small"><a href="inscription.php">pas de compte ? inscrit toi !</a></div>
                                           <div class="small"><a href="oublier.php">mots de passe oublier ?</a></div>
                                    </div>
                                            </div>
                                                
                                                </div>
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
