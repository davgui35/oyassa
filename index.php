<?php 
session_start();
if(isset($_POST) && !empty($_POST)){
    // print_r($_POST); 
    $_SESSION['alert'] = [];

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

        $name = strip_tags($_POST['name']);
        strtolower($name);
        $password = $_POST['password'];
        $status = $_POST['status'];

        require_once('./connection.php');
        $sql = "SELECT * FROM users WHERE name =:name and password=:password and status=:status";
        $query = $pdo->prepare($sql);
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);
        $query->bindValue(':status', $status, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch();
        // print_r($user); die;

        if(!$user) {
            $errors['user'] = "Vérifiez votre nom, votre mot de passe et votre espace.";

        }else{
            if(isset($status) && $status == 'admin'){

                //On stocke dans $_SESSION les infos de l'admin
                $_SESSION['admin'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'password' => $user['password'],
                    'status' => $user['status']
                ];
                $_SESSION['admin']['connexion'] = "Bienvenue ". $_SESSION['admin']['name']; 
                // var_dump($_SESSION);On redirige vers la page de profil si il est connecté
                header('Location: admin/admin.php');
            }else{
                //On stocke dans $_SESSION les infos de l'utilisateur
                $_SESSION['user_admin'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'password' => $user['password'],
                    'status' => $user['status']
                ];
                $_SESSION['user_admin']['connexion'] = "Bienvenue ". $_SESSION['user_admin']['name']; 
                // var_dump($_SESSION);On redirige vers la page de profil si il est connecté
                header('Location: user/user.php');
            }
        }
        
    }

    // var_dump($errors);
}
?>
<?php require_once('./templates/layout/header.php');?>
<link rel="stylesheet" href="assets/css/style.css">

<div class="container col-md-4 my-5">
    <div class="col-sm m-5 text-center">
      <img src="assets/img/logo-Oyassa.svg" width="300px" alt="logo Oyassa">
    </div>
    <div class="col-sm m-5">
    <?php if(isset($errors['user']) && !empty($errors['user'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= $errors['user'];?>
            </div>
        <?php endif; ?>
        <?php if(isset($errors['success']) && !empty($errors['success'])): ?>
            <div class="alert alert-success" role="alert">
                <?= $errors['success'];?>
            </div>
        <?php endif; ?>
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
        <span class="badge bg-warning text-dark">Statut :</span>
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
        <button type="submit" class="btn btn-warning mt-2 border rounded-pill">Se connecter</button>
    </form>
    </div>
</div>
<?php require_once('./templates/layout/footer.php');?>