var accordionButton = document.getElementsByClassName('add-product-accordion')[0];
var addProductForm = document.getElementsByClassName('add-product-form')[0];
accordionButton.addEventListener('click', toggleForm);

function toggleForm() {
  if (addProductForm.style.display == "none") {
    addProductForm.style.display = "flex";
    accordionButton.style.backgroundColor = "#2b2d40";
    accordionButton.style.color = "#eee";
  } else {
    addProductForm.style.display = "none";
    accordionButton.style.backgroundColor = "#fff";
    accordionButton.style.color = "#2b2d40";
  }
}
