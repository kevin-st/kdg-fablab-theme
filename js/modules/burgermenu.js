/*var navknop = document.querySelector(".burgerbtn");
var menureact = document.querySelector("#menu-container");

navknop.addEventListener("click", menuKlik);

function menuKlik(evt) {
  navknop.innerHTML = "--";
  if (menureact.classList) {
    menureact.classList.toggle("zichtbaarheid");
  } else {
    // For IE9
    var classes = menureact.className.split(" ");
    var i = classes.indexOf("zichtbaarheid");

    if (i >= 0)
      classes.splice(i, 1);
    else
      classes.push("zichtbaarheid");
      menureact.className = classes.join(" ");
  }
}
*/

// some example module
class Menu {
  constructor() {
    console.log("Toggle class!");
    var navknop = document.querySelector(".burgerbtn");
    var menureact = document.querySelector("#menu-container");

    navknop.addEventListener("click", menuKlik);

    function menuKlik(evt) {
      navknop.innerHTML = "--";
      if (menureact.classList) {
        menureact.classList.toggle("zichtbaarheid");
      } else {
        // For IE9
        var classes = menureact.className.split(" ");
        var i = classes.indexOf("zichtbaarheid");

        if (i >= 0)
          classes.splice(i, 1);
        else
          classes.push("zichtbaarheid");
          menureact.className = classes.join(" ");
      }
    }
  }
}

export default Menu;
