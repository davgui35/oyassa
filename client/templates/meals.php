<div class="container d-flex">
    <div class="container">
        <form method="post">
            <div class="row invisible"  id="block-meals">
                <?php foreach($_SESSION['meals'] as $index =>  $meals): ?>
                <div class="col-sm" id="meals">
                    <?php if($meals['stock'] > 0): ?>
                    <div class="card my-3 text-center" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/checked.svg" alt="Plus"><small> En stock: </small><?= $meals['stock'] ?></strong>
                                <h5 class="card-title m-4"><?= ucfirst($meals['name']) ?></h5>
                            <img src="../assets/img/plus.svg" class="mealsBtnPlus" id="mealsBtnPlus<?= $index; ?>" alt="icones plus" role="button">
                                <input type="text" id="mealsQuantity<?= $index ?>" class="text-center" size="2" name="<?= $meals['name']?>" min="0" value="<?= $meals['quantity']; ?>">
                                <input type="hidden" id="mealsPrice<?= $index ?>" class="text-center" size="2" name="<?= $meals['name'].'_price'?>" value="<?= $meals['price']; ?>">
                            <img src="../assets/img/minus.svg" class="mealsBtnMinus" id="mealsBtnMinus<?= $index; ?>" alt="icones moins"  role="button">
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card my-3 text-center bg-secondary" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/remove.svg" alt="Plus"><small> En rupture: </small><?= $meals['stock'] ?></strong>
                            <p><strong><?= ucfirst($meals['name']) ?></strong></p>
                            <form class="m-4" method="post" id="noStock">
                                <input type="hidden" name="name" value="<?= $meals['name'] ?>">
                                <input type="number" id="mealsQuantity<?= $index ?>" class="form-control mt-3 text-center"  name="quantity" min="1" value="1"/>   
                                <button class="btn btn-warning btn-sm my-1" type="submit" name="mealsStock" value="reload">Remettre</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <input type="submit" class="btn btn-dark" value="valider" name="meals">
        </form>
        </div>
    </div>
</div>
<script>

// Le tableau de meals
const meals = document.querySelectorAll('#meals');
const btnMeals = document.querySelector("#btn-meals");
const blockMeals = document.querySelector("#block-meals");


btnMeals.addEventListener("click", () => {
  btnMeals.classList.toggle("active");
  blockMeals.classList.toggle("invisible");
});

addQuantity("meals");
minusQuantity("meals");

</script>