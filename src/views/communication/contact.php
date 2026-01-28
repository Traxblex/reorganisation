<?php include('../layout/header.php'); ?>
<title>Fitsport - Contact</title>
<main class="d-flex align-items-center justify-content-center min-vh-100 py-4" style="background-color: #dee0e0cc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4" style="max-width: 100%;">
                    <div class="card-header bg-danger text-white text-center py-4 rounded-top-4">
                        <h1 class="mb-4">CONTACTEZ-NOUS</h1>
                    </div>
                    <div class="card-body text-success">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom complet</label>
                                <input type="text" class="form-control" id="name" placeholder="Entrez votre nom complet">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse email</label>
                                <input type="email" class="form-control" id="email" placeholder="Entrez votre adresse email">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Entrez votre message"></textarea>
                            </div>
                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" name="envoyer" class="btn btn-danger btn-lg fw-bold rounded-3"><i class="bi bi-send me-2"></i>Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
</main>
<?php include('../layout/footer.php'); ?>