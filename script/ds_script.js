/* jquerry code required to run 3d carousel */
$(document).ready(function() {
  $(".carousel").carousel();
});

/* SCRIPT  TOGGLE  NAVIGATION  */
function toggle() {
  var nav = document.getElementById("nav");
  nav.classList.toggle("active");
}

/* Javascript event listner waiting for page to load */
window.onload = pageLoader;

/* function called when page loaded */
function pageLoader() {}
