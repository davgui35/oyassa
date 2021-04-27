<div class="container d-flex">
    <div class="container">
        <form method="post">
            <div class="row invisible"  id="block-menus">
                <?php foreach($_SESSION['menus'] as $index =>  $menus): ?>
                <div class="col-sm" id="menus">
                    <?php if($menus['stock'] > 0): ?>
                    <div class="card my-3 text-center" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/checked.svg" alt="Plus"><small> En stock: </small><?= $menus['stock'] ?></strong>
                                <h5 class="card-title m-4"><?= ucfirst($menus['name']) ?></h5>
                            <img src="../assets/img/plus.svg" class="menusBtnPlus" id="menusBtnPlus<?= $index; ?>" alt="icones plus" role="button">
                                <input type="text" id="menusQuantity<?= $index ?>" class="text-center" size="2" name="<?= $menus['name']?>" min="0" value="<?= $menus['quantity']; ?>">
                                <input type="hidden" id="menusPrice<?= $index ?>" class="text-center" size="2" name="<?= $menus['name'].'_price'?>" value="<?= $menus['price']; ?>">
                            <img src="../assets/img/minus.svg" class="menusBtnMinus" id="menusBtnMinus<?= $index; ?>" alt="icones moins"  role="button">
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card my-3 text-center bg-secondary" style="width: 18rem;">
                        <div class="card-body">
                            <strong><img src="../assets/img/remove.svg" alt="Plus"><small> En rupture: </small><?= $menus['stock'] ?></strong>
                            <p><strong><?= ucfirst($menus['name']) ?></strong></p>
                            <form class="m-4" method="post" id="noStock">
                                <input type="hidden" name="name" value="<?= $menus['name'] ?>">
                                <input type="number" id="menusQuantity<?= $index ?>" class="form-control mt-3 text-center"  name="quantity" min="1" value="1"/>   
                                <button class="btn btn-warning btn-sm my-1" type="submit" name="menusStock" value="reload">Remettre</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <input type="submit" class="btn btn-dark" value="valider" name="menus">
        </form>
        </div>
    </div>
</div>
<script>

// Le tableau de menus
const menus = document.querySelectorAll('#menus');
const btnMenus = document.querySelector("#btn-menus");
const blockMenus = document.querySelector("#block-menus");


btnMenus.addEventListener("click", () => {
  btnMenus.classList.toggle("active");
  blockMenus.classList.toggle("invisible");
});

addQuantity("menus");
minusQuantity("menus");

</script>