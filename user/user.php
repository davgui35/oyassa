<?php session_start(); 
// print_r($_SESSION['user_admin']); 
?>
<?php require_once('../templates/layout/headerUser.php');?>
<div class="container">
  <?php if (isset($_SESSION['alert']['newOrder']) && !empty($_SESSION['alert'])):?>
      <?= alertHtmlSuccess($_SESSION['alert']['newOrder']) ?>
      <?php unset($_SESSION['alert']['newOrder']);?>
  <?php endif;?>
  <?php if (isset($_SESSION['user_admin']['connexion']) && !empty($_SESSION['user_admin']['connexion'])):?>
      <?= alertHtmlSuccess($_SESSION['user_admin']['connexion']) ?>
      <?php unset($_SESSION['user_admin']['connexion']);?>
  <?php endif;?>
</div>
<div class="container-fluid d-flex">
  <div class="card p-4 m-5" style="width: 18rem;">
    <img src="../assets/img/utilisateur.svg" class="card-img-top" alt="user par défaut">
    <div class="card-body">
      <h5 class="card-title text-center"><?= $_SESSION['user_admin']['name']; ?></h5>
      <p class="card-text text-center">Employé</p>
      <p class="card-text text-center">
        <a href="statistics.php"><img src="../assets/img/statistiques.svg" class="card-img-top" alt="user par défaut"></a>
        <caption>Statistiques</caption>
      </p>
    </div>
  </div>
<!-- Les commandes -->
  <div class="container">
    <div class="row">
    <div class="card p-4 m-5 col-sm" style="width: 15rem;">
          <a href="cart.php" class="text-center text-decoration-none">
          <img src="../assets/img/commandes.svg" alt="Les commandes" width="230px">
            <div class="card-body">
              <h5 class="card-title text-center text-dark">Les commandes</h5>
              <p class="card-text text-center"></p>
            </div>
          </a>
        </div>
<!-- Ajout commande -->
        <div class="card p-4 m-5 col-sm" style="width: 15rem;">
          <a href="addCommands.php" class="text-center text-decoration-none">
            <img src="../assets/img/ajouter-commande.svg" alt="ajout des commandes" width="300px">
            <div class="card-body">
              <h5 class="card-title text-center text-dark">Ajout des commandes</h5>
              <p class="card-text text-center"></p>
            </div>
          </a>
        </div>
        <div class="card p-4 m-5 col-sm" style="width: 18rem;">
        <a href="../deconnection.php" class="text-center text-decoration-none">
          <img src="../assets/img/exit.svg" alt="se deconnecter" width="200px">
          <div class="card-body">
            <h5 class="card-title text-center text-dark"> Se déconnecter</h5>
            <p class="card-text text-center"></p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<?php require_once('../templates/layout/footerUser.php');?>