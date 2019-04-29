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

/* LOGIN ICON NAVIGATION */
let login_menu = document.querySelector(".menu");

if (login_menu) {
  let login_menu_item = login_menu.lastElementChild;
  let login_menu_item_content = login_menu_item.querySelector("a").innerHTML;

  function change_login_icon() {
    if (window.innerWidth > 960) {
      login_menu_item.querySelector("a").innerHTML = "i";
    } else {
      login_menu_item.querySelector("a").innerHTML = login_menu_item_content;
    }
  }

  window.addEventListener("resize", () => {
    change_login_icon();
  });

  change_login_icon();
}
