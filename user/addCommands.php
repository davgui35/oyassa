<?php session_start(); ?>
<?php require_once('../templates/layout/headerUser.php');
require_once('../connection.php');
$_SESSION['newOrder'] = [];
$customers = findAll('customers', $pdo);
// var_dump($customers);

if(isset($_POST['isCustomer']) && !empty($_POST['isCustomer']) || isset($_POST['newCustomer']) && !empty($_POST['newCustomer'])){
    // var_dump($_POST);
    //is exist customer
    $errors = [];
    if(isset($_POST['isCustomer'], $_POST['id_customer'])){
        for($i = 0; $i < count($customers); $i++){
            if($_POST['id_customer'] == $customers[$i]['id_customer']){
                if(!in_array($customers[$i]['id_customer'], $_SESSION['newOrder'])){
                    array_push($_SESSION['newOrder'], $customers[$i]);
                    $_SESSION['newOrder'][0]['commande'] = true;
                    $_SESSION['alert'] = 'Vous avez choisi un client existant pour cette nouvelle commande!';
                }
            }
        }
      
    }
    //is new Customer
    if(isset($_POST['newCustomer'])){

        if(!isFieldValid('lastname')){
            $errors['lastname'] = 'Veuillez renseignez le nom du client';
        }
        if(!isFieldValid('firstname')){
            $errors['firstname'] = 'Veuillez renseignez le prénom du client';
        }
        if(!isFieldValid('phone')){
            
            $errors['phone'] = 'Veuillez renseignez le téléphone du client';
        }
        if(!isFieldValid('email')){
            $errors['email'] = "Veuillez renseignez l' email du client";
        }
        if(!isFieldValid('adress')){   
            $errors['adress'] = "Veuillez renseignez l'adresse du client";
        }
        if(!isFieldValid('codepostal')){   
            $errors['codepostal'] = 'Veuillez renseignez le code postal du client';
        }
        if(!isFieldValid('city')){   
            $errors['city'] = 'Veuillez renseignez la ville du client';
        }

        if(empty($errors)){
            $sql = "INSERT INTO customers (lastname, firstname, phone, email, adress, codepostal, city, created) VALUES (:lastname, :firstname, :phone, :email, :adress, :codepostal, :city, NOW())";
            $query = $pdo->prepare($sql);
            $query->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
            $query->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
            $query->bindValue(':phone', $_POST['phone'], PDO::PARAM_STR);
            $query->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $query->bindValue(':adress', $_POST['adress'], PDO::PARAM_STR);
            $query->bindValue(':codepostal', $_POST['codepostal'], PDO::PARAM_INT);
            $query->bindValue(':city', $_POST['city'], PDO::PARAM_STR);
            $query->execute();
        }
        //ON récupère l'id du nouvel utilisateur
        $id = $pdo->lastInsertId();
        $_SESSION['newOrder'] = findOneById('customers', $pdo, $id);
        $_SESSION['alert'] = 'Vous avez créé un nouveau client pour votre nouvelle commande!';
    }

    header('Location: ../user/user.php');
}

?>

<div class="container">
    <h2>Déja client</h2>
    <form class="row g-3 needs-validation" method="POST">
    <div class="col-md-4">
        <label for="validationCustom04" class="form-label">Nom</label>
        <select class="form-select" id="validationCustom04" name="id_customer" >
        <option selected disabled value="">Choisir...</option>
        <?php foreach($customers as $index => $customer): ?>
            <option value="<?= $customer['id_customer'] ?>"><?= $customer['lastname'] . ' ' . $customer['firstname'] ?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div class="col-12">
        <button class="btn btn-dark" type="submit" name="isCustomer" value="isCustomer">Valider</button>
    </div>
    </form>
</div>
<hr>
<div class="container">
    <h2>Nouveau client</h2>
    <form class="row g-3" method="POST">
        <div class="col-md-4">
            <label for="validationServer01" class="form-label">Nom</label>
            <input type="text" class="form-control" id="validationServer01" name="lastname" value="<?= isset($_POST['lastname'])? $_POST['lastname']: null; ?>">
            <span class="badge bg-danger my-2"><?= (isset($errors['lastname']))? $errors['lastname'] : null ?></span>
        </div>
        <div class="col-md-4">
            <label for="validationServer02" class="form-label">Prénom</label>
            <input type="text" class="form-control " id="validationServer02" name="firstname" value="<?= isset($_POST['firstname'])? $_POST['firstname']: null; ?>" >
            <span class="badge bg-danger my-2"><?= (isset($errors['firstname']))? $errors['firstname'] : null ?></span>
        </div>
        <div class="col-md-4">
            <label for="validationServerUsername" class="form-label">Téléphone</label>
            <input type="text" class="form-control " id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" name="phone" value="<?= isset($_POST['phone'])? $_POST['phone']: null; ?>">
            <span class="badge bg-danger my-2"><?= (isset($errors['phone']))? $errors['phone'] : null ?></span>
        </div>
        <div class="col-md-4">
            <label for="validationServer03" class="form-label">Adresse email</label>
            <input type="email" class="form-control " id="validationServer03" aria-describedby="validationServer03Feedback" name="email" value="<?= isset($_POST['email'])? $_POST['email']: null; ?>">
            <span class="badge bg-danger my-2"><?= (isset($errors['email']))? $errors['email'] : null ?></span>
        </div>
        <div class="col-md-4">
            <label for="validationServer03" class="form-label">Adresse postale</label>
            <input type="text" class="form-control " id="validationServer03" aria-describedby="validationServer03Feedback"  name="adress" value="<?= isset($_POST['adress'])? $_POST['adress']: null; ?>">
            <span class="badge bg-danger my-2"><?= (isset($errors['adress']))? $errors['adress'] : null ?></span>
        </div>
        <div class="col-md-4">
            <label for="validationServer03" class="form-label">Code postal</label>
            <input type="text" class="form-control " id="validationServer03" aria-describedby="validationServer03Feedback"  name="codepostal" value="<?= isset($_POST['codepostal'])? $_POST['codepostal']: null; ?>">
            <span class="badge bg-danger my-2"><?= (isset($errors['codepostal']))? $errors['codepostal'] : null ?></span>
        </div>
        <div class="col-md-4">
            <label for="validationServer03" class="form-label">Ville</label>
            <input type="text" class="form-control " id="validationServer03" aria-describedby="validationServer03Feedback"   name="city" value="<?= isset($_POST['city'])? $_POST['city']: null; ?>" >
            <span class="badge bg-danger my-2"><?= (isset($errors['city']))? $errors['city'] : null ?></span>
        </div>
        <div class="col-12">
            <button class="btn btn-dark" type="submit" name="newCustomer" value="newCustomer">Valider le nouveau client</button>
        </div>
    </form>
</div>

<?php require_once('../templates/layout/footerUser.php');?>