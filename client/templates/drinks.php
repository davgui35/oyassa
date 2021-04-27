<div class="container d-flex">
    <div class="container">
        <form method="post">
            <div class="row invisible"  id="block-drinks">
                <?php foreach($_SESSION['drinks'] as $index =>  $drinks): ?>
                <div class="col-sm" id="drinks">
                    <?php if($drinks['stock'] > 0): ?>
                    <div class="card my-3 text-center" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/checked.svg" alt="Plus"><small> En stock: </small><?= $drinks['stock'] ?></strong>
                                <h5 class="card-title m-4"><?= ucfirst($drinks['name']) ?></h5>
                            <img src="../assets/img/plus.svg" class="drinksBtnPlus" id="drinksBtnPlus<?= $index; ?>" alt="icones plus" role="button">
                                <input type="text" id="drinksQuantity<?= $index ?>" class="text-center" size="2" name="<?= $drinks['name']?>" min="0" value="<?= $drinks['quantity']; ?>">
                                <input type="hidden" id="drinksPrice<?= $index ?>" class="text-center" size="2" name="<?= $drinks['name'].'_price'?>" value="<?= $drinks['price']; ?>">
                            <img src="../assets/img/minus.svg" class="drinksBtnMinus" id="drinksBtnMinus<?= $index; ?>" alt="icones moins"  role="button">
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card my-3 text-center bg-secondary" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/remove.svg" alt="Plus"><small> En rupture: </small><?= $drinks['stock'] ?></strong>
                            <p><strong><?= ucfirst($drinks['name']) ?></strong></p>
                            <form class="m-4" method="post" id="noStock">
                                <input type="hidden" name="name" value="<?= $drinks['name'] ?>">
                                <input type="number" id="drinksQuantity<?= $index ?>" class="form-control mt-3 text-center"  name="quantity" min="1" value="1"/>   
                                <button class="btn btn-warning btn-sm my-1" type="submit" name="drinksStock" value="reload">Remettre</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <input type="submit" class="btn btn-dark" value="valider" name="drinks">
        </form>
        </div>
    </div>
</div>
<script>

// Le tableau de drinks
const drinks = document.querySelectorAll('#drinks');
const btnDrinks = document.querySelector("#btn-drinks");
const blockDrinks = document.querySelector("#block-drinks");


btnDrinks.addEventListener("click", () => {
  btnDrinks.classList.toggle("active");
  blockDrinks.classList.toggle("invisible");
});

addQuantity("drinks");
minusQuantity("drinks");

</script>