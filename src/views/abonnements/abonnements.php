<?php include '../layout/header.php'; ?>
 <title>Fitsport -Abonnements</title>

<body>
   <div class="container mt-5 pt-5">
    <h1 class="mb-4" style="font-family: 'Anton', sans-serif; font-size: 4rem; color: #DC3545;">NOS ABONNEMENTS</h1>

        
    <div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col mb-5">
    <div class="card h-100">
      <img src="../../assets/img/fitness.png" class="card-img-top" alt="image boxeur">
      <div class="card-body">
        <h5 class="card-title" style="color: #DC3545">CLASSIC</h5>
        <ul class="list-group list-group-flush">
                            <li class="list-group-item">✓ Accès à la salle de sport</li>
                            <li class="list-group-item">✓ Horaires standards</li>
                            <li class="list-group-item">✓ Support client basique</li>
                        </ul>
                        <p class="mt-3"><strong>Prix : 29,99€/mois</strong></p>
       <a href="classic.php" class="btn btn-danger">S'abonner</a>
      </div>
    </div>
  </div>
  <div class="col mb-5">
    <div class="card h-100">
      <img src="../../assets/img/boxe.png" class="card-img-top" alt=".">
      <div class="card-body">
        <h5 class="card-title" style="color: #DC3545">ACCÈS +</h5>
        <ul class="list-group list-group-flush">
                            <li class="list-group-item">✓ Accès illimité à la salle de sport</li>
                            <li class="list-group-item">✓ 1 discipline au choix</li>
                            <li class="list-group-item">✓ Support client prioritaire</li>
                        </ul>
                        <p class="mt-3"><strong>Prix : 49,99€/mois</strong></p>
        <a href="accesplus.php" class="btn btn-danger">S'abonner</a>
      </div>
    </div>
  </div>
  <div class="col mb-5">
    <div class="card h-100">
      <img src="../../assets/img/sport.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title" style="color: #DC3545">ULTIMATE</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">✓ Accès illimité à la salle de sport</li>
            <li class="list-group-item">✓ Accès à toutes les disciplines</li>
            <li class="list-group-item">✓ Support client prioritaire</li>
            <li class="list-group-item">✓ Coaching personnalisé</li>
        </ul>
        <p class="mt-3"><strong>Prix : 99,99€/mois</strong></p>
        <a href="ultimate.php" class="btn btn-danger">S'abonner</a>
      </div>
    </div>
  </div>
</div>
<?php include '../layout/footer.php'; ?>