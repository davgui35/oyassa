<div class="container d-flex">
    <div class="container">
        <form method="post">
            <div class="row invisible"  id="block-sauces">
                <?php foreach($_SESSION['sauces'] as $index =>  $sauces): ?>
                <div class="col-sm" id="sauces">
                    <?php if($sauces['stock'] > 0): ?>
                    <div class="card my-3 text-center" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/checked.svg" alt="Plus"><small> En stock: </small><?= $sauces['stock'] ?></strong>
                                <h5 class="card-title m-4"><?= ucfirst($sauces['name']) ?></h5>
                            <img src="../assets/img/plus.svg" class="saucesBtnPlus" id="saucesBtnPlus<?= $index; ?>" alt="icones plus" role="button">
                                <input type="text" id="saucesQuantity<?= $index ?>" class="text-center" size="2" name="<?= $sauces['name']?>" min="0" value="<?= $sauces['quantity']; ?>">
                                <input type="hidden" id="saucesPrice<?= $index ?>" class="text-center" size="2" name="<?= $sauces['name'].'_price'?>" value="<?= $sauces['price']; ?>">
                            <img src="../assets/img/minus.svg" class="saucesBtnMinus" id="saucesBtnMinus<?= $index; ?>" alt="icones moins"  role="button">
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card my-3 text-center bg-secondary" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/remove.svg" alt="Plus"><small> En rupture: </small><?= $sauces['stock'] ?></strong>
                            <p><strong><?= ucfirst($sauces['name']) ?></strong></p>
                            <form class="m-4" method="post" id="noStock">
                                <input type="hidden" name="name" value="<?= $sauces['name'] ?>">
                                <input type="number" id="saucesQuantity<?= $index ?>" class="form-control mt-3 text-center"  name="quantity" min="1" value="1" />   
                                <button class="btn btn-warning btn-sm my-1" type="submit" name="saucesStock" value="reload">Remettre</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <input type="submit" class="btn btn-dark" value="valider" name="sauces">
        </form>
        </div>
    </div>
</div>
<script>

// Le tableau de sauces
const sauces = document.querySelectorAll('#sauces');
const btnSauces = document.querySelector("#btn-sauces");
const blockSauces = document.querySelector("#block-sauces");



btnSauces.addEventListener("click", () => {
  btnSauces.classList.toggle("active");
  blockSauces.classList.toggle("invisible");
});

addQuantity("sauces");
minusQuantity("sauces");

</script>