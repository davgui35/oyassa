<div class="container d-flex">
    <div class="container">
        <form method="post">
            <div class="row invisible"  id="block-grills">
                <?php foreach($_SESSION['grills'] as $index =>  $grill): ?>
                <div class="col-sm">
                    <?php if($grill['stock'] > 0): ?>
                    <div class="card my-3 text-center" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/checked.svg" alt="Plus"><small> En stock: </small><?= $grill['stock'] ?></strong>
                                <h5 class="card-title m-4"><?= ucfirst($grill['name']) ?></h5>
                            <img src="../assets/img/plus.svg" class="grillsBtnPlus" id="grillsBtnPlus<?= $index; ?>" alt="icones plus" role="button">
                                <input type="text" id="grillsQuantity<?= $index ?>" class="text-center" size="2" name="<?= $grill['name']?>" min="0" value="<?= $grill['quantity']; ?>">
                                <input type="hidden" id="grillsPrice<?= $index ?>" class="text-center" size="2" name="<?= $grill['name'].'_price'?>" value="<?= $grill['price']; ?>">
                            <img src="../assets/img/minus.svg" class="grillsBtnMinus" id="grillsBtnMinus<?= $index; ?>" alt="icones moins"  role="button">
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card my-3 text-center bg-secondary" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/remove.svg" alt="Plus"><small> En rupture: </small><?= $grill['stock'] ?></strong>
                            <p><strong><?= ucfirst($grill['name']) ?></strong></p>
                            <form class="m-4" method="post" id="noStock">
                                <input type="hidden" name="name" value="<?= $grill['name'] ?>">
                                <input type="number" id="grillsQuantity<?= $index ?>" class="form-control mt-3 text-center"  name="quantity" min="1" value="1"/>   
                                <button class="btn btn-warning btn-sm my-1" type="submit" name="grillsStock" value="reload">Remettre</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <input type="submit" class="btn btn-dark" value="valider" name="grills">
        </form>
        </div>
    </div>
</div>
<script>

// Le tableau de grills
const grills = document.querySelectorAll('#grills');
const btnGrills = document.querySelector("#btn-grills");
const blockGrills = document.querySelector("#block-grills");


btnGrills.addEventListener("click", () => {
  btnGrills.classList.toggle("active");
  blockGrills.classList.toggle("invisible");
});

addQuantity("grills");
minusQuantity("grills");

</script>