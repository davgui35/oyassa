<?php require_once('../templates/layout/headerAdmin.php');
// var_dump($_SESSION);
?>
<div class="container">
  <?php if (isset($_SESSION['alert']['newOrder']) && !empty($_SESSION['alert'])):?>
      <?= alertHtmlSuccess($_SESSION['alert']['newOrder']) ?>
      <?php unset($_SESSION['alert']['newOrder']);?>
  <?php endif;?>
  <?php if (isset($_SESSION['admin']['connexion']) && !empty($_SESSION['admin']['connexion'])):?>
      <?= alertHtmlSuccess($_SESSION['admin']['connexion']) ?>
      <?php unset($_SESSION['admin']['connexion']);?>
  <?php endif;?>
</div>
<div class="container-fluid d-flex">
  <div class="card p-4 m-5" style="width: 15rem;">
    <img src="../assets/img/utilisateur.svg" class="card-img-top" alt="user par défaut">
    <div class="card-body">
      <h5 class="card-title text-center"><?= $_SESSION['admin']['name']; ?></h5>
      <p class="card-text text-center"><?= $_SESSION['admin']['status'] ?></p>
      <p class="card-text text-center">
        <a href="statistics.php"><img src="../assets/img/statistiques.svg" class="card-img-top" alt="logo pour les statistiques"></a>
        <caption>Historique</caption>
      </p>
    </div>
  </div>
<!-- Ajout user -->
  <div class="container">
    <div class="row">
      <div class="card p-4 m-5 col-sm" style="width: 15rem;">
        <a href="addAdmin.php" class="text-center  text-decoration-none">
          <img src="../assets/img/addUser.svg" alt="ajouter un utilisateur" width="120px">
          <div class="card-body">
            <h5 class="card-title text-center text-dark ">Ajout d'un utilisateur</h5>
            <p class="card-text text-center"></p>
          </div>
        </a>
      </div>
<!-- Les commandes -->
      <div class="card p-4 m-5 col-sm" style="width: 15rem;">
        <a href="cart.php" class="text-center  text-decoration-none">
        <img src="../assets/img/commandes.svg" alt="Les commandes" width="160px">
          <div class="card-body">
            <h5 class="card-title text-center text-dark ">Les commandes</h5>
            <p class="card-text text-center"></p>
          </div>
        </a>
      </div>
<!-- Ajout commande -->
      <div class="card p-4 m-5 col-sm" style="width: 18rem;">
        <a href="addCommands.php" class="text-center text-decoration-none">
          <img src="../assets/img/ajouter-commande.svg" alt="" width="220px">
          <div class="card-body">
            <h5 class="card-title text-center text-dark ">Ajout des commandes</h5>
            <p class="card-text text-center"></p>
          </div>
        </a>
      </div>
    </div>
<!-- Ajout un nouveau repas -->
    <div class="row">
      <div class="card p-4 m-5 col-sm" style="width: 18rem;">
        <a href="addMeal.php" class="text-center text-decoration-none">
          <img src="../assets/img/Ajouter-repas.svg" alt="ajout de repas" width="230px">
          <div class="card-body">
            <h5 class="card-title text-center text-dark ">Ajout de Repas</h5>
            <p class="card-text text-center"></p>
          </div>
        </a>
      </div>
<!-- Modifier ou supprimer un repas -->
      <div class="card p-4 m-5 col-sm" style="width: 18rem;">
        <a href="updateMeal.php" class="text-center text-decoration-none">
          <img src="../assets/img/supp-repas.svg" alt="modifier un repas" width="200px">
          <div class="card-body">
            <h5 class="card-title text-center text-dark ">Modifier ou supprimer Repas</h5>
            <p class="card-text text-center"></p>
          </div>
        </a>
      </div>
      <div class="card p-4 m-5 col-sm" style="width: 18rem;">
        <a href="../deconnection.php" class="text-center text-decoration-none">
          <img src="../assets/img/exit.svg" alt="se deconnecter" width="150px">
          <div class="card-body">
            <h5 class="card-title text-center text-dark "> Se déconnecter</h5>
            <p class="card-text text-center"></p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

<?php 
require_once('../templates/layout/footerAdmin.php');?>