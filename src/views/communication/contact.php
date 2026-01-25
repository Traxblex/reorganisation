<?php include('../layout/header.php'); ?>
<title>Fitsport - Contact</title>
<div class="container mt-5 pt-5">
    <h1 class="mb-4">CONTACTEZ-NOUS</h1>
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
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
<?php include('../layout/footer.php'); ?>