<?php 
if(isset($_SESSION['admin'])):
  require('utils/functions.php');?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <title>Oyassa</title>
  </head>
  <body>
<?php if(isset($_SESSION) && isset($_SESSION['admin']['name'])): ?>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <div>
      <a class="navbar-brand" href="admin/admin.php"><strong><img src="assets/img/utilisateur.svg" alt="avatar par défault" ><small class="text-warning"> <?= ucfirst($_SESSION['admin']['name']); ?></small></strong></a>
      <?php if(isset($_SESSION['newOrder'])): ?>
        <a class="navbar-brand" href="client.php"> | Nouvelle commande</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<?php endif; ?>
  
<div class="container-fluid">
<?php else: ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <title>Oyassa</title>
  </head>
  <body>
<?php if(isset($_SESSION) && isset($_SESSION['user']['name'])): ?>
  <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
  
    <a class="navbar-brand" href="user/user.php"><strong><img src="assets/img/utilisateur.svg" alt="avatar par défault" > <small> <?= ucfirst($_SESSION['user']['name']); ?></small></strong></a>
  </div>
</nav>
<?php endif; ?>
<div class="container-fluid">

<?php endif; ?>

