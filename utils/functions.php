<?php

function findAll($table, $pdo)
{
    require_once('../connection.php');
    $sql = "SELECT * FROM $table";
    $query = $pdo->query($sql);
    return $query->fetchAll();
}

function findOneById($table, $pdo, $id)
{
    require_once('../connection.php');
    $sql = "SELECT * FROM $table WHERE id_customer=".$id;
    $query = $pdo->query($sql);
    return $query->fetchAll();
}

function findIdInTable($array, $searchName)
{
    $id = '';
    foreach ($array as $category) {
       if($category['name_category'] == $searchName){
           $id = $category['id_category'];
       }
    }
    return $id;
}


function isFieldValid($field)
{
    if(isset($_POST[$field]) && !empty($_POST[$field])){
        return strip_tags($_POST[$field]);
    }
}


function updateStock($table, $name, $quantity, $pdo)
{
    require_once('../connection.php');
    $data = [
        'name' => $name,
        'quantity' => $quantity
    ];

    $sql = "UPDATE ".$table." SET stock =:quantity WHERE name=:name";
    $query= $pdo->prepare($sql);
    return $query->execute($data);
    
}


function addArticleInSession($article, $nameTable)
{

    if(isset($_POST[$article]) && $_POST[$article] > 0){
        unset($_SESSION['newOrder'][0][$nameTable][$article]);
        unset($_SESSION['newOrder'][0][$nameTable][$article.'_price']);
        $_SESSION['newOrder'][0][$nameTable][$article] = $_POST[$article];
        $_SESSION['newOrder'][0][$nameTable][$article.'_price'] = $_POST[$article.'_price'];
        $_SESSION['newOrder'][0]['commande'] = true; 
    }

    if(isset($_POST[$article]) && $_POST[$article] == 0){
        unset($_SESSION['newOrder'][0][$nameTable][$article]);
        unset($_SESSION['newOrder'][0][$nameTable][$article.'_price']);
        $_SESSION['newOrder'][0]['commande'] = true; 
    }

}


function gestionStock($table, $rang, $name, $pdo)
{
    require_once('../connection.php');
    if(isset($_SESSION['newOrder'][0][$table][$name]) && $_SESSION[$table][$rang]['stock']){
        $_SESSION[$table][$rang]['stock'] -= $_SESSION['newOrder'][0][$table][$name];
        $tmp_valeur =  $_SESSION[$table][$rang]['stock'];
        updateStock($table, $name,$tmp_valeur, $pdo);
    }
        
}

function alertHtmlWarning($alert)
{
    $html = '';
    $html .= '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">';
    $html .= $alert;
    $html .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    $html .= '</div>';
    return $html;
}


function alertHtmlWarningStock($alert)
{
    $html = '';
    $html .= '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">';
    $html .= $alert;
    $html .= '<button type="button" class="btn-close" aria-label="Close"></button>';
    $html .= '</div>';
    return $html;
}

function alertHtmlSuccess($alert)
{
    $html = '';
    $html .= '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">';
    $html .= $alert;
    $html .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    $html .= '</div>';
    return $html;
}

function showDateDelivery($add_minutes = 0, $format)
{
    $time = "";
    // Récupérer la date au bon format
    // Ajouter  minutes
    $minutes_to_add = $add_minutes;
    date_default_timezone_set("Europe/Paris");
    $time = new DateTime();
    if($minutes_to_add > 0){
        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
    }
    $stamp = date_format($time, $format);
    
    return $stamp;

}


function tableException()
{
    return ['id_customer', 'lastname', 'firstname', 'phone', 'email', 'adress', 'codepostal', 'city', 'created', 'nb_orders','time','commande', 'delivery', 'point_rdv','delivery_adress','delivery_price', 'payment','validation','comment', 'sum', 'alert'];
}


function lastIdFromOrders($pdo)
{
    $orders = findAll('orders', $pdo);
    for($i = 0; $i < count($orders); $i++){
        $nb_commande = $orders[$i]['id_order'];
    }

    return $nb_commande;
}