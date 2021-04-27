
<?php require_once('../templates/layout/headerAdmin.php');
require_once('../connection.php');
$categories = findAll('categories', $pdo);
// var_dump($categories;
$errors = [];

if(isset($_POST) && !empty($_POST)){
    extract($_POST);
    if(isset($name) && empty($name)){
        $errors['name'] = 'Vous devez renseigner le nom du plat';
    }
    if(isset($price) && empty($price)){
        $errors['price'] = 'Vous devez renseigner le prix du plat';
    }
    if($name_category == "Choisir la catégorie"){
        $errors['name_category'] = 'Vous devez renseigner la catégorie du plat';
    }
    // var_dump($_POST);
    if(empty($errors)){
        // $id_category = '';
        // foreach ($categories as $category) {
        //    if($category['name_category'] ==){
        //        $id_category = $category['id_category'];
        //    }
        // }
        $id_category = findIdInTable($categories, $name_category);

        if($id_category){
            $sql = "INSERT INTO `$name_category` (name, price, quantity, stock, id_category) VALUES (:name, :price, :quantity, :stock, :id_category)";
            $query = $pdo->prepare($sql);
            $query->bindValue(':name', $name, PDO::PARAM_STR);
            $query->bindValue(':price', $price, PDO::PARAM_STR);
            $query->bindValue(':quantity', $quantity, PDO::PARAM_INT);
            $query->bindValue(':stock', $stock, PDO::PARAM_INT);
            $query->bindValue(':id_category', $id_category, PDO::PARAM_INT);

            if ($query->execute()){
                if($query->rowCount() == 1){
                    $_SESSION['alert'] = "Vous venez de rajouter un nouveau repas!!"; 
                    header('Location: admin.php');
                }
            }
            else{
                $_SESSION['alert'] = "Une erreur n'a pas permis de rajouter votre nouveau repas!"; 
            }
            
        }
       
    }
}
?>
<h1 class="text-center m-3">Ajout d'un Repas</h1>
<div class="container col-md-4 my-4">
    <form method="POST">
        <div class="mb-3">
            <label for="categories" class="form-label">Nom du plat</label>
            <select class="form-select" aria-label="Default select example" name="name_category">
                <option selected>Choisir la catégorie</option>
                <?php foreach ($categories as $category):?>
                    <option value="<?= $category['name_category'] ?>"><?= $category['name_category'] ?></option>
                <?php endforeach;?>
                    
            </select>
            <span class="badge bg-danger my-2"><?= (isset($errors['name_category']))? $errors['name_category'] : null ?></span>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nom du plat</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($_POST['name'])? $_POST['name']: null; ?>">
            <span class="badge bg-danger my-2"><?= (isset($errors['name']))? $errors['name'] : null ?></span>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="text" class="form-control" id="price" name="price" value="<?= isset($_POST['price'])? $_POST['price']: 0; ?>">
            <span class="badge bg-danger my-2"><?= (isset($errors['price']))? $errors['price'] : null ?></span>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantité</label>
            <input type="number" class="form-control" min="0" id="quantity" name="quantity" value="<?= isset($_POST['quantity'])? $_POST['quantity']: 0; ?>">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock par défaut</label>
            <input type="number" class="form-control" min="0" id="stock" name="stock" value="<?= isset($_POST['stock'])? $_POST['stock']: 0; ?>">
        </div>
        <button type="submit" class="btn btn-dark mt-2" onclick="confirm('Vous êtes sûr de vouloir créer ce plat?')">Ajouter ce plat</button>
    </form>
</div>

<?php require_once('../templates/layout/footerAdmin.php');?>