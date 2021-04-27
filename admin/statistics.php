<?php
require_once('../templates/layout/headerAdmin.php');
require_once('../connection.php');
require_once('../utils/functions.php');?>

<h1 class="text-center">Historiques</h1>

<?php if(isset($_SESSION['newOrder'][0]) && isset($_SESSION['newOrder'][0]['validation']) && !$_SESSION['save_order']) {
    unset($_SESSION["newOrder"][0]['alert']);
    //tableau brut de la session
    $current_order = $_SESSION["newOrder"][0]; 
    //Récupération du tableau de commandes
   foreach ($current_order as $key => $categories){
       if(!in_array($key, tableException())){
           $orders[] = $categories;
       }
    }
    // Trie des valeurs de la commande
    // var_dump($orders);
    
    // Mise en place des variables d'historique
    $datas = [
        'customer' => $current_order['lastname'].' '.$current_order['firstname'],
        'hour' => $current_order['validation']['hours'],
        'delivery_adress' => $current_order['validation']['delivery_adress'],
        'delivery_price' => $current_order['validation']['delivery_price'],
        'sum' => $current_order['sum'],
        'comment' => $current_order['validation']['comment'],
        'order_array' => serialize($orders)
    ];
    // var_dump($datas);

    //Mettre un tabelau en base de données
    $ordersSerialize = serialize($orders);
    // var_dump($ordersSerialize);

    if(isset($datas, $ordersSerialize) && !empty($datas)) {

        $sql = "INSERT INTO orders (customer, hour, delivery_adress, delivery_price, sum, order_array, comment) VALUES (:customer, :hour, :delivery_adress, :delivery_price, :sum, :order_array, :comment )";
        $query = $pdo->prepare($sql);
        $query->bindValue(':customer', $datas['customer'], PDO::PARAM_STR);
        $query->bindValue(':hour', $datas['hour'], PDO::PARAM_STR);
        $query->bindValue(':delivery_adress', $datas['delivery_adress'], PDO::PARAM_STR);
        $query->bindValue(':delivery_price', $datas['delivery_price'], PDO::PARAM_INT);
        $query->bindValue(':sum', $datas['sum']);
        $query->bindValue(':order_array', $datas['order_array'], PDO::PARAM_STR);
        $query->bindValue(':comment', $datas['comment']);
        $query->execute();
        $_SESSION['save_order'] = true;
        if($_SESSION['admin'] || $_SESSION['save_order']){
            unset($_SESSION['newOrder']);
            $_SESSION['save_order'] = false;
            header('Location: admin.php' );
        }elseif($_SESSION['user_admin'] || $_SESSION['save_order']){
            unset($_SESSION['newOrder']);
            $_SESSION['save_order'] = false;
            header('Location: user.php' );
        }
    }

}

$orders = findAll('orders', $pdo);
// var_dump($orders);

?>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Créé le</th>
      <th scope="col">Nom Prénom</th>
      <th scope="col">Heure de livraison</th>
      <th scope="col">Adresse de livraison</th>
      <th scope="col">Prix de livraison</th>
      <th scope="col">Total</th>
      <th scope="col">Commentaire</th>
      <th scope="col">Résumé de la commande</th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i = 0; $i < count($orders); $i++) : ?>
            <tr>
                <th scope="row"><?= $orders[$i]['id_order'] ?></th>
                <td><?= $orders[$i]['created_at'] ?></td>
                <td><?= $orders[$i]['customer'] ?></td>
                <td><?= $orders[$i]['hour'] ?></td>
                <td><?= $orders[$i]['delivery_adress'] ?></td>
                <td><?= $orders[$i]['delivery_price'] ?> €</td>
                <td><?= $orders[$i]['sum'] ?> €</td>
                <td><?= $orders[$i]['comment'] ?></td>
                <td>
                <?php foreach (unserialize($orders[$i]['order_array']) as $key => $categories): ?>
                    <?php if(!in_array($key, tableException())):?>
                        <?php foreach ($categories as $wordings => $values): ?>
                                <?php if(!strpos($wordings, '_price')):?>
                                    <li class="d-flex"> ▶ <?= $values ?> <?= ucfirst($wordings);?></li>
                                <?php endif;?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </td>
            </tr>
    <?php endfor;?>
        
  </tbody>
</table>


<?php require_once('../templates/layout/footerAdmin.php');?>