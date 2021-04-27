<?php require_once('../templates/layout/headerAdmin.php');?>
<?php
if(isset($_POST) && !empty($_POST)){
    // print_r($_POST);
    $errors = [];
    
    if(empty($_POST['name'])){
        $errors['name'] = 'Vous devez renseigner votre nom';
    }
    
    if(empty($_POST['password'])){
        $errors['pass'] = 'Vous devez renseigner votre mot de passe';
    }
    
    if(!isset($_POST['status'])){
        $errors['status'] = 'Vous devez renseigner votre statut';
    }
    
    if(empty($errors)){
        //On enregistre en BDD
        require_once('../connection.php');
        $name = strip_tags($_POST['name']);
        strtolower($name);
        $password = $_POST['password'];
        $status = strip_tags($_POST['status']);
        strtolower($status);

        $sql = "INSERT INTO users (name, password, status) VALUES (:name, :password, :status)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);
        $query->bindValue(':status', $status, PDO::PARAM_STR);

        if ($query->execute()){
            if($query->rowCount() == 1){
                $_SESSION['alert']['newUser'] = "Vous venez de rajouter un nouvel utilisateur!!"; 
                header('Location: admin.php');
            }
        }
        else{
            $_SESSION['alert']['newUser'] = "Une erreur n'a pas permis de rajouter votre nouvel utilisateur!"; 
        }
    }

}
?>

<!-- Ajout admin -->
<h1 class="text-center m-3">Ajout d'un utilisateur</h1>
<div class="container col-md-4 my-5">
    <div class="row justify-content-md-center ">
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($_POST['name'])? $_POST['name']: null; ?>">
            <span class="badge bg-danger my-2"><?= (isset($errors['name']))? $errors['name'] : null ?></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
            <span class="badge bg-danger my-2"><?= (isset($errors['pass']))? $errors['pass'] : null ?></span>
        </div>
        <span class="badge bg-dark">Statut :</span>
        <span class="badge bg-danger my-2"><?= (isset($errors['status']))? $errors['status'] : null ?></span>
        <div class="d-flex">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="admin" name="status">
                <label class="form-check-label" for="flexCheckChecked">
                    Admin
                </label>
            </div>
            <div class="form-check mb-3 mx-3">
                <input class="form-check-input" type="checkbox" value="user" name="status">
                <label class="form-check-label" for="flexCheckChecked">
                    Employé
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-dark mt-2" onclick="confirm('êtes-vous sûr d\'enregistrer cet utilisateur?')">Ajouter</button>
    </form>
    </div>
</div>

<?php require_once('../templates/layout/footerAdmin.php');?>