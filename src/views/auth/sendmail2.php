<?php require_once('oublier.php'); ?>


<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true);
$mail-> isSMTP();
$mail-> Host ='smtp.gmail.com';
$mail-> SMTPAuth = true;
$mail-> Username = 'kaba.ismael911@gmail.com';
$mail-> Password = 'jddjrisglrfgcscc';
$mail-> SMTPSecure = 'tls';
$mail-> Port = 587;
$mail->CharSet = "utf-8";

$mail->setFrom('kaba.ismael911@gmail.com', 'ismael');
$mail->addAddress($adresse);
$mail->isHTML(true);
$mail->Subject = 'confirmation de reinitialisation de mot de passe';
$mail->Body = 'Bonjour, afin de pouvoir  reinitialiser votre mot de passe, veuillez cliquer sur le lien suivant : 
<a href="http://localhost/projet_sport-main/modifier.php?token='.$token.'&mail='.$adresse.'">Confirmration  modification de votre mots de passe </a>';

$mail->SMTPDebug = 0;
if(!$mail->send()){
	$message = "Mail non envoyé";
	echo "Erreur .$mail->ErrorInfo";
}else{
	$message = "Un mail vous a ete envoyé!";

}


?>