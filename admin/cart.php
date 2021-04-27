<?php
require_once('../templates/layout/headerAdmin.php');
require_once('../connection.php');
require_once('../utils/functions.php');

$id = "";
$somme = 0;
$livraison = 0;

if(isset($_SESSION['newOrder'])){
    $livraison = (isset($_SESSION["newOrder"][0]['delivery_price']))? $_SESSION["newOrder"][0]['delivery_price'] : 0;
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
    $id = (isset($_SESSION['newOrder'][0]['id_customer']))? $_SESSION['newOrder'][0]['id_customer'] : null;
}
// var_dump($_SESSION);
// var_dump($_SESSION['newOrder'][0]);

// Pour l'heure de livraison
if(isset($_GET['action']) && $_GET["action"] == "time"){
    $_SESSION['newOrder'][0]['delivery'] = showDateDelivery($add_minutes = 30, 'H:i');;
}

// Pour le RDV Point de RDV
if(isset($_GET['action']) && $_GET["action"] == "point_rdv"){

    if(isset($_GET["place"]) == "Cleunay" && !empty($_GET["place"])){
        $_SESSION['newOrder'][0]['point_rdv'] = $_GET["place"];
    }
    if(isset($_GET["place"]) == "Grand_Quartier" && !empty($_GET["place"])){
        $_SESSION['newOrder'][0]['point_rdv'] = $_GET["place"];
    }
    if(isset($_GET["place"]) == "La_poterie" && !empty($_GET["place"])){
        $_SESSION['newOrder'][0]['point_rdv'] = $_GET["place"];
    }

}

// Pour le RDV adresse
if(isset($_GET['action']) && $_GET["action"] == "adress"){
    $_SESSION['newOrder'][0]['delivery_adress'] = $_SESSION['newOrder'][0]['adress'].' '.$_SESSION['newOrder'][0]['codepostal'].' '.$_SESSION['newOrder'][0]['city'];
}

// Pour le price livraison
if(isset($_GET['action']) && $_GET["action"] == "delivery_price"){
    if(isset($_GET["price"])){
        $_SESSION['newOrder'][0]['delivery_price'] = $_GET["price"];
    }
}

// Pour le price paiement
if(isset($_GET['action']) && $_GET["action"] == "payment"){
    if(isset($_GET['means'])){
        $_SESSION['newOrder'][0]['payment'] = $_GET["means"];
    }
}

// Pour le commentaire et la validation de la commande
if(isset($_POST["new_order"])){
    // var_dump($_POST);
    $_SESSION['newOrder'][0]['validation'] = $_POST;
    header('Location: cart.php');
    $_SESSION['newOrder'][0]['alert'] = 'APPUYER sur <span class="badge rounded-pill bg-success">Valider</span> en haut à gauche pour préparer l\'impression de cette commande!';
}


//Pour retourner au paiement
if(isset($_GET["action"], $_GET["mode"]) && $_GET['mode'] == "payment"){
    unset($_SESSION['newOrder'][0]['payment']);
}
//Pour retourner au paiement
if(isset($_GET["action"], $_GET["mode"]) && $_GET['mode'] == "delivery_price"){
    unset($_SESSION['newOrder'][0]['delivery_price']);
}
//Pour retourner au paiement
if(isset($_GET["action"], $_GET["mode"]) && $_GET['mode'] == "delivery_adress"){
    unset($_SESSION['newOrder'][0]['delivery_adress']);
}
//Pour retourner au point_rdv
if(isset($_GET["action"], $_GET["mode"]) && $_GET['mode'] == "point_rdv"){
    unset($_SESSION['newOrder'][0]['point_rdv']);
}
//Pour retourner au rdv
if(isset($_GET["action"], $_GET["mode"]) && $_GET['mode'] == "rdv"){
    unset($_SESSION['newOrder'][0]['rdv']);
}
//Pour reset heure
if(isset($_GET["action"], $_GET["mode"]) && $_GET['mode'] == "delivery"){
    unset($_SESSION['newOrder'][0]['delivery']);
}
?>

<?php if(!isset($_SESSION['newOrder'][0]['commande'])){
    echo alertHtmlWarning("Votre panier ne contient pas d'articles");
} 

if(isset($_SESSION['newOrder'][0]) && isset($_SESSION['newOrder'][0]['commande'])): ?>

<?php if (isset($_SESSION['newOrder'][0]['alert']) && !empty($_SESSION['newOrder'][0]['validation'])):?>
    <?= alertHtmlWarning($_SESSION['newOrder'][0]['alert']) ?>
    <?php unset($_SESSION['newOrder'][0]['alert']);?>
<?php endif;?>
<div class="container-fluid m-3 ">
    <div class="row justify-content-center align-items-center">
        <div class="col-6 p-5 border">
            <h5 text-center>Commande de <?= $_SESSION['newOrder'][0]['lastname'] . ' '.  $_SESSION['newOrder'][0]['firstname'] ?></h5>
            <!-- table -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nom du produit</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Prix unitaire</th>
                        <th scope="col">Prix total</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach ($_SESSION['newOrder'][0] as $key => $categories): ?>
                            <?php if(!in_array($key ,tableException())): ?>
                                <?php foreach($categories as $name_product => $quantity): ?>
                                    <?php if(array_key_exists($name_product.'_price', $categories )): ?>
                                        <?php $totalProduct = $categories[$name_product.'_price'] * $quantity;
                                        $somme += $totalProduct;
                                        $_SESSION['newOrder'][0]['sum'] = $somme; ?>  
                                        <tr>
                                        <td><?= str_replace('_',' ',ucfirst($name_product)) ?></td>
                                        <td><?= $quantity ?></td>
                                        <td><?= $categories[$name_product.'_price'] ?>€</td>
                                        <td><?= $totalProduct ?>€</td>
                                        </tr>
                                    <?php endif;?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td  colspan="2"><strong><em>livraison : </em></strong><?= $livraison; ?> €</td>
                        <td><strong><em>Somme dûe: </em></strong><?= $somme; ?> €</td>
                        <?php $_SESSION['newOrder'][0]['sum'] = $somme + $livraison ?>
                        <td><strong><em>Total: </em></strong><?= $_SESSION['newOrder'][0]['sum']; ?> €</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-1"></div>
        <div class="col-4 p-5 border">
            <!--1 Affichage de l'heure -->
        <?php if (isset($_SESSION['newOrder'][0]['delivery'])):?>
            <h4>1- Heure livrée</h4>
            <p><span class="badge bg-success">Heure de livraison : <?= $_SESSION['newOrder'][0]['delivery'] ?></span></p>
        <?php endif;?>

        <!--1 Définir L'heure -->
        <?php if(!isset($_SESSION['newOrder'][0]['delivery'])): ?>
            <a href="cart.php?action=time&id=<?= $id ?>" class="btn btn-dark">Définir l'heure de Livraison</a>
        <?php endif; ?>

        <!--2 RDV -->
        <?php if(!isset($_SESSION['newOrder'][0]['point_rdv']) && !isset($_SESSION['newOrder'][0]['delivery_adress']) && isset($_SESSION['newOrder'][0]['delivery'])): ?>
            <a href="cart.php?action=rdv&id=<?= $id ?>" class="btn btn-dark">Définir un point de rendez-vous</a>
            <a href="cart.php?action=reset&mode=delivery&id=<?= $id ?>"><button type="button" class="btn btn-outline-danger">Retour</button></a>
        <?php endif; ?>


        <!--2 choix de livraison -->
        <?php if(isset($_GET['action']) && $_GET["action"] == "rdv"): ?>
            <div class="d-flex">
                <div><a href="cart.php?action=point_rdv&id=<?= $id ?>" class="btn btn-outline-dark m-3"> Point de rendez-vous </a></div>
                <div><a href="cart.php?action=adress&id=<?= $id ?>" class="btn btn-outline-dark m-3"> À votre adresse </a></div>
            </div>
        <?php endif; ?>

        <!--2 si c'est point de rendez-vous -->
        <?php if(isset($_GET['action']) && $_GET["action"] == "point_rdv" && !isset($_SESSION['newOrder'][0]['point_rdv'])): ?>
            <div class="d-flex">
                <div><a href="cart.php?action=point_rdv&place=Cleunay&id=<?= $id ?>" class="btn btn-outline-dark m-3">Cleunay</a></div>
                <div><a href="cart.php?action=point_rdv&place=Grand_Quartier&id=<?= $id ?>" class="btn btn-outline-dark m-3">Grand Quartier</a></div>
                <div><a href="cart.php?action=point_rdv&place=La_poterie&id=<?= $id ?>" class="btn btn-outline-dark m-3">La poterie</a></div>
            </div>
        <?php endif; ?>

        <!--2 Affichage du point de RDV -->
        <?php if (isset($_SESSION['newOrder'][0]['delivery']) && isset($_SESSION['newOrder'][0]['point_rdv'])):?>
            <h4>2- RDV</h4>
            <p><span class="badge bg-success">Point de rendez-vous : <?= $_SESSION['newOrder'][0]['point_rdv'] ?></span></p>
        <!--2 OU si c'est à votre adresse récupérer adresse dans la session -->
        <?php elseif(isset($_SESSION['newOrder'][0]['delivery_adress'])): ?>
            <h4>2- RDV</h4>
            <p><span class="badge bg-success">Adresse : <?= $_SESSION['newOrder'][0]['adress'] ?></span></p>
        <?php endif;?>


        <!--3 Livraison -->
        <?php if(isset($_SESSION['newOrder'][0]['delivery_adress']) && !isset($_SESSION['newOrder'][0]['delivery_price'])): ?>
            <a href="cart.php?action=delivery_price&id=<?= $id ?>" class="btn btn-dark">Choisir le tarif de livraison</a>
            <a href="cart.php?action=reset&mode=delivery_adress&id=<?= $id ?>"><button type="button" class="btn btn-outline-danger">Retour</button></a>
        <?php endif; ?>
        <!--3 Prix de la livraison -->
        <?php if(isset($_GET['action']) && $_GET["action"] == "delivery_price" && !isset($_SESSION['newOrder'][0]['delivery_price'])): ?>
            <div class="d-flex">
                <div><a href="cart.php?action=delivery_price&price=3&id=<?= $id ?>" class="btn btn-outline-dark m-3">3 €</a></div>
                <div><a href="cart.php?action=delivery_price&price=6&id=<?= $id ?>" class="btn btn-outline-dark m-3">6 €</a></div>
            </div>
        <?php endif; ?>

        <!-- Affichage du point de RDV -->
        <?php if (isset($_SESSION['newOrder'][0]['delivery_price']) && isset($_SESSION['newOrder'][0]['adress'])):?>
            <h4>3- Prix</h4>
        <!-- Si c'est à votre adresse récupérer adresse dans la session -->
            <p><span class="badge bg-success">Price : <?= $_SESSION['newOrder'][0]['delivery_price'] ?></span></p>
        <?php endif;?>


        <!--4 Paiement -->
        <?php if(isset($_SESSION['newOrder'][0]['delivery_price']) && !isset($_SESSION['newOrder'][0]['payment'])): ?>
            <a href="cart.php?action=payment&id=<?= $id ?>" class="btn btn-dark">Choisir un moyen de paiement</a>
            <a href="cart.php?action=reset&mode=delivery_price&id=<?= $id ?>"><button type="button" class="btn btn-outline-danger">Retour</button></a>
        <?php elseif(isset($_SESSION['newOrder'][0]['delivery'],$_SESSION['newOrder'][0]['point_rdv']) && !isset($_SESSION['newOrder'][0]['payment'])): ?>
            <a href="cart.php?action=payment&id=<?= $id ?>" class="btn btn-dark">Choisir un moyen de paiement</a>
            <a href="cart.php?action=reset&mode=point_rdv&id=<?= $id ?>"><button type="button" class="btn btn-outline-danger">Retour</button></a>
        <?php endif; ?>

        <!--4 choix paiement -->
        <?php if(isset($_SESSION['newOrder'][0]['delivery_price']) && isset($_GET['action']) && $_GET["action"] == "payment" && !isset($_SESSION['newOrder'][0]['payment'])): ?>
            <div class="d-flex">
                <div><a href="cart.php?action=payment&means=cb&id=<?= $id ?>" class="btn btn-outline-dark m-3">Carte Bancaire</a></div>
                <div><a href="cart.php?action=payment&means=cash&id=<?= $id ?>" class="btn btn-outline-dark m-3">Espèces</a></div>
            </div>
        <?php elseif(isset($_SESSION['newOrder'][0]['delivery']) && isset($_GET['action']) && $_GET["action"] == "payment" && !isset($_SESSION['newOrder'][0]['payment'])): ?>
            <div class="d-flex">
                <div><a href="cart.php?action=payment&means=cb&id=<?= $id ?>" class="btn btn-outline-dark m-3">Carte Bancaire</a></div>
                <div><a href="cart.php?action=payment&means=cash&id=<?= $id ?>" class="btn btn-outline-dark m-3">Espèces</a></div>
            </div>
        <?php endif; ?>

        <!--4 Affichage du paiement -->
        <?php if (isset($_SESSION['newOrder'][0]['payment'])):?>
            <h4>4- Paiement</h4>
            <p><span class="badge bg-success">Price : <?= $_SESSION['newOrder'][0]['payment'] ?></span></p>
        <?php endif;?>


        <!--5 Commentaires -->
        <?php if(isset($_SESSION['newOrder'][0]['payment']) && !isset($_SESSION['newOrder'][0]['payment'])): ?>
            <a href="cart.php?action=comment&id=<?= $id ?>" class="btn btn-dark">Suivant</a>
        <?php endif; ?>

        <!--5 Envoie de toutes les options de la commande -->
        <?php if(isset($_SESSION['newOrder'][0]['payment'])): ?>
            <div class="d-flex">
                <form method="POST">
                    <input type="hidden" class="form-control" name="hours" value="<?=(isset($_SESSION["newOrder"][0]['delivery']))? $_SESSION["newOrder"][0]['delivery'] : null ?>">
                    <input type="hidden" class="form-control" name="delivery_adress" value="<?=(isset($_SESSION["newOrder"][0]['delivery_adress']))? $_SESSION["newOrder"][0]['delivery_adress'] : $_SESSION["newOrder"][0]['point_rdv'] ?>">
                    <input type="hidden" class="form-control" name="delivery_price" value="<?=(isset($_SESSION["newOrder"][0]['delivery_price']))? $_SESSION["newOrder"][0]['delivery_price'] : null ?>">
                    <input type="hidden" class="form-control" name="payment" value="<?=(isset($_SESSION["newOrder"][0]['payment']))? $_SESSION["newOrder"][0]['payment'] : null ?>">
                    <input type="hidden" class="form-control" name="sum" value="<?= (isset($_SESSION['newOrder'][0]['sum']))? $_SESSION['newOrder'][0]['sum'] : 0 ; ?>">
                    <div class="mb-3">
                        <h4>5- Commentaires</h4>
                        <div class="mb-3">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" cols="6" name="comment" placeholder="Faire un commentaire"><?= (isset($_SESSION['newOrder'][0]['validation']['comment']))? $_SESSION['newOrder'][0]['validation']['comment'] : null ; ?></textarea>
                        </div>
                    </div>
                    <div class="flex">
                        <input type="submit" class="btn btn-dark" name="new_order" value="Valider la commande">
                        <a href="cart.php?action=reset&mode=payment&id=<?= $id ?>"><button type="button" class="btn btn-outline-danger">Retour</button></a>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<?php require_once('../templates/layout/footerAdmin.php');?>