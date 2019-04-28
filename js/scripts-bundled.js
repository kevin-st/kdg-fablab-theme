/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./wp-content/themes/kdg-fablab-theme/js/scripts.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./wp-content/themes/kdg-fablab-theme/js/modules/base.js":
/*!***************************************************************!*\
  !*** ./wp-content/themes/kdg-fablab-theme/js/modules/base.js ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\nvar base = function () {\n  return {\n    addClass: function addClass(element, className) {\n      if (element.classList) {\n        element.classList.add(className);\n      }\n    },\n    hassClass: function hassClass(element, className) {\n      if (element.classList) {\n        return element.classList.contains(className);\n      }\n    },\n    removeClass: function removeClass(element, className) {\n      if (element.classList) {\n        element.classList.remove(className);\n      }\n    },\n    toggleClass: function toggleClass(element, className) {\n      if (element.classList) {\n        element.classList.toggle(className);\n      }\n    }\n  };\n}();\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (base);\n\n//# sourceURL=webpack:///./wp-content/themes/kdg-fablab-theme/js/modules/base.js?");

/***/ }),

/***/ "./wp-content/themes/kdg-fablab-theme/js/modules/burgermenu.js":
/*!*********************************************************************!*\
  !*** ./wp-content/themes/kdg-fablab-theme/js/modules/burgermenu.js ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\n/*var navknop = document.querySelector(\".burgerbtn\");\r\nvar menureact = document.querySelector(\"#menu-container\");\r\n\r\nnavknop.addEventListener(\"click\", menuKlik);\r\n\r\nfunction menuKlik(evt) {\r\n  navknop.innerHTML = \"--\";\r\n  if (menureact.classList) {\r\n    menureact.classList.toggle(\"zichtbaarheid\");\r\n  } else {\r\n    // For IE9\r\n    var classes = menureact.className.split(\" \");\r\n    var i = classes.indexOf(\"zichtbaarheid\");\r\n\r\n    if (i >= 0)\r\n      classes.splice(i, 1);\r\n    else\r\n      classes.push(\"zichtbaarheid\");\r\n      menureact.className = classes.join(\" \");\r\n  }\r\n}\r\n*/\n// some example module\nvar Menu = function Menu() {\n  _classCallCheck(this, Menu);\n\n  var navknop = document.querySelector(\".burgerbtn\");\n  var menureact = document.querySelector(\"#menu-container\");\n  var img = document.querySelector(\"#menuimg\");\n  var img2 = document.querySelector(\"#menuimg2\");\n  navknop.addEventListener(\"click\", menuKlik);\n\n  function menuKlik(evt) {\n    if (menureact.classList) {\n      menureact.classList.toggle(\"zichtbaarheid\");\n      img.classList.toggle(\"zichtbaarheid\");\n      img2.classList.toggle(\"zichtbaarheid\");\n      console.log(\"Toggle class!\");\n    } else {\n      // For IE9\n      var classes = menureact.className.split(\" \");\n      var i = classes.indexOf(\"zichtbaarheid\");\n      if (i >= 0) classes.splice(i, 1);else classes.push(\"zichtbaarheid\");\n      menureact.className = classes.join(\" \");\n    }\n  }\n};\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (Menu);\n\n//# sourceURL=webpack:///./wp-content/themes/kdg-fablab-theme/js/modules/burgermenu.js?");

/***/ }),

/***/ "./wp-content/themes/kdg-fablab-theme/js/modules/form-validation.js":
/*!**************************************************************************!*\
  !*** ./wp-content/themes/kdg-fablab-theme/js/modules/form-validation.js ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _base__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./base */ \"./wp-content/themes/kdg-fablab-theme/js/modules/base.js\");\n\n\nvar form = function () {\n  function onError(input_group, input_field) {\n    var error_message = input_group.getElementsByClassName(\"error-message\")[0];\n    _base__WEBPACK_IMPORTED_MODULE_0__[\"default\"].addClass(input_field, \"error\");\n\n    if (_base__WEBPACK_IMPORTED_MODULE_0__[\"default\"].hassClass(error_message, \"disp-n\")) {\n      _base__WEBPACK_IMPORTED_MODULE_0__[\"default\"].removeClass(error_message, \"disp-n\");\n    }\n  }\n\n  function onSuccess(input_group, input_field) {\n    if (_base__WEBPACK_IMPORTED_MODULE_0__[\"default\"].hassClass(input_field, \"error\")) {\n      var error_message = input_group.getElementsByClassName(\"error-message\")[0];\n      _base__WEBPACK_IMPORTED_MODULE_0__[\"default\"].removeClass(input_field, \"error\");\n\n      if (!_base__WEBPACK_IMPORTED_MODULE_0__[\"default\"].hassClass(error_message, \"disp-n\")) {\n        _base__WEBPACK_IMPORTED_MODULE_0__[\"default\"].addClass(error_message, \"disp-n\");\n      }\n    }\n  }\n\n  function get_all_inputs(form) {\n    return Array.prototype.slice.call(document.getElementsByClassName(\"input-group\"), 0);\n  }\n\n  return {\n    validate: function validate(form) {\n      var all_inputs = get_all_inputs(form);\n      var results = all_inputs.map(function (input) {\n        var input_field = input.querySelector(\"input\") || input.querySelector(\"textarea\");\n\n        if (input_field.value === \"\") {\n          onError(input, input_field);\n          return false;\n        } else {\n          onSuccess(input, input_field);\n          return true;\n        }\n      });\n      return !results.includes(false);\n    }\n  };\n}();\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (form);\n\n//# sourceURL=webpack:///./wp-content/themes/kdg-fablab-theme/js/modules/form-validation.js?");

/***/ }),

/***/ "./wp-content/themes/kdg-fablab-theme/js/scripts.js":
/*!**********************************************************!*\
  !*** ./wp-content/themes/kdg-fablab-theme/js/scripts.js ***!
  \**********************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _modules_burgermenu__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/burgermenu */ \"./wp-content/themes/kdg-fablab-theme/js/modules/burgermenu.js\");\n/* harmony import */ var _modules_form_validation__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/form-validation */ \"./wp-content/themes/kdg-fablab-theme/js/modules/form-validation.js\");\n/* imports */\n//import Slider from \"./modules/slider\";\n\n //var slider = new Slider();\n\nvar menu = new _modules_burgermenu__WEBPACK_IMPORTED_MODULE_0__[\"default\"]();\n/* CONTACT PAGE */\n\nvar contact_form = document.getElementById(\"contact-form\");\n\nif (contact_form) {\n  contact_form.addEventListener(\"submit\", function (e) {\n    if (!_modules_form_validation__WEBPACK_IMPORTED_MODULE_1__[\"default\"].validate(e.target)) {\n      e.preventDefault();\n    }\n  });\n}\n/* Login nav */\n\n\nvar loginNav = document.querySelector(\".menu\").lastElementChild;\n\nif (window.innerWidth > 960) {\n  loginNav.querySelector(\"a\").innerHTML = \"i\";\n} else {\n  loginNav.querySelector(\"a\").innerHTML = \"Login\";\n}\n\n//# sourceURL=webpack:///./wp-content/themes/kdg-fablab-theme/js/scripts.js?");

/***/ })

/******/ });