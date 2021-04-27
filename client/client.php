<?php
if(!isset($_SESSION)){

    session_start();
}

// var_dump($_SESSION['newOrder'][0]);
require_once('../templates/layout/headerClient.php');

require_once('../connection.php');
require_once('../utils/functions.php');
$somme = 0;
//All categories in session
$_SESSION['starters'] = findAll('starters',$pdo);
$_SESSION['snacks'] = findAll('snacks',$pdo);
$_SESSION['grills'] = findAll('grills',$pdo);
$_SESSION['meals'] = findAll('meals',$pdo);
$_SESSION['accompaniments'] = findAll('accompaniments',$pdo);
$_SESSION['sauces'] = findAll('sauces',$pdo);
$_SESSION['desserts'] = findAll('desserts',$pdo);
$_SESSION['drinks'] = findAll('drinks',$pdo);
$_SESSION['menus'] = findAll('menus',$pdo);

// Récupérer la date au bon format
// Ajouter 30 minutes
$order_time = showDateDelivery($add_minutes = 0, 'H:i');;
$_SESSION['newOrder'][0]['time'] = showDateDelivery($add_minutes = 30, 'H:i');


//for starters are not in stock
if(isset($_POST['startersStock']) && $_POST['startersStock'] == 'reload'){
    // print_r($_POST);
    if(isset($_POST['quantity']) && $_POST['quantity']  > 0  || !empty($_POST['quantity'])){
        updateStock('starters', $_POST['name'], $_POST['quantity'], $pdo);
        $_SESSION['alert'] = "Vos stocks ENTREES ont été mises à jour!";
    }
    header('Location: client.php');
}

//for snacks are not in stock
if(isset($_POST['snacksStock']) && $_POST['snacksStock'] == 'reload'){
    // print_r($_POST);
    if(isset($_POST['quantity']) && $_POST['quantity'] > 0 || !empty($_POST['quantity'])){
        updateStock('snacks', $_POST['name'], $_POST['quantity'], $pdo);
         $_SESSION['alert'] = "Vos stocks SNACKS ont été mises à jour!";
    } 
    header('Location: client.php');
}

//for grills are not in stock
if(isset($_POST['grillsStock']) && $_POST['grillsStock'] == 'reload'){
    // print_r($_POST);
    if(isset($_POST['quantity']) && $_POST['quantity'] > 0 || !empty($_POST['quantity'])){
        updateStock('grills', $_POST['name'], $_POST['quantity'], $pdo);
         $_SESSION['alert'] = "Vos stocks GRILLADES ont été mises à jour!";
    }
    header('Location: client.php');
}

//for meals are not in stock
if(isset($_POST['mealsStock']) && $_POST['mealsStock'] == 'reload'){
    // print_r($_POST);
    if(isset($_POST['quantity']) && $_POST['quantity'] > 0 || !empty($_POST['quantity'])){
        updateStock('meals', $_POST['name'], $_POST['quantity'], $pdo);
        $_SESSION['alert'] = "Vos stocks PLATS ont été mises à jour!";
    }
    header('Location: client.php');
}

//for accompaniments are not in stock
if(isset($_POST['accompanimentsStock']) && $_POST['accompanimentsStock'] == 'reload'){
    // print_r($_POST);
    if(isset($_POST['quantity']) && $_POST['quantity'] > 0 || !empty($_POST['quantity'])){
        updateStock('accompaniments', $_POST['name'], $_POST['quantity'], $pdo);
         $_SESSION['alert'] = "Vos stocks ACCOMPAGNEMENTS ont été mises à jour!";
    }
    header('Location: client.php');
}

//for sauces are not in stock
if(isset($_POST['saucesStock']) && $_POST['saucesStock'] == 'reload'){
    // print_r($_POST);
    if(isset($_POST['quantity']) && $_POST['quantity'] > 0 || !empty($_POST['quantity'])){
        updateStock('sauces', $_POST['name'], $_POST['quantity'], $pdo);
         $_SESSION['alert'] = "Vos stocks SAUCES ont été mises à jour!";
    }
    header('Location: client.php');
}

//for desserts are not in stock
if(isset($_POST['dessertsStock']) && $_POST['dessertsStock'] == 'reload'){
    // print_r($_POST);
    if(isset($_POST['quantity']) && $_POST['quantity'] > 0 || !empty($_POST['quantity'])){
        updateStock('desserts', $_POST['name'], $_POST['quantity'], $pdo);
         $_SESSION['alert'] = "Vos stocks DESSERTS ont été mises à jour!";
    }
}

//for drinks are not in stock
if(isset($_POST['drinksStock']) && $_POST['drinksStock'] == 'reload'){
    // print_r($_POST);
    if(isset($_POST['quantity']) && $_POST['quantity'] > 0 || !empty($_POST['quantity'])){
        updateStock('drinks', $_POST['name'], $_POST['quantity'], $pdo);
         $_SESSION['alert']= "Vos stocks BOISSONS ont été mises à jour!";
    }
    header('Location: client.php');
}

//for menus are not in stock
if(isset($_POST['menusStock']) && $_POST['menusStock'] == 'reload'){
    // print_r($_POST);
    if(isset($_POST['quantity']) && $_POST['quantity'] > 0 || !empty($_POST['quantity'])){
        updateStock('menus', $_POST['name'], $_POST['quantity'], $pdo);
         $_SESSION['alert'] = "Vos stocks MENUS ont été mises à jour!";
    }
    header('Location: client.php');
}

//Insertion SESSION starters
if(isset($_POST['starters']) && !empty($_POST['starters'])){
    // print_r($_POST);

    foreach($_SESSION['starters'] as $key => $indexArticle){
        addArticleInSession($indexArticle['name'], 'starters');
        gestionStock('starters',  $key, $indexArticle['name'], $pdo);
    }
}

//Insertion SESSION snacks
if(isset($_POST['snacks']) && !empty($_POST['snacks'])){
    // var_dump($_POST);
    foreach($_SESSION['snacks'] as $key => $indexArticle){
        addArticleInSession($indexArticle['name'], 'snacks');
        gestionStock('snacks',  $key, $indexArticle['name'], $pdo);
    }
}

//Insertion SESSION grills
if(isset($_POST['grills']) && !empty($_POST['grills'])){
    // var_dump($_POST);
    foreach($_SESSION['grills'] as $key => $indexArticle){

        addArticleInSession($indexArticle['name'], 'grills');
        gestionStock('grills',  $key, $indexArticle['name'], $pdo);
    }
}

//Insertion SESSION meals
if(isset($_POST['meals']) && !empty($_POST['meals'])){
    // print_r($_POST);
    foreach($_SESSION['meals'] as $key => $indexArticle){
        addArticleInSession($indexArticle['name'], 'meals');
        gestionStock('meals',  $key, $indexArticle['name'], $pdo);
    }
}

//Insertion SESSION accompaniments
if(isset($_POST['accompaniments']) && !empty($_POST['accompaniments'])){
    // print_r($_POST);

    foreach($_SESSION['accompaniments'] as $key => $indexArticle){
        addArticleInSession($indexArticle['name'], 'accompaniments');
        gestionStock('accompaniments',  $key, $indexArticle['name'], $pdo);
    }
}

//Insertion SESSION sauces
if(isset($_POST['sauces']) && !empty($_POST['sauces'])){
    // print_r($_POST);

    foreach($_SESSION['sauces'] as $key => $indexArticle){
        addArticleInSession($indexArticle['name'], 'sauces');
        gestionStock('sauces',  $key, $indexArticle['name'], $pdo);
    }
}

//Insertion SESSION desserts
if(isset($_POST['desserts']) && !empty($_POST['desserts'])){
    // var_dump($_POST['desserts']);

    foreach($_SESSION['desserts'] as $key => $indexArticle){
        addArticleInSession($indexArticle['name'], 'desserts');
        gestionStock('desserts',  $key, $indexArticle['name'], $pdo);
    }
}

//Insertion SESSION drinks
if(isset($_POST['drinks']) && !empty($_POST['drinks'])){
    // print_r($_POST);
    foreach($_SESSION['drinks'] as $key => $indexArticle){
        addArticleInSession($indexArticle['name'], 'drinks');
        gestionStock('drinks',  $key, $indexArticle['name'], $pdo);
    } 
}

//Insertion SESSION menus
if(isset($_POST['menus']) && !empty($_POST['menus'])){
    // print_r($_POST);
    foreach($_SESSION['menus'] as $key => $indexArticle){
        addArticleInSession($indexArticle['name'], 'menus');
        gestionStock('menus',  $key, $indexArticle['name'], $pdo);
    } 
}
// echo '<pre>';
// print_r($_SESSION['alert']);
// echo '</pre>';
?>



<?php if (isset($_SESSION['alert']) && !empty($_SESSION["alert"])):?>
    <div onclick="bye()"><?= alertHtmlWarningStock($_SESSION['alert']) ?></div>
    <?php if (isset($_GET['action']) && $_GET['action'] == "delete"){
        unset($_SESSION['alert']);
    };?>
<?php endif;?>
<?php if(isset($_SESSION['newOrder'][0])): ?>
    <div class="container-fluid">
    <h1>Commande client</h1>
    <div class="row justify-content-center align-items-center">
        <div class="col-6">
        <?php if(isset($_SESSION["newOrder"][0]['id_customer'])):?>
            <?php foreach($_SESSION['newOrder'] as $index => $customer): ?>
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex">
                        <h5 class="card-title">Commande de <?= $customer['firstname']. ' '. $customer['lastname'] ?></h5>
                    </div>
                        <p class="card-text">Tel: <?= $customer['phone']  ?></p>
                        <p class="card-text">Adresse: <?= $customer['adress']  ?></p>
                        <p class="card-text">Heure de commande: <?= $order_time; ?></p>
                        <p class="card-text">Heure de livraison: <strong><?= (isset($_SESSION['newOrder'][0]['time']))? $_SESSION['newOrder'][0]['time'] : null  ?></strong> </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif;?>
        </div>
        <div class="col-1"></div>
        <div class="col-4">
        <?php if(isset($_SESSION["newOrder"][0]['id_customer'])):?>
            <div class="card text-center" style="width: 20rem;">
                <div class="card-header">
                <h6>Commande de <?=$_SESSION['newOrder'][0]['lastname'] . ' '.  $_SESSION['newOrder'][0]['firstname'] ?></h6>
                </div>
                    <?php foreach ($_SESSION['newOrder'][0] as $key => $categories): ?>
                        <?php if(!in_array($key ,tableException())): ?>
                            <?php foreach($categories as $name_product => $quantity): ?>
                                <?php if(array_key_exists($name_product.'_price', $categories )): ?>
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><?php 
                                        $totalProduct = $categories[$name_product.'_price'] * $quantity;  
                                        $somme += $totalProduct;  
                                        ?>
                                    <p><small><?= $quantity ?> <strong><em><?= str_replace('_',' ',ucfirst($name_product)) ?></em></strong> <?= $categories[$name_product.'_price']. ' €' ?> <strong>Total: </strong> <?=  $totalProduct; ?> €</small></p></li>
                                    </ul>
                                <?php endif;?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <p><strong><em>Somme dûe: </em></strong><?= $somme; ?> €</p>
            </div>
        <?php endif; ?>
        </div>
    </div>
    </div>
    <div class="container-fluid m-3">
        <div class="row justify-content-center">
            <div class="col-1">
             <!-- buttons des commandes -->
                <span class="d-block m-3"><button type="button" class="btn btn-dark" id="btn-starters">Entrée</button></span>
                <span class="d-block m-3"><button type="button" class="btn btn-dark" id="btn-snacks">Snacks</button></span>
                <span class="d-block m-3"><button type="button" class="btn btn-dark" id="btn-grills">Grillades</button></span>
                <span class="d-block m-3"><button type="button" class="btn btn-dark" id="btn-meals">Plats</button></span>
                <span class="d-block m-3"><button type="button" class="btn btn-dark" id="btn-accompaniments">Accompagnements</button></span>
                <span class="d-block m-3"><button type="button" class="btn btn-dark" id="btn-sauces">Sauces</button></span>
                <span class="d-block m-3"><button type="button" class="btn btn-dark" id="btn-desserts">Desserts</button></span>
                <span class="d-block m-3"><button type="button" class="btn btn-dark" id="btn-drinks">Boissons</button></span>
                <span class="d-block m-3"><button type="button" class="btn btn-dark" id="btn-menus">Menus</button></span>
            </div>
            <div class="col">
                 <!-- starters -->
                <?php require_once('templates/starters.php')?>
                <!-- snacks -->
                <?php require_once('templates/snacks.php')?>
                <!-- grills -->
                <?php require_once('templates/grills.php')?>
                <!-- meals -->
                <?php require_once('templates/meals.php')?>
                <!-- accompiments -->
                <?php require_once('templates/accompaniments.php')?>
                <!-- sauces -->
                <?php require_once('templates/sauces.php')?>
                <!-- desserts -->
                <?php require_once('templates/desserts.php')?>
                <!-- drinks -->
                <?php require_once('templates/drinks.php')?>
                <!-- menus -->
                <?php require_once('templates/menus.php')?>
            </div>
        </div>
    </div>
<?php else: ?>
    <?= alertHtmlWarning("Il n'y a pas de commandes pour le moment!") ?>
<?php endif; ?>
<script>
    function bye(){
        window.location.href = "client.php?action=delete";
    }
</script>
<?php require_once('../templates/layout/footerClient.php');?>