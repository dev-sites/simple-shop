var inputEl = document.getElementsByClassName('input-field');
for (var i = 0; i < inputEl.length; i++) {
  inputEl[i].addEventListener("focus", focusedPlaceholder);
  inputEl[i].addEventListener('blur', blurredPlaceholder);
}


function focusedPlaceholder(e) {
  var targetElement = e.target;
  console.log(targetElement);
  targetElement.parentElement.children[2].className = "border border-focused";
  targetElement.parentElement.children[0].className = "input-placeholder input-placeholder-focused";
}

function blurredPlaceholder(e) {
  var targetElement = e.target;
  if (!targetElement.value) {
    targetElement.parentElement.children[0].className = "input-placeholder input-placeholder-blurred";
  } else {
    targetElement.parentElement.children[0].className = "input-placeholder input-placeholder-blurred-full";
  }
  targetElement.parentElement.children[2].className = "border border-blurred";

}
