<?php
session_start();
include('../layout/header.php');
require_once('../auth/bdd.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    header("Location: ../auth/login.php");
    exit();
}    

// Récupérer les statistiques depuis la base de données
try {
    $inscrits_count = $bddPDO->query("SELECT COUNT(*) as count FROM utilisateurs WHERE validation_mail = 1")->fetch(PDO::FETCH_ASSOC)['count'];
    $abonnements_count = $bddPDO->query("SELECT COUNT(*) as count FROM abonnements")->fetch(PDO::FETCH_ASSOC)['count'];
    $activites_count = $bddPDO->query("SELECT COUNT(*) as count FROM activites")->fetch(PDO::FETCH_ASSOC)['count'];
} catch (PDOException $e) {
    $inscrits_count = 0;
    $abonnements_count = 0;
    $activites_count = 0;
}

?>
        <title>Statistiques - FitSport</title>
    </head>
    <body class="bg-light">
        <main class="py-5">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h1 class="fw-bold mb-2">
                            <i class="fas fa-chart-bar text-primary me-2"></i>Statistiques
                        </h1>
                        <p class="text-muted">Aperçu global de FitSport</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="../../../index.php" class="btn btn-secondary">
                            <i class="bi bi-box-arrow-left me-2"></i>Retour
                        </a>
                    </div>
                </div>

                <!-- Cartes statistiques principales -->
                <div class="row g-4 mb-5">
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden"> <!-- overflow-hidden pour éviter que l'icône dépasse -->
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="card-title fw-bold mb-0">Utilisateurs actifs</h6>
                                    <i class="fas fa-users fa-2x text-primary opacity-50"></i>
                                </div>
                                <h3 class="fw-bold mb-0"><?php echo $inscrits_count; ?></h3>
                                <small class="text-muted">Inscrits validés</small>
                                <div class="progress mt-3" style="height: 4px;">
                                    <div class="progress-bar bg-primary" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="card-title fw-bold mb-0">Abonnements actifs</h6>
                                    <i class="fas fa-credit-card fa-2x text-success opacity-50"></i>
                                </div>
                                <h3 class="fw-bold mb-0"><?php echo $abonnements_count; ?></h3>
                                <small class="text-muted">Abonnements</small>
                                <div class="progress mt-3" style="height: 4px;">
                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="card-title fw-bold mb-0">Activités disponibles</h6>
                                    <i class="fas fa-dumbbell fa-2x text-warning opacity-50"></i>
                                </div>
                                <h3 class="fw-bold mb-0"><?php echo $activites_count; ?></h3>
                                <small class="text-muted">Activités</small>
                                <div class="progress mt-3" style="height: 4px;">
                                    <div class="progress-bar bg-warning" style="width: 85%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Graphiques et détails -->
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card border-0 rounded-4 shadow-sm">
                            <div class="card-header bg-primary text-white p-4 rounded-top-4">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-chart-pie me-2"></i>Répartition des inscrits
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge bg-success me-2" style="width: 12px; height: 12px; border-radius: 50%;"></span>
                                    <span>Utilisateurs validés</span>
                                    <span class="ms-auto fw-bold"><?php echo $inscrits_count; ?></span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-warning me-2" style="width: 12px; height: 12px; border-radius: 50%;"></span>
                                    <span>En attente de validation</span>
                                    <span class="ms-auto fw-bold">
                                        <?php 
                                        try {
                                            $pending = $bddPDO->query("SELECT COUNT(*) as count FROM utilisateurs WHERE validation_mail = 0")->fetch(PDO::FETCH_ASSOC)['count'];
                                            echo $pending; // Afficher le nombre d'utilisateurs en attente de validation. fetch veut dire "récupérer"
                                        } catch (Exception $e) {
                                            echo "0";
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card border-0 rounded-4 shadow-sm">
                            <div class="card-header bg-success text-white p-4 rounded-top-4">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-info-circle me-2"></i>Informations
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="mb-3">
                                    <strong>Platform FitSport</strong><br>
                                    <small class="text-muted">Gestion complète de votre club fitness</small>
                                </p>
                                <p class="mb-0">
                                    <strong>Dernière mise à jour :</strong><br>
                                    <small class="text-muted"><?php echo date('d/m/Y H:i'); ?></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div id="layoutAuthentication_footer">
            <?php include('../layout/footer.php'); ?>
