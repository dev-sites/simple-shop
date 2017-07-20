var accordionButton = document.getElementsByClassName('add-product-accordion')[0];
var addProductForm = document.getElementsByClassName('add-product-form')[0];
accordionButton.addEventListener('click', toggleForm);
var products = document.getElementsByClassName('product');
for (var i = 0; i < products.length; i++) {
  products[i].addEventListener('click', toggleInfo);
};

function toggleForm() {
  addProductForm.classList.toggle('hidden');
  accordionButton.classList.toggle('add-product-accordion-focused');
}

function toggleInfo() {
  this.children[0].parentNode.classList.toggle('product-focused');
  this.children[0].classList.toggle('fa-plus');
  this.children[0].classList.toggle('fa-minus');
  this.children[2].classList.toggle('hidden');
}
