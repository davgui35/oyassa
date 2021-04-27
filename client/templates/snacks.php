<div class="container d-flex">
    <div class="container">
        <form method="post">
            <div class="row invisible"  id="block-snacks">
                <?php foreach($_SESSION['snacks'] as $index =>  $snack): ?>
                <div class="col-sm" id="snacks">
                    <?php if($snack['stock'] > 0): ?>
                    <div class="card my-3 text-center" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/checked.svg" alt="Plus"><small> En stock: </small><?= $snack['stock'] ?></strong>
                                <h5 class="card-title m-4"><?= ucfirst($snack['name']) ?></h5>
                            <img src="../assets/img/plus.svg" class="snacksBtnPlus" id="snacksBtnPlus<?= $index; ?>" alt="icones plus" role="button">
                                <input type="text" id="snacksQuantity<?= $index ?>" class="text-center" size="2" name="<?= $snack['name']?>" min="0" value="<?= $snack['quantity']; ?>">
                                <input type="hidden" id="snacksPrice<?= $index ?>" class="text-center" size="2" name="<?= $snack['name'].'_price'?>" value="<?= $snack['price']; ?>">
                            <img src="../assets/img/minus.svg" class="snacksBtnMinus" id="snacksBtnMinus<?= $index; ?>" alt="icones moins"  role="button">
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card my-3 text-center bg-secondary" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/remove.svg" alt="Plus"><small> En rupture: </small><?= $snack['stock'] ?></strong>
                            <p><strong><?= ucfirst($snack['name']) ?></strong></p>
                            <form class="m-4" method="post" id="noStock">
                                <input type="hidden" name="name" value="<?= $snack['name'] ?>">
                                <input type="number" id="snacksQuantity<?= $index ?>" class="form-control mt-3 text-center"  name="quantity" min="1" value="1"/>   
                                <button class="btn btn-warning btn-sm my-1" type="submit" name="snacksStock" value="reload">Remettre</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <input type="submit" class="btn btn-dark" value="valider" name="snacks">
        </form>
        </div>
    </div>
</div>
<script>

// Le tableau de snacks
const snacks = document.querySelectorAll('#snacks');
const btnSnacks = document.querySelector("#btn-snacks");
const blockSnacks = document.querySelector("#block-snacks");

btnSnacks.addEventListener("click", () => {
  btnSnacks.classList.toggle("active");
  blockSnacks.classList.toggle("invisible");
});

addQuantity("snacks");
minusQuantity("snacks");

</script>