<?php 
session_start(); 
require('../utils/functions.php');
// var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
    <title>Oyassa</title>
  </head>
  <body>
<?php if(isset($_SESSION) && isset($_SESSION['admin']['name'])): ?>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <div>
      <a class="navbar-brand" href="admin.php"><strong><img src="../assets/img/utilisateur.svg" width="60px" alt="avatar par défault" ><small class="text-warning"> <?= ucfirst($_SESSION['admin']['name']); ?></small></strong></a>
      <?php if(!isset($_SESSION['newOrder'][0])): ?>
        <a class="navbar-brand" href="addCommands.php"><span class="badge rounded-pill bg-success">Nouvelle commande</span></a>
      <?php endif; ?>
      <?php if(isset($_SESSION["newOrder"][0]['id_customer'])):?>
        <a class="navbar-brand" href="../client/client.php"><span class="badge rounded-pill bg-success">Commande</span></a>
      <?php endif; ?>
      <?php if(isset($_SESSION['newOrder'][0]['validation'])): ?>
        <a class="navbar-brand" href="impression.php"><span class="badge rounded-pill bg-success">Valider</span></a>
        <a class="navbar-brand" href="impression.php" onclick="window.print()" ><span class="badge rounded-pill bg-success">Imprimer</span></a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<?php endif; ?>
  
<div class="container-fluid">