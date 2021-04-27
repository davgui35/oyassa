<?php
require_once('../templates/layout/headerUser.php');
require_once('../connection.php');
require_once('../utils/functions.php');

if(isset($_SESSION['newOrder'])){

    // Les informations de l'utilisateur de la commande
    $current_customer = $_SESSION["newOrder"][0];
    // Les variables à recupérer pour afficher la commande
    $current_customer_delivery = $_SESSION["newOrder"][0]['validation'];
    $_SESSION['newOrder'][0]['alert'] = 'APPUYER sur <span class="badge rounded-pill bg-success">Imprimer</span> pour obtenir votre bon de commande!';
    $number_of_order = lastIdFromOrders($pdo); 
}

// var_dump($_SESSION['user_admin']);
//Affichage du bon de commande

?>

<?php if (isset($_SESSION['newOrder'][0]['alert']) && !empty($_SESSION['newOrder'][0]['validation'])):?>
    <?= alertHtmlSuccess($_SESSION['newOrder'][0]['alert']) ?>
    <?php unset($_SESSION['newOrder'][0]['alert']);?>
<?php endif;?>

  <div class="container-fluid m-5">
  <div class="row">
    <div class="col-4">
        <div class="card" style="width: 32rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h6>Commande <?= $number_of_order+1; ?></h6> 
                <?= showDateDelivery($add_minutes = 0, 'd/m/Y H:i'); ?>
            </div>
                <strong><?= $current_customer['firstname'].' '.$current_customer['lastname']; ?></strong><br/>
                <?= $current_customer['phone']; ?><br/>
                <?=  $current_customer_delivery['delivery_adress']; ?><br/>
                Livraison à <strong><?= $current_customer_delivery['hours']; ?></strong><br/>                   
        </div>
        <ul class="list-group list-group-flush">
        <?php foreach ($current_customer as $key => $categories): ?>
            <?php if(!in_array($key ,tableException())): ?>
                <?php foreach ($categories as $wordings => $values): ?>
                    <?php if(!strpos($wordings, '_price')):?>
                        <li class="list-group-item">
                            <div class="d-flex"> ▶ <?= $values ?> <?= ucfirst($wordings);?></div>
                        </li>
                    <?php endif;?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <li class="list-group-item"><strong>NB:</strong> <?= $current_customer_delivery['comment']; ?></li>
        <li class="list-group-item">
            <div class="d-flex justify-content-between">
                <h3>NOTE</h3>
                <h3><strong><?= $current_customer_delivery['sum'] ?></strong> €</h3>
            </div>
        </li>
        </ul>
        </div>
    </div>
    <div class="col-4"></div>
  </div>
</div>



<?php require_once('../templates/layout/footerUser.php');?>