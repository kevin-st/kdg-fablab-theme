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

/***/ "./wp-content/themes/kdg-fablab-theme/js/modules/burgermenu.js":
/*!*********************************************************************!*\
  !*** ./wp-content/themes/kdg-fablab-theme/js/modules/burgermenu.js ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\n/*var navknop = document.querySelector(\".burgerbtn\");\r\nvar menureact = document.querySelector(\"#menu-container\");\r\n\r\nnavknop.addEventListener(\"click\", menuKlik);\r\n\r\nfunction menuKlik(evt) {\r\n  navknop.innerHTML = \"--\";\r\n  if (menureact.classList) {\r\n    menureact.classList.toggle(\"zichtbaarheid\");\r\n  } else {\r\n    // For IE9\r\n    var classes = menureact.className.split(\" \");\r\n    var i = classes.indexOf(\"zichtbaarheid\");\r\n\r\n    if (i >= 0)\r\n      classes.splice(i, 1);\r\n    else\r\n      classes.push(\"zichtbaarheid\");\r\n      menureact.className = classes.join(\" \");\r\n  }\r\n}\r\n*/\n// some example module\nvar Menu = function Menu() {\n  _classCallCheck(this, Menu);\n\n  var navknop = document.querySelector(\".burgerbtn\");\n  var menureact = document.querySelector(\"#menu-container\");\n  var img = document.querySelector(\"#menuimg\");\n  var img2 = document.querySelector(\"#menuimg2\");\n  navknop.addEventListener(\"click\", menuKlik);\n\n  function menuKlik(evt) {\n    if (menureact.classList) {\n      menureact.classList.toggle(\"zichtbaarheid\");\n      img.classList.toggle(\"zichtbaarheid\");\n      img2.classList.toggle(\"zichtbaarheid\");\n      console.log(\"Toggle class!\");\n    } else {\n      // For IE9\n      var classes = menureact.className.split(\" \");\n      var i = classes.indexOf(\"zichtbaarheid\");\n      if (i >= 0) classes.splice(i, 1);else classes.push(\"zichtbaarheid\");\n      menureact.className = classes.join(\" \");\n    }\n  }\n};\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (Menu);\n\n//# sourceURL=webpack:///./wp-content/themes/kdg-fablab-theme/js/modules/burgermenu.js?");

/***/ }),

/***/ "./wp-content/themes/kdg-fablab-theme/js/modules/slider.js":
/*!*****************************************************************!*\
  !*** ./wp-content/themes/kdg-fablab-theme/js/modules/slider.js ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\n// some example module\nvar Slider = function Slider() {\n  _classCallCheck(this, Slider);\n\n  console.log(\"hello world from slider!\");\n};\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (Slider);\n\n//# sourceURL=webpack:///./wp-content/themes/kdg-fablab-theme/js/modules/slider.js?");

/***/ }),

/***/ "./wp-content/themes/kdg-fablab-theme/js/scripts.js":
/*!**********************************************************!*\
  !*** ./wp-content/themes/kdg-fablab-theme/js/scripts.js ***!
  \**********************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _modules_slider__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/slider */ \"./wp-content/themes/kdg-fablab-theme/js/modules/slider.js\");\n/* harmony import */ var _modules_burgermenu__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/burgermenu */ \"./wp-content/themes/kdg-fablab-theme/js/modules/burgermenu.js\");\n/* imports */\n\n\nvar slider = new _modules_slider__WEBPACK_IMPORTED_MODULE_0__[\"default\"]();\nvar menu = new _modules_burgermenu__WEBPACK_IMPORTED_MODULE_1__[\"default\"]();\n\n//# sourceURL=webpack:///./wp-content/themes/kdg-fablab-theme/js/scripts.js?");

/***/ })

/******/ });