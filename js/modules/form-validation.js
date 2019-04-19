import base from "./base";

var form = (function() {
  function onError(input_group, input_field) {
    let error_message = input_group.getElementsByClassName("error-message")[0];

    base.addClass(input_field, "error");

    if (base.hassClass(error_message, "disp-n")) {
      base.removeClass(error_message, "disp-n");
    }
  }

  function onSuccess(input_group, input_field) {
    if (base.hassClass(input_field, "error")) {
      let error_message = input_group.getElementsByClassName(
        "error-message"
      )[0];

      base.removeClass(input_field, "error");

      if (!base.hassClass(error_message, "disp-n")) {
        base.addClass(error_message, "disp-n");
      }
    }
  }

  function get_all_inputs(form) {
    return Array.prototype.slice.call(
      document.getElementsByClassName("input-group"),
      0
    );
  }

  return {
    validate: form => {
      let all_inputs = get_all_inputs(form);

      let results = all_inputs.map(input => {
        let input_field =
          input.querySelector("input") || input.querySelector("textarea");

        if (input_field.value === "") {
          onError(input, input_field);
          return false;
        } else {
          onSuccess(input, input_field);
          return true;
        }
      });

      return !results.includes(false);
    }
  };
})();

export default form;
