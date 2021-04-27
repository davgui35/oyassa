
<?php require_once('../templates/layout/headerAdmin.php');
    require_once('../connection.php');
    $categories = findAll('categories', $pdo);
    $cardMeals = [
        "starters" => findAll('starters',$pdo),
        "snacks" => findAll('snacks',$pdo),
        "grills" => findAll('grills',$pdo),
        "meals" => findAll('meals',$pdo),
        "accompaniments" => findAll('accompaniments',$pdo),
        "sauces" => findAll('sauces',$pdo),
        "desserts" => findAll('desserts',$pdo),
        "drinks" => findAll('drinks',$pdo),
        "menus" => findAll('menus',$pdo)
    ];
    // var_dump($categories;
    $errors = [];
    $_SESSION['modified'] = [];
    $name_category = '';
    $table = '';


    if(isset($_POST['name_category']) && !empty($_POST['name_category']) && $_POST['name_category'] != 'Choisir la catégorie' && isset($_POST['category']) && !empty($_POST['category'])){

        //Récupération du nom de la catégorie
        $_SESSION["modified"]['category'] = $_POST["name_category"];
        if(isset($_SESSION["modified"]['category']) && $_SESSION["modified"]['category'] != 'Choisir la catégorie'){
            $slug = "id_". $_SESSION["modified"]['category'];
            $slug = substr($slug, 0, -1);
            $_SESSION["modified"]['meals'] = $cardMeals[$_POST["name_category"]];
        }
        // var_dump($_POST);
    }
    else{
        $errors['choose'] = "Veuillez faire un choix de catégorie";
    }

    if(isset($_POST['table']) && !empty($_POST['table'])){

        //Récupération du nom du plat;
        // var_dump($_POST);
        //Récupération de la clé dynamique du tableau POST
        $id = array_key_first($_POST);
        // echo $id;
        $meal = [];
        $table = strip_tags($_POST['table']);
    
        foreach($cardMeals[$_POST["table"]] as $meals){
            if($meals[$id] == $_POST[$id]) {
                $meal = $meals;
        }
        }
    }
    else{
        $errors['choose'] = "Veuillez faire un choix de plat";
    }

    if(isset($_POST["form_modified"]) && !empty($_POST['form_modified'])){
        // var_dump($_POST);
        $id_table = array_key_first($_POST);
        $sql = "UPDATE `$table` SET name=:name, price=:price, quantity=:quantity, stock=:stock, id_category=:id_category, status=:status WHERE `$id_table`=:id";
        //prepare query 
        $query = $pdo->prepare($sql);
        //values post
        $id = $_POST[$id_table];
        $name = strip_tags(str_replace(' ', '_',strip_tags($_POST['name'])));
        $price = strip_tags($_POST["price"]);
        $quantity = strip_tags($_POST["quantity"]);
        $stock = strip_tags($_POST["stock"]);
        $id_category = strip_tags($_POST["id_category"]);
        $id_category = substr($id_category, 0, 1);
        $status = strip_tags($_POST["status"]);

        // //bind the parameters
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':price', $price, PDO::PARAM_STR);
        $query->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $query->bindValue(':stock', $stock, PDO::PARAM_INT);
        $query->bindValue(':id_category', $id_category, PDO::PARAM_INT);
        $query->bindValue(':status', $status, PDO::PARAM_INT);

        if($query->execute()){
        $_SESSION['admin']['alert'] = "La modification du plat a été prise en compte avec succès!";
        header('Location: admin.php');
        }
        else{
        $_SESSION['modified']['error'] = "Votre modification n'a pu aboutir!!";
        }
    }

    if(isset($_POST["form_delete"])){
        $name = strip_tags($_POST['name']);
        $table = $_POST['table'];
        $sql = "DELETE FROM $table WHERE `name`=:name";
        $query = $pdo->prepare($sql);
        $query->bindValue(':name', $name, PDO::PARAM_STR);

        if($query->execute()){
            $_SESSION['admin']['alert'] = "La suppression du plat a été prise en compte avec succès!";
            header('Location: admin.php');
        }
        else{
        $_SESSION['modified']['error'] = "Votre suppression n'a pu aboutir!!";
        }
    }

// var_dump($_POST);
?>

<h1 class="text-center m-5">Modifier ou supprimer un repas</h1>
<div class="container col-md-4 my-4">
<?php if (isset($_SESSION['modified']['error']) && !empty($_SESSION['modified']['error'])):?>
    <?= alertHtmlWarning($_SESSION['modified']) ?>
    <?php unset($_SESSION['modified']['error']);?>
<?php endif;?>
<?php if (!isset($_SESSION["modified"]['category']) && !isset($_SESSION['modified']['meals']) && !isset($meals)): ?>
    <form method="POST">
        <div class="mb-3">
            <label for="name_category" class="form-label">Catégories</label>
            <select class="form-select" aria-label="Default select example" name="name_category" onchange="myForm.submit()">
                <option selected>Choisir la catégorie</option>
                    <?php foreach ($categories as $category):?>
                        <option value="<?= $category['name_category'] ?>"><?= $category['name_category'] ?></option>
                    <?php endforeach;?>
            </select>
            <span class="badge bg-danger my-2"><?= (isset($errors['choose']))? $errors['choose'] : null ?></span>
        </div>
        <button type="submit" class="btn btn-dark mt-2" name="category" value="category" >Suivant</button>
        <a href="../admin/updateMeal.php" class="btn btn-danger mt-2">Retour</a>
    </form>
<?php endif;?>

<!-- Choix du plat si catégories -->
<?php if (isset($_SESSION["modified"]['category'])): ?>
    <form method="POST">
        <div class="mb-3">
            <label for="plat" class="form-label">Plats</label>
            <select class="form-select" aria-label="Default select example" name="<?= $slug ?>" id="plat">
                    <?php foreach ($_SESSION["modified"]['meals'] as $meal):?>
                        <option value="<?= $meal[$slug] ?>"><?= $meal['name'] ?></option>
                    <?php endforeach;?>
            </select>
            <span class="badge bg-danger my-2"><?= (isset($errors['choose']))? $errors['choose'] : null ?></span>
        </div>
        <button type="submit" class="btn btn-dark mt-2" name="table" value="<?= $_SESSION["modified"]['category']; ?>">Suivant</button>
        <a href="../admin/updateMeal.php" class="btn btn-danger mt-2">Retour</a>
    </form>
<?php endif; ?>

<?php if (isset($meal) && !isset($_SESSION["modified"]['category'])):?>
    <form method="POST">
        <input type="hidden" name="<?= array_key_first($meal) ?>" value="<?= $meal[array_key_first($meal)] ?>">
        <input type="hidden" name="table" value="<?= $table ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name </label>
            <input type="text" class="form-control" id="name" name="name" value="<?= str_replace('_', ' ',strip_tags($meal['name'])); ?>">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price </label>
            <input type="text" class="form-control" id="price" name="price" min="0" value="<?= $meal['price'] ?>">
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity </label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="0" value="<?= $meal['quantity'] ?>">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock </label>
            <input type="number" class="form-control" id="stock" name="stock" min="0" value="<?= $meal['stock'] ?>">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Categorie </label>
            <input type="text" class="form-control" id="id_category" name="id_category" min="0" value="<?= $meal['id_category'] . ' | ' .$table ?>">
            <span class="badge bg-danger my-2">Informations: Valeurs de categories</span>
        </div>
        <div class="mb-3">
            <label for="statut" class="form-label">Statut </label>
            <input type="number" class="form-control" id="status" name="status" min="0" max="1" value="<?= $meal['status'] ?>">
        </div>
        <button type="submit"  class="btn btn-warning mt-2" name="form_modified" value="modified">Modifier</button>
        <a href="../admin/updateMeal.php" class="btn btn-dark mt-2">Retourner au début</a>
        <button type="submit"  class="btn btn-danger mt-2" name="form_delete" value="delete" onclick="confirm('Attention, vous êtes sur le point de SUPPRIMER ce plat!!!')">Supprimer</button>
    </form>
<?php endif;?>

</div>

<?php require_once('../templates/layout/footerAdmin.php');?>
