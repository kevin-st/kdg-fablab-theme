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
    var navknop = document.querySelector(".burgerbtn");
    var menureact = document.querySelector("#menu-container");
    var img = document.querySelector("#menuimg");
    var img2 = document.querySelector("#menuimg2");


    navknop.addEventListener("click", menuKlik);


    function menuKlik(evt) {
      if (menureact.classList) {
        menureact.classList.toggle("zichtbaarheid");
        img.classList.toggle("zichtbaarheid");
        img2.classList.toggle("zichtbaarheid");
        console.log("Toggle class!");
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
