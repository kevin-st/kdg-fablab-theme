/* imports */
//import Slider from "./modules/slider";
import Menu from "./modules/burgermenu";
import form from "./modules/form-validation";

//var slider = new Slider();
var menu = new Menu();

/* CONTACT PAGE */
let contact_form = document.getElementById("contact-form");

if (contact_form) {
  contact_form.addEventListener("submit", e => {
    if (!form.validate(e.target)) {
      e.preventDefault();
    }
  });
}

/* Login nav */
var loginNav = document.querySelector(".menu").lastElementChild;
loginNav.querySelector("a").innerHTML="i";
