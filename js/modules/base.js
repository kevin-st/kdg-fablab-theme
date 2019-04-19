var base = (function() {
  return {
    addClass: (element, className) => {
      if (element.classList) {
        element.classList.add(className);
      }
    },

    hassClass: (element, className) => {
      if (element.classList) {
        return element.classList.contains(className);
      }
    },

    removeClass: (element, className) => {
      if (element.classList) {
        element.classList.remove(className);
      }
    },

    toggleClass: (element, className) => {
      if (element.classList) {
        element.classList.toggle(className);
      }
    }
  };
})();

export default base;
