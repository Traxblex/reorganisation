<?php include '../layout/header.php'; ?>
<title>Fitsport - Abonnement ULTIMATE</title>

<body>
    <div class="container mt-5 pt-5">
        <h1 class="mb-4" style="font-family: 'Anton', sans-serif; font-size: 3rem; color: #DC3545;">ABONNEMENT ULTIMATE</h1>

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
                        <form method="POST" action="../../controllers/AbonnementController.php">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" required>
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