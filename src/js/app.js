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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
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
/******/ 	return __webpack_require__(__webpack_require__.s = "./app.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./app.js":
/*!****************!*\
  !*** ./app.js ***!
  \****************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _less_styles_less__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./less/styles.less */ \"./less/styles.less\");\n/* harmony import */ var _less_styles_less__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_less_styles_less__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _js_site__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/site */ \"./js/site.js\");\n/* harmony import */ var _js_site__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_js_site__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _js_my__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./js/my */ \"./js/my.js\");\n/* harmony import */ var _js_my__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_js_my__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _js_map__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./js/map */ \"./js/map.js\");\n/* harmony import */ var _js_map__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_js_map__WEBPACK_IMPORTED_MODULE_3__);\n\r\n\r\n\r\n\r\n\r\n\r\nconsole.log('App Root');\n\n//# sourceURL=webpack:///./app.js?");

/***/ }),

/***/ "./js/map.js":
/*!*******************!*\
  !*** ./js/map.js ***!
  \*******************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("\r\n$(document).ready(function(){\r\n    map();\r\n\r\n\r\n});\r\n\r\nfunction map() {\r\n    var myMap,myPlacemark;\r\n    var url = window.location.pathname;\r\n    ymaps.ready(function () {\r\n        var myGeocoder = ymaps.geocode('г. Новосибирск');\r\n\r\n        myGeocoder.then(\r\n            function (res) {\r\n                // Кординаты;\r\n                var coords = res.geoObjects.get(0).geometry.getCoordinates();\r\n\r\n                myGeocoder.then(\r\n                    function (res) {\r\n                        myMap = new ymaps.Map(\"map\", {\r\n                            center: [55.0215, 82.7891],\r\n                            zoom: 12\r\n                        });\r\n                        //myMap.behaviors.disable('multiTouch');\r\n                      //  myMap.behaviors.disable(['drag']);\r\n\r\n                        //Отслеживаем событие перемещения позиция карта;\r\n                        myMap.events.add('boundschange', function (event) {\r\n                            if (event.get('newCenter') != event.get('oldCenter')) {\r\n                                var center = myMap.getCenter();\r\n                                var new_center = [center[0].toFixed(4), center[1].toFixed(4)];\r\n                                console.log(new_center);\r\n                            }\r\n                        });\r\n\r\n                        myMap.controls.add('zoomControl');\r\n\r\n                        // Массивы метки;\r\n                        var dataMap = [[55.0485764399064, 82.9115400143297], [54.99010939, 82.90324643]],\r\n                            myCollection= [],\r\n                            myAddress = ['Адресс 1','Адресс 2'];\r\n\r\n                        // Добавляем метки на карте;\r\n                        for (var i = 0, len = dataMap.length; i < len; i++) {\r\n\r\n                                myCollection[i] = balun_map(dataMap[i],myAddress[i]);\r\n                                myMap.geoObjects.add(myCollection[i]);\r\n\r\n                                // myCollection[club_id[i]].events.add('mouseenter', function (e) {\r\n                                //     e.get('target').options.set('iconImageHref', '/images/clubs/balun_ex_hover.png');\r\n                                // });\r\n                                // myCollection[club_id[i]].events.add('mouseleave', function (e) {\r\n                                //     e.get('target').options.set('iconImageHref', '/images/clubs/balun_ex.png');\r\n                                // });\r\n\r\n                        }\r\n\r\n                        // Создать балун;\r\n                        function balun_map(map_lon, myAddress) {\r\n                            myPlacemark = new ymaps.Placemark(map_lon,{\r\n                                balloonContentHeader: myAddress,\r\n                                balloonContentBody: \"Содержимое <em>балуна</em> метки\",\r\n                               // balloonContentFooter: \"Подвал\",\r\n                               // hintContent: \"Хинт метки\",\r\n                            },{\r\n                                preset:'islands#blueIcon',\r\n                                iconLayout: 'default#image',\r\n                               // iconImageHref: '/images/clubs/balun_ex.png',\r\n                               //iconImageSize: [45, 44],\r\n                                //   iconImageHref: (type ? '/images/clubs/ex_marker_active.png' : '/images/clubs/ex_marker.png'),\r\n                                //   iconImageSize: [28, 38],\r\n\r\n\r\n\r\n                                balloonShadow: false\r\n                            });\r\n                            return  myPlacemark;\r\n                             // return myMap.geoObjects.add(myPlacemark);\r\n                        }\r\n                    }\r\n                );\r\n            });\r\n    });\r\n}\r\n\n\n//# sourceURL=webpack:///./js/map.js?");

/***/ }),

/***/ "./js/my.js":
/*!******************!*\
  !*** ./js/my.js ***!
  \******************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("$(document).ready(function () {\r\n\r\n\r\n});\r\n\r\n\r\n\r\nconsole.log('my Version 2.2.0 ');\r\n\r\n//alert('ASD');\n\n//# sourceURL=webpack:///./js/my.js?");

/***/ }),

/***/ "./js/site.js":
/*!********************!*\
  !*** ./js/site.js ***!
  \********************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("$(document).ready(function () {\r\n    // Карусель для контента;\r\n    if($(\".js-slider\").length) {\r\n        //loadContent('show');\r\n        setTimeout(function(){\r\n            // Карусель\r\n            $(\".js-slider .items\").slick({\r\n                dots: true,\r\n                autoplay: false,\r\n                autoplaySpeed: 6000,\r\n                mobileFirst: true,\r\n                speed: 1000,\r\n                slidesToShow: 1,\r\n                arrows: false,\r\n                slidesToScroll: 1\r\n            });\r\n          //  loadContent('hide');\r\n        },1000);\r\n    }\r\n\r\n    // Карусель для контента;\r\n    if($(\".gallery-items\").length) {\r\n        //loadContent('show');\r\n        setTimeout(function(){\r\n            // Карусель\r\n            $(\".gallery-items .items\").slick({\r\n                autoplay: false,\r\n                autoplaySpeed: 6000,\r\n                dots: true,\r\n                infinite: false,\r\n                speed: 300,\r\n                slidesToShow: 6,\r\n                slidesToScroll: 6,\r\n                arrows: false,\r\n                responsive: [\r\n                    {\r\n                        breakpoint: 930,\r\n                        settings: {\r\n                            slidesToShow: 4,\r\n                            slidesToScroll: 4,\r\n                        }\r\n                    },\r\n                    {\r\n                        breakpoint: 630,\r\n                        settings: {\r\n                            slidesToShow: 2,\r\n                            slidesToScroll: 2,\r\n                        }\r\n                    },\r\n                ]\r\n            });\r\n            //  loadContent('hide');\r\n        },1000);\r\n    }\r\n\r\n    $('.navbar-toggle').click(function(){\r\n        $(this).children('div').toggleClass('open');\r\n    });\r\n\r\n    $(\"[data-fancybox]\").fancybox();\r\n});\r\n\r\n// Таб переключение\r\n$(document).on('click','.js-tab-button',function(){\r\n    var k = $(this).data('key');\r\n    $('.js-tab-button').removeClass('active');\r\n    $(this).addClass('active');\r\n    $(\".tab__com .tab\").removeClass('active');\r\n    $(\".tab__com .tab[data-key=\"+ k +\"]\").data('key',k).addClass('active');\r\n    return false;\r\n});\r\n\r\nconsole.log('Scripts Version 2.2.0 ');\r\n\r\n//alert('ASD');\n\n//# sourceURL=webpack:///./js/site.js?");

/***/ }),

/***/ "./less/styles.less":
/*!**************************!*\
  !*** ./less/styles.less ***!
  \**************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin\n\n//# sourceURL=webpack:///./less/styles.less?");

/***/ })

/******/ });