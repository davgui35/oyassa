<div class="container d-flex">
    <div class="container">
        <form method="post">
            <div class="row invisible"  id="block-desserts">
                <?php foreach($_SESSION['desserts'] as $index =>  $desserts): ?>
                <div class="col-sm" id="desserts">
                    <?php if($desserts['stock'] > 0): ?>
                    <div class="card my-3 text-center" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/checked.svg" alt="Plus"><small> En stock: </small><?= $desserts['stock'] ?></strong>
                                <h5 class="card-title m-4"><?= ucfirst($desserts['name']) ?></h5>
                            <img src="../assets/img/plus.svg" class="dessertsBtnPlus" id="dessertsBtnPlus<?= $index; ?>" alt="icones plus" role="button">
                                <input type="text" id="dessertsQuantity<?= $index ?>" class="text-center" size="2" name="<?= $desserts['name']?>" min="0" value="<?= $desserts['quantity']; ?>">
                                <input type="hidden" id="dessertsPrice<?= $index ?>" class="text-center" size="2" name="<?= $desserts['name'].'_price'?>" value="<?= $desserts['price']; ?>">
                            <img src="../assets/img/minus.svg" class="dessertsBtnMinus" id="dessertsBtnMinus<?= $index; ?>" alt="icones moins"  role="button">
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card my-3 text-center bg-secondary" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/remove.svg" alt="Plus"><small> En rupture: </small><?= $desserts['stock'] ?></strong>
                            <p><strong><?= ucfirst($desserts['name']) ?></strong></p>
                            <form class="m-4" method="post" id="noStock">
                                <input type="hidden" name="name" value="<?= $desserts['name'] ?>">
                                <input type="number" id="dessertsQuantity<?= $index ?>" class="form-control mt-3 text-center"  name="quantity" min="1" value="1" />   
                                <button class="btn btn-warning btn-sm my-1" type="submit" name="dessertsStock" value="reload">Remettre</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <input type="submit" class="btn btn-dark" value="valider" name="desserts">
        </form>
        </div>
    </div>
</div>
<script>

// Le tableau de desserts
const desserts = document.querySelectorAll('#desserts');
const btnDesserts = document.querySelector("#btn-desserts");
const blockDesserts = document.querySelector("#block-desserts");



btnDesserts.addEventListener("click", () => {
  btnDesserts.classList.toggle("active");
  blockDesserts.classList.toggle("invisible");
});

addQuantity("desserts");
minusQuantity("desserts");

</script>