<?php
require_once('bdd.php');



if (isset($_GET['mail']) && !empty($_GET['mail']) && isset($_GET['token']) && !empty($_GET['token'])) {

	$email = $_GET['mail'];
	$token = $_GET['token'];

	$requete = $bddPDO->prepare('SELECT * FROM sport.utilisateurs WHERE email_utilisateurs =:adresse AND token_utilisateurs =:token');

	$requete->bindValue(':adresse', $email);
	$requete->bindValue(':token', $token);

	$requete->execute();
	$nombre = $requete->rowCount();

	if ($nombre == 1){
			$update = $bddPDO->prepare('UPDATE sport.utilisateurs SET validation_mail =:validation , token_utilisateurs =:token WHERE email_utilisateurs =:adresse');
			$update->bindValue(':adresse',$email);
			$update->bindValue(':token',"email valide");
			$update->bindValue(':validation',1);
			$resultUpadate = $update->execute();

			if ($resultUpadate){
				echo"<script type=\"text/javascript\"> alert('votre adresse email est confirmé!');
				document.location.href='login.php';
				</script>";
			}else{
            echo"sa ne marche pas";
        }

	}
}



?>