<?php
require_once('../templates/layout/headerAdmin.php');
require_once('../connection.php');
require_once('../utils/functions.php');

if(isset($_SESSION['newOrder'])){

    // Les informations de l'utilisateur de la commande
    $current_customer = $_SESSION["newOrder"][0];
    // Les variables à recupérer pour afficher la commande
    $current_customer_delivery = $_SESSION["newOrder"][0]['validation'];
    $_SESSION['newOrder'][0]['alert'] = 'APPUYER sur <span class="badge rounded-pill bg-success">Imprimer</span> pour obtenir votre bon de commande!';
    // var_dump($_SESSION);
    $number_of_order = lastIdFromOrders($pdo); 
    
}

//Affichage du bon de commande

?>

<?php if (isset($_SESSION['newOrder'][0]['alert']) && !empty($_SESSION['newOrder'][0]['validation'])):?>
      <?= alertHtmlSuccess($_SESSION['newOrder'][0]['alert']) ?>
      <?php unset($_SESSION['newOrder'][0]['alert']);?>
  <?php endif;?>

  <div class="container-fluid m-5" onload="window.print()">
  <div class="row">
    <div class="col-4">
        <div class="card" style="width: 24rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h6>Commande <?= $number_of_order+1; ?></h6> 
                <small><?= showDateDelivery($add_minutes = 0, 'd/m/Y H:i'); ?></small>
            </div>
                <small><strong><?= $current_customer['firstname'].' '.$current_customer['lastname']; ?></strong></small><br/>
                <small><?= $current_customer['phone']; ?></small><br/>
                <small><?=  $current_customer_delivery['delivery_adress']; ?></small><br/>
                <small>Livraison à <strong><?= $current_customer_delivery['hours']; ?></strong></small><br/>                   
        </div>
        <ul class="list-group list-group-flush">
        <?php foreach ($current_customer as $key => $categories): ?>
           <?php if(!in_array($key, tableException())):?>
            <?php foreach ($categories as $wordings => $values): ?>
                    <?php if(!strpos($wordings, '_price')):?>
                        <li class="list-group-item">
                            <div class="d-flex"> ▶ <?= $values ?> <?= ucfirst($wordings);?></div>
                        </li>
                    <?php endif;?>
            <?php endforeach; ?>
           <?php endif; ?>
        <?php endforeach; ?>
        <?= (isset($current_customer_delivery['comment']) && !empty($current_customer_delivery['comment']))? '<li class="list-group-item"><strong>NB:</strong> '.$current_customer_delivery['comment'].'</li>' : null ?>
        <li class="list-group-item">
            <div class="d-flex justify-content-between">
                <h3>NOTE</h3>
                <h3><strong><?=  $current_customer['sum'] ?></strong> €</h3>
            </div>
        </li>
        </ul>
        </div>
    </div>
    <div class="col-4"></div>
  </div>
</div>

<?php require_once('../templates/layout/footerAdmin.php');?>