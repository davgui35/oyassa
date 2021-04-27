<?php if(isset($_SESSION['admin'])):
  require('../utils/functions.php');
// var_dump($_SESSION['newOrder']);
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styleClient.css">
    <script language=javascript type="text/javascript" src="js/fonctions_javascript.js"></script>
    <title>Oyassa</title>
  </head>
  <body>
<?php if(isset($_SESSION) && isset($_SESSION['admin']['name'])): ?>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <div>
      <a class="navbar-brand" href="../admin/admin.php"><strong><img src="../assets/img/utilisateur.svg" width="60px" alt="avatar par défault" ><small class="text-warning"> <?= ucfirst($_SESSION['admin']['name']); ?></small></strong></a>
      <?php if(isset($_SESSION['newOrder']) && empty($_SESSION['newOrder'][0])): ?>
        <a class="navbar-brand" href="client.php"><span class="badge rounded-pill bg-success">Nouvelle commande</span></a>
      <?php else: ?>
        <a class="navbar-brand" href="client.php"><span class="badge rounded-pill bg-success">Commande</span></a>
        <a class="navbar-brand" href="delete.php"><span class="badge rounded-pill bg-danger">Supprimer commande</span></a>
      <?php endif; ?>
      <?php if(isset($_SESSION['newOrder'][0]['commande']) || $_SESSION['newOrder'][0] ): ?>
      <a class="navbar-brand" href="../admin/cart.php"><span class="badge rounded-pill bg-success">Voir le panier</span></a>
    <?php endif; ?>
    </div>
  </div>
</nav>
<?php endif; ?>

<?php elseif(isset($_SESSION['user_admin'])):?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styleClient.css">
    <script language=javascript type="text/javascript" src="js/fonctions_javascript.js"></script>
    <title>Oyassa</title>
  </head>
  <body>
<?php if(isset($_SESSION) && isset($_SESSION['user_admin']['name'])): ?>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <div>
      <a class="navbar-brand" href="../user/user.php"><strong><img src="../assets/img/utilisateur.svg" width="60px" alt="avatar par défault" ><small> <?= ucfirst($_SESSION['user_admin']['name']); ?></small></strong></a>
      <?php if(isset($_SESSION['newOrder']) && empty($_SESSION['newOrder'][0])): ?>
        <a class="navbar-brand" href="client.php"><span class="badge rounded-pill bg-success">Nouvelle commande</span></a>
      <?php else: ?>
        <a class="navbar-brand" href="client.php"><span class="badge rounded-pill bg-success">Commande</span></a>
        <a class="navbar-brand" href="delete.php"><span class="badge rounded-pill bg-danger">Supprimer commande</span></a>
      <?php endif; ?>
      <?php if(isset($_SESSION['newOrder'][0]['commande']) || $_SESSION['newOrder'][0] ): ?>
      <a class="navbar-brand" href="../user/cart.php"><span class="badge rounded-pill bg-success">Voir le panier</span></a>
    <?php endif; ?>
    </div>
  </div>
</nav>
<?php endif; ?>
<?php endif;?>
