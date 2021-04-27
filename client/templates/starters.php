<div class="container d-flex">
    <div class="container">
        <form method="post">
            <div class="row invisible"  id="block-starters"> 
                <?php foreach($_SESSION['starters'] as $index =>  $starter): ?>
                <div class="col-sm" id="starters">
                    <?php if($starter['stock'] > 0): ?>
                    <div class="card my-3 text-center" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/checked.svg" alt="Plus"><small> En stock: </small><?= $starter['stock'] ?></strong>
                                <h5 class="card-title m-4"><?= ucfirst($starter['name']) ?></h5>
                            <img src="../assets/img/plus.svg" class="startersBtnPlus" id="startersBtnPlus<?= $index; ?>" alt="icones plus" role="button">
                                <input type="text" id="startersQuantity<?= $index ?>" class="text-center" size="2" name="<?= $starter['name']?>" min="0" value="<?= $starter['quantity']; ?>">
                                <input type="hidden" id="startersPrice<?= $index ?>" class="text-center" size="2" name="<?= $starter['name'].'_price'?>" value="<?= $starter['price']; ?>">
                            <img src="../assets/img/minus.svg" class="startersBtnMinus" id="startersBtnMinus<?= $index; ?>" alt="icones moins"  role="button">
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card my-3 text-center bg-secondary" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/remove.svg" alt="Plus"><small> En rupture: </small><?= $starter['stock'] ?></strong>
                            <p><strong><?= ucfirst($starter['name']) ?></strong></p>
                            <form class="m-4" method="post" id="noStock">
                                <input type="hidden" name="name" value="<?= $starter['name'] ?>">
                                <input type="number" id="startersQuantity<?= $index ?>" class="form-control mt-3 text-center"  name="quantity" min="1" value="1"/> 
                                <button class="btn btn-warning btn-sm my-1" type="submit" name="startersStock" value="reload">Remettre</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <input type="submit" class="btn btn-dark" value="valider" name="starters">
        </form>
        </div>
    </div>
</div>
<script>

// Le tableau de starters
const starters = document.querySelectorAll('#starters');
const btnStarters = document.querySelector("#btn-starters");
const blockStarters = document.querySelector("#block-starters");


btnStarters.addEventListener("click", () => {
  btnStarters.classList.toggle("active");
  blockStarters.classList.toggle("invisible");
});

addQuantity("starters");
minusQuantity("starters");

</script>
