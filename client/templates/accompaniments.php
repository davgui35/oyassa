<div class="container d-flex">
    <div class="container">
        <form method="post">
            <div class="row invisible"  id="block-accompaniments">
                <?php foreach($_SESSION['accompaniments'] as $index =>  $accompaniments): ?>
                <div class="col-sm" id="accompaniments">
                    <?php if($accompaniments['stock'] > 0): ?>
                    <div class="card my-3 text-center" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/checked.svg" alt="Plus"><small> En stock: </small><?= $accompaniments['stock'] ?></strong>
                                <h5 class="card-title m-4"><?= ucfirst($accompaniments['name']) ?></h5>
                            <img src="../assets/img/plus.svg" class="accompanimentsBtnPlus" id="accompanimentsBtnPlus<?= $index; ?>" alt="icones plus" role="button">
                                <input type="text" id="accompanimentsQuantity<?= $index ?>" class="text-center" size="2" name="<?= $accompaniments['name']?>" min="0" value="<?= $accompaniments['quantity']; ?>">
                                <input type="hidden" id="accompanimentsPrice<?= $index ?>" class="text-center" size="2" name="<?= $accompaniments['name'].'_price'?>" value="<?= $accompaniments['price']; ?>">
                            <img src="../assets/img/minus.svg" class="accompanimentsBtnMinus" id="accompanimentsBtnMinus<?= $index; ?>" alt="icones moins"  role="button">
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card my-3 text-center bg-secondary" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/remove.svg" alt="Plus"><small> En rupture: </small><?= $accompaniments['stock'] ?></strong>
                            <p><strong><?= ucfirst($accompaniments['name']) ?></strong></p>
                            <form class="m-4" method="post" id="noStock">
                                <input type="hidden" name="name" value="<?= $accompaniments['name'] ?>">
                                <input type="number" id="accompanimentsQuantity<?= $index ?>" class="form-control mt-3 text-center"  name="quantity" min="1" value="1"/>   
                                <button class="btn btn-warning btn-sm my-1" type="submit" name="accompanimentsStock" value="reload">Remettre</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <input type="submit" class="btn btn-dark" value="valider" name="accompaniments">
        </form>
        </div>
    </div>
</div>
<script>

// Le tableau de accompaniments
const accompaniments = document.querySelectorAll('#accompaniments');
const btnAccompaniments = document.querySelector("#btn-accompaniments");
const blockAccompaniments = document.querySelector("#block-accompaniments");

btnAccompaniments.addEventListener("click", () => {
  btnAccompaniments.classList.toggle("active");
  blockAccompaniments.classList.toggle("invisible");
});

addQuantity("accompaniments");
minusQuantity("accompaniments");

</script>