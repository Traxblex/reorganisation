<link href="../frontend/login/css/sb-admin-2.min.css" rel="stylesheet">

<div class="container" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Mot de passe oublié</h1>
                                </div>
                                <form class="user">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                               id="resetEmail" aria-describedby="emailHelp"
                                               placeholder="Entrez votre adresse email ...">
                                    </div>
                                    <a href="/public/index.php?controller=auth&action=login" class="btn btn-primary btn-user btn-block">
                                        Réinitialiser le mot de passe
                                    </a>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="index.php?controller=auth&action=inscription">
                                        Créer un compte
                                    </a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="index.php?controller=auth&action=login">
                                        Vous avez déjà un compte ? Connectez-vous !
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


