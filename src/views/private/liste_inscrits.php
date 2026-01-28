<?php
include('../layout/header.php');
require_once('../auth/bdd.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Récupérer la liste des inscrits depuis la table utilisateurs

?><body>

<h1 style="text-align:center;font-family:'Policia';margin-top:20px;margin-bottom:20px;">Liste des inscrits</h1>
  <div class="table-minimal">
    

  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Email</th>
       <th scope="col">inscrit</th>
       <th scope="col">abonnements</th>
    </tr>
  </thead>
  <?php
			$result = $bddPDO->query('SELECT prenom_utilisateurs , nom_utilisateurs , email_utilisateurs , activité   FROM utilisateurs');
                while ($ligne = $result->fetch(PDO::FETCH_ASSOC )){
				       $prenom_utlisateurs = $ligne['prenom_utilisateurs'];
				       $nom_utilisateurs = $ligne['nom_utilisateurs'];
				       $email_utilisateurs= $ligne['email_utilisateurs'];
                       $activite_utilisateurs= $ligne['activité'];

                
        ?>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $nom_utilisateurs;?></td>
      <td><?php echo $prenom_utlisateurs;?></td>
      <td><?php echo $email_utilisateurs;?></td>
       <th scope="col">inscrit</th>
      <td><?php echo $activite_utilisateurs;?></td>
    </tr>
    <?php } ?>
   
  </tbody>
</table>
</div>

<style>
  .table-minimal {
  width: 100%;
  border-collapse: collapse;
  font-family: "Segoe UI", sans-serif;
}

.table-minimal th {
  background: #faf9f8;
  padding: 12px;
  text-align: left;
  font-weight: 600;
}

.table-minimal td {
  background-color: #fdfcfb;
  padding: 12px;
  border-top: 1px solid #f7f7f7;
}

.table-minimal tr:hover {
  background: #f8f8f8;
  font-family: 'anime';
  color: #d1c4bd;
}
@font-face {

    font-weight: normal;
    font-style: normal;
    font-family: 'anime';
    src: url('style/3.otf') format('opentype');

}
@font-face {
    font-family: 'Policia';
    src: url('style/policiaB.otf') format('opentype');
    font-weight: normal;
    font-style: normal;
 

}
body {
  background-color: #FFEFD6;
}


</style>

</body>


        <div id="layoutAuthentication_footer">
            <?php include('../layout/footer.php'); ?>
