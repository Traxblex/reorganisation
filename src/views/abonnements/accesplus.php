
<title>Fitsport - Abonnement ACCÈS+</title>
<?php 
include '../layout/header.php'; 
require_once('../auth/bdd.php');
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adresse'])) {
    $adresse = $_POST['adresse'];
    $abonnement = 'acces plus';
    
    $requete = $bddPDO->prepare('UPDATE utilisateurs SET activité = :abonnement WHERE email_utilisateurs = :email');
    $requete->bindValue(':email', $adresse, PDO::PARAM_STR);
    $requete->bindValue(':abonnement', $abonnement, PDO::PARAM_STR);
    $requete->execute();
    $message = 'Votre abonnement acces plus a été pris en compte. Merci !';
}
?>
<body>
    <div class="container mt-5 pt-5">
        <h1 class="mb-4" style="font-family: 'Anton', sans-serif; font-size: 3rem; color: #DC3545;">ABONNEMENT ACCÈS+ <?php if(isset($message)){
echo $message;}?>
         </h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <img src="../../assets/img/boxe.png" class="card-img-top" alt="Accès+">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #DC3545">ACCÈS+</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">✓ Accès illimité à la salle de sport</li>
                            <li class="list-group-item">✓ 1 discipline au choix</li>
                            <li class="list-group-item">✓ Support client prioritaire</li>
                        </ul>
                        <p class="mt-3"><strong>Prix : 49,99€/mois</strong></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Complétez votre inscription</h5>
                        <form method="POST" >
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="adresse" required>
                            </div>
                            <div class="mb-3">
                               
                            </div>
                            <input type="hidden" name="abonnement" value="accesplus">
                            <button type="submit" class="btn btn-danger w-100">S'abonner maintenant</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include '../layout/footer.php'; ?>
</body>