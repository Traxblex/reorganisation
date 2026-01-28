<?php include('../layout/header.php'); ?>
<?php
include('../auth/bdd.php');

$errors = [];
$success = '';

// Définir des créneaux de boxe (exemples)
$sessions = [
	['id' => 1, 'label' => 'Lundi 18:00 - 19:00'],
	['id' => 2, 'label' => 'Mercredi 19:00 - 20:00'],
	['id' => 3, 'label' => 'Vendredi 18:30 - 19:30'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$prenom = trim($_POST['prenom'] ?? '');
	$nom = trim($_POST['nom'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$session_id = intval($_POST['session_id'] ?? 0);

	if ($prenom === '') $errors[] = 'Le prénom est requis.';
	if ($nom === '') $errors[] = 'Le nom est requis.';
	if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Un email valide est requis.';
	if ($session_id <= 0) $errors[] = 'Veuillez choisir une séance.';

	if (empty($errors)) {
		try {
			// Créer la table si elle n'existe pas
			$create = "CREATE TABLE IF NOT EXISTS inscriptions_boxe (
				id INT PRIMARY KEY AUTO_INCREMENT,
				prenom VARCHAR(100) NOT NULL,
				nom VARCHAR(100) NOT NULL,
				email VARCHAR(150) NOT NULL,
				session_id INT NOT NULL,
				session_label VARCHAR(255) NOT NULL,
				created_at DATETIME DEFAULT CURRENT_TIMESTAMP
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
			$bddPDO->exec($create);

			// Trouver le label de la session
			$session_label = '';
			foreach ($sessions as $s) {
				if ($s['id'] === $session_id) { $session_label = $s['label']; break; }
			}

			$stmt = $bddPDO->prepare('INSERT INTO inscriptions_boxe (prenom, nom, email, session_id, session_label) VALUES (:prenom, :nom, :email, :session_id, :session_label)');
			$stmt->execute([
				':prenom' => $prenom,
				':nom' => $nom,
				':email' => $email,
				':session_id' => $session_id,
				':session_label' => $session_label,
			]);

			$success = 'Inscription enregistrée avec succès.';
		} catch (Exception $e) {
			$errors[] = 'Erreur serveur : ' . $e->getMessage();
		}
	}
}
?>

<title>Fitsport - Boxe</title>
<main class="container mt-5 pt-5">
	<div class="row">
		<div class="col-md-8">
			<h1 class="mb-4">Séances de BOXE</h1>

			<?php if (!empty($errors)): ?>
				<div class="alert alert-danger" role="alert">
					<ul class="mb-0">
						<?php foreach ($errors as $err): ?>
							<li><?php echo htmlspecialchars($err); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php if ($success): ?>
				<div class="alert alert-success" role="alert"><?php echo htmlspecialchars($success); ?></div>
			<?php endif; ?>

			<div class="list-group mb-4">
				<?php foreach ($sessions as $s): ?>
					<div class="list-group-item d-flex justify-content-between align-items-center">
						<div>
							<strong><?php echo htmlspecialchars($s['label']); ?></strong>
							<div class="text-muted">Durée: 1h — Coach: Stéphane</div>
						</div>
						<span class="badge bg-primary rounded-pill">Places illimitées</span>
					</div>
				<?php endforeach; ?>
			</div>

			<p class="text-muted">Remplissez le formulaire pour vous inscrire à une séance.</p>
		</div>

		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title" style="color: #dc3545;" >Inscription</h5>
					<form method="post" novalidate>
						<div class="mb-3">
							<label class="form-label">Prénom</label>
							<input name="prenom" type="text" class="form-control" value="<?php echo isset($prenom) ? htmlspecialchars($prenom) : ''; ?>" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Nom</label>
							<input name="nom" type="text" class="form-control" value="<?php echo isset($nom) ? htmlspecialchars($nom) : ''; ?>" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Email</label>
							<input name="email" type="email" class="form-control" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Séance</label>
							<select name="session_id" class="form-select" required>
								<option value="">-- Choisir une séance --</option>
								<?php foreach ($sessions as $s): ?>
									<option value="<?php echo $s['id']; ?>" <?php echo (isset($session_id) && $session_id == $s['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($s['label']); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<button type="submit" class="btn btn-danger">S'inscrire</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>

<?php include('../layout/footer.php'); ?>


