
<title>Fitsport - Abonnement ULTIMATE</title>
<?php 
include '../layout/header.php'; 
require_once('../auth/bdd.php');
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adresse'])) {
    $adresse = $_POST['adresse'];
    $abonnement = 'utltimate';
    
    $requete = $bddPDO->prepare('UPDATE utilisateurs SET activité = :abonnement WHERE email_utilisateurs = :email');
    $requete->bindValue(':email', $adresse, PDO::PARAM_STR);
    $requete->bindValue(':abonnement', $abonnement, PDO::PARAM_STR);
    $requete->execute();
    $message = 'Votre abonnement ultimate a été pris en compte. Merci !';
}
?>
<body>
    <div class="container mt-5 pt-5">
        <h1 class="mb-4" style="font-family: 'Anton', sans-serif; font-size: 3rem; color: #DC3545;">ABONNEMENT ULTIMATE <?php if(isset($message)){echo $message; }?></h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <img src="../../assets/img/sport.png" class="card-img-top" alt="Ultimate">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #DC3545">ULTIMATE</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">✓ Accès illimité à la salle de sport</li>
                            <li class="list-group-item">✓ Accès à toutes les disciplines</li>
                            <li class="list-group-item">✓ Support client prioritaire</li>
                            <li class="list-group-item">✓ Coaching personnalisé</li>
                        </ul>
                        <p class="mt-3"><strong>Prix : 99,99€/mois</strong></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Complétez votre inscription</h5>
                        <form method="POST">
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="adresse" required>
                            </div>
                            
                            <input type="hidden" name="abonnement" value="ultimate">
                            <button type="submit" class="btn btn-danger w-100">S'abonner maintenant</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include '../layout/footer.php'; ?>
</body>