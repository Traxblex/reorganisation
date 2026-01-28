<?php
session_start();
include('../layout/header.php');
require_once('../auth/bdd.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    header("Location: ../auth/login.php");
    exit();
}
// Récupérer la liste des inscrits depuis la table utilisateurs
$sql = "SELECT 
    id_utilisateurs,
    prenom_utlisateurs,
    nom_utilisateurs,
    email_utilisateurs,
    date_inscription_utilisateurs
FROM utilisateurs
ORDER BY date_inscription_utilisateurs DESC";

try {
    $stmt = $bddPDO->query($sql);
    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $utilisateurs = [];
    $error = "Erreur lors du chargement des données.";
}

$totalInscrits = count($utilisateurs);
?>
        <title>Liste des inscrits - FitSport</title>
    </head>
    <body class="bg-light">
        <main class="py-5">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h1 class="fw-bold mb-2">
                            <i class="fas fa-users text-primary me-2"></i>Liste des inscrits
                        </h1>
                        <p class="text-muted">
                            <span class="badge bg-primary rounded-pill"><?php echo $totalInscrits; ?></span>
                            utilisateur(s) enregistré(s)
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="../../../index.php" class="btn btn-secondary">
                            <i class="bi bi-box-arrow-left me-2"></i>Retour
                        </a>
                    </div>
                </div>

                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?php echo htmlspecialchars($error); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($totalInscrits > 0) : ?>
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="fw-bold">
                                            <i class="fas fa-hashtag me-2"></i>ID
                                        </th>
                                        <th class="fw-bold">
                                            <i class="fas fa-user me-2"></i>Prénom
                                        </th>
                                        <th class="fw-bold">
                                            <i class="fas fa-user me-2"></i>Nom
                                        </th>
                                        <th class="fw-bold">
                                            <i class="fas fa-envelope me-2"></i>Email
                                        </th>
                                        <th class="fw-bold">
                                            <i class="fas fa-calendar me-2"></i>Date d'inscription
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($utilisateurs as $index => $utilisateur): ?>
                                        <tr>
                                            <td class="align-middle">
                                                <span class="badge bg-secondary"><?php echo htmlspecialchars($utilisateur['id_utilisateurs']); ?></span>
                                            </td>
                                            <td class="align-middle fw-500">
                                                <?php echo htmlspecialchars($utilisateur['prenom_utlisateurs'] ?? 'N/A'); ?>
                                            </td>
                                            <td class="align-middle">
                                                <?php echo htmlspecialchars($utilisateur['nom_utilisateurs'] ?? 'N/A'); ?>
                                            </td>
                                            <td class="align-middle">
                                                <a href="mailto:<?php echo htmlspecialchars($utilisateur['email_utilisateurs']); ?>">
                                                    <?php echo htmlspecialchars($utilisateur['email_utilisateurs']); ?>
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <?php 
                                                    $date = new DateTime($utilisateur['date_inscription_utilisateurs']);
                                                    echo $date->format('d/m/Y H:i');
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <div class="row mt-5">
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 rounded-4 bg-primary text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-2x mb-3"></i>
                                    <h5 class="card-title">Total inscrits</h5>
                                    <p class="card-text fw-bold" style="font-size: 2rem;"><?php echo $totalInscrits; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 rounded-4 bg-success text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-check fa-2x mb-3"></i>
                                    <h5 class="card-title">Inscrits actifs</h5>
                                    <p class="card-text fw-bold" style="font-size: 2rem;">
                                        <?php 
                                        $activeCount = 0;
                                        foreach ($utilisateurs as $u) {
                                            if (isset($u['validation_mail']) && $u['validation_mail'] == 1) {
                                                $activeCount++;
                                            }
                                        }
                                        echo $activeCount;
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 rounded-4 bg-warning text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-hourglass-half fa-2x mb-3"></i>
                                    <h5 class="card-title">En attente</h5>
                                    <p class="card-text fw-bold" style="font-size: 2rem;">
                                        <?php 
                                        $pendingCount = $totalInscrits - $activeCount;
                                        echo $pendingCount;
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 rounded-4 bg-info text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-alt fa-2x mb-3"></i>
                                    <h5 class="card-title">Dernière inscription</h5>
                                    <p class="card-text fw-bold">
                                        <?php 
                                        if ($totalInscrits > 0) {
                                            $lastDate = new DateTime($utilisateurs[0]['date_inscription_utilisateurs']);
                                            echo $lastDate->format('d/m/Y');
                                        } else {
                                            echo 'N/A';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info rounded-4 text-center py-5" role="alert">
                        <i class="fas fa-info-circle fa-3x mb-3 d-block"></i>
                        <h5 class="mb-2">Aucun inscrit pour le moment</h5>
                        <p class="text-muted">Les inscrits apparaîtront ici dès qu'ils se seront enregistrés.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>

        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .table-hover tbody tr:hover {
                background-color: #f8f9fa;
            }
            .fw-500 {
                font-weight: 500;
            }
            .card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            }
            @media print {
                .btn, .d-print-none {
                    display: none !important;
                }
            }
        </style>

        <div id="layoutAuthentication_footer">
            <?php include('../layout/footer.php'); ?>
