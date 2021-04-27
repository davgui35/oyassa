function addQuantity(table) {
  // Les boutons plus
  document.querySelectorAll("." + table + "BtnPlus").forEach(element => {
    element.addEventListener("click", e => {
      let idPLus = element.getAttribute("id");
      let indexPlus = idPLus.slice(-1);
      document.querySelector("#" + table + "Quantity" + indexPlus).value++;
    });
  });
}

function minusQuantity(table) {
  // Les boutons moins
  document.querySelectorAll("." + table + "BtnMinus").forEach(element => {
    element.addEventListener("click", e => {
      let idMinus = element.getAttribute("id");
      let indexMinus = idMinus.slice(-1);
      if (
        document.querySelector("#" + table + "Quantity" + indexMinus).value > 0
      ) {
        document.querySelector("#" + table + "Quantity" + indexMinus).value--;
      }
    });
  });
}
