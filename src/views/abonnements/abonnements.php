<?php include('../views/layout/header.php'); ?>
<title>Abonnements</title>
<section class="bg-dark text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-1 fw-bold">NOS ABONNEMENTS<br>SONT </h1>
                <p class="display-4 fw-bold text-danger">Votre club de sport préféré pour rester en forme et en bonne santé.</p>
            </div>
        </div>
    </div>
    <div>
        <img src="../app/img/fitness_image.png" alt="Fitness Image">
    </div>
</section>
<div class="container mt-5">
    <h1 class="mb-4">Nos Abonnements</h1>
    <div class="row">
        <?php if (!empty($abonnements)): ?>
            <?php foreach ($abonnements as $abonnement): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= htmlspecialchars($abonnement['titre'], ENT_QUOTES, 'UTF-8') ?>
                            </h5>
                            <p class="card-text">
                                <?= htmlspecialchars($abonnement['description'], ENT_QUOTES, 'UTF-8') ?>
                            </p>
                            <p class="card-text">
                                <strong>Prix :</strong>
                                <?= htmlspecialchars($abonnement['prix'], ENT_QUOTES, 'UTF-8') ?>
                            </p>
                            <a href="#" class="btn btn-primary"></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun abonnement disponible pour le moment.</p>
        <?php endif; ?>
    </div>
</div>
<?php include('../layout/footer.php'); ?>


