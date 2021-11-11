/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/groups/groupCreate.js":
/*!********************************************!*\
  !*** ./resources/js/groups/groupCreate.js ***!
  \********************************************/
/***/ (() => {

eval("$(function () {\n  $('.add-user-name-btn').on('click', function () {\n    var $userNameForm = $(this).parent().parent();\n    var $addUserNameForm = $userNameForm.clone(true);\n    $addUserNameForm.find('.user-name-label').each(function (index, element) {\n      $(element).text('');\n    });\n    $addUserNameForm.find('.invalid-feedback').each(function (index, element) {\n      $(element).text('');\n    });\n    $addUserNameForm.find('.input-user-name').each(function (index, element) {\n      $(element).val('');\n    });\n    $addUserNameForm.find('.is-invalid').each(function (index, element) {\n      $(element).removeClass('is-invalid');\n    });\n    $addUserNameForm.find('.add-user-name-btn').remove();\n    $addUserNameForm.insertAfter($('.user-name:last'));\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZ3JvdXBzL2dyb3VwQ3JlYXRlLmpzP2NjOGYiXSwibmFtZXMiOlsiJCIsIm9uIiwiJHVzZXJOYW1lRm9ybSIsInBhcmVudCIsIiRhZGRVc2VyTmFtZUZvcm0iLCJjbG9uZSIsImZpbmQiLCJlYWNoIiwiaW5kZXgiLCJlbGVtZW50IiwidGV4dCIsInZhbCIsInJlbW92ZUNsYXNzIiwicmVtb3ZlIiwiaW5zZXJ0QWZ0ZXIiXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUMsWUFBWTtBQUNWQSxFQUFBQSxDQUFDLENBQUMsb0JBQUQsQ0FBRCxDQUF3QkMsRUFBeEIsQ0FBMkIsT0FBM0IsRUFBb0MsWUFBVztBQUMzQyxRQUFJQyxhQUFhLEdBQUdGLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUUcsTUFBUixHQUFpQkEsTUFBakIsRUFBcEI7QUFDQSxRQUFJQyxnQkFBZ0IsR0FBR0YsYUFBYSxDQUFDRyxLQUFkLENBQW9CLElBQXBCLENBQXZCO0FBQ0FELElBQUFBLGdCQUFnQixDQUFDRSxJQUFqQixDQUFzQixrQkFBdEIsRUFBMENDLElBQTFDLENBQStDLFVBQVVDLEtBQVYsRUFBaUJDLE9BQWpCLEVBQTBCO0FBQ3JFVCxNQUFBQSxDQUFDLENBQUNTLE9BQUQsQ0FBRCxDQUFXQyxJQUFYLENBQWdCLEVBQWhCO0FBQ0gsS0FGRDtBQUdBTixJQUFBQSxnQkFBZ0IsQ0FBQ0UsSUFBakIsQ0FBc0IsbUJBQXRCLEVBQTJDQyxJQUEzQyxDQUFnRCxVQUFVQyxLQUFWLEVBQWlCQyxPQUFqQixFQUEwQjtBQUN0RVQsTUFBQUEsQ0FBQyxDQUFDUyxPQUFELENBQUQsQ0FBV0MsSUFBWCxDQUFnQixFQUFoQjtBQUNILEtBRkQ7QUFHQU4sSUFBQUEsZ0JBQWdCLENBQUNFLElBQWpCLENBQXNCLGtCQUF0QixFQUEwQ0MsSUFBMUMsQ0FBK0MsVUFBVUMsS0FBVixFQUFpQkMsT0FBakIsRUFBMEI7QUFDckVULE1BQUFBLENBQUMsQ0FBQ1MsT0FBRCxDQUFELENBQVdFLEdBQVgsQ0FBZSxFQUFmO0FBQ0gsS0FGRDtBQUdBUCxJQUFBQSxnQkFBZ0IsQ0FBQ0UsSUFBakIsQ0FBc0IsYUFBdEIsRUFBcUNDLElBQXJDLENBQTBDLFVBQVVDLEtBQVYsRUFBaUJDLE9BQWpCLEVBQTBCO0FBQ2hFVCxNQUFBQSxDQUFDLENBQUNTLE9BQUQsQ0FBRCxDQUFXRyxXQUFYLENBQXVCLFlBQXZCO0FBQ0gsS0FGRDtBQUdBUixJQUFBQSxnQkFBZ0IsQ0FBQ0UsSUFBakIsQ0FBc0Isb0JBQXRCLEVBQTRDTyxNQUE1QztBQUNBVCxJQUFBQSxnQkFBZ0IsQ0FBQ1UsV0FBakIsQ0FBNkJkLENBQUMsQ0FBQyxpQkFBRCxDQUE5QjtBQUNILEdBakJEO0FBa0JILENBbkJBLENBQUQiLCJzb3VyY2VzQ29udGVudCI6WyIkKGZ1bmN0aW9uICgpIHtcbiAgICAkKCcuYWRkLXVzZXItbmFtZS1idG4nKS5vbignY2xpY2snLCBmdW5jdGlvbigpIHtcbiAgICAgICAgbGV0ICR1c2VyTmFtZUZvcm0gPSAkKHRoaXMpLnBhcmVudCgpLnBhcmVudCgpO1xuICAgICAgICBsZXQgJGFkZFVzZXJOYW1lRm9ybSA9ICR1c2VyTmFtZUZvcm0uY2xvbmUodHJ1ZSk7XG4gICAgICAgICRhZGRVc2VyTmFtZUZvcm0uZmluZCgnLnVzZXItbmFtZS1sYWJlbCcpLmVhY2goZnVuY3Rpb24gKGluZGV4LCBlbGVtZW50KSB7XG4gICAgICAgICAgICAkKGVsZW1lbnQpLnRleHQoJycpO1xuICAgICAgICB9KTtcbiAgICAgICAgJGFkZFVzZXJOYW1lRm9ybS5maW5kKCcuaW52YWxpZC1mZWVkYmFjaycpLmVhY2goZnVuY3Rpb24gKGluZGV4LCBlbGVtZW50KSB7XG4gICAgICAgICAgICAkKGVsZW1lbnQpLnRleHQoJycpO1xuICAgICAgICB9KVxuICAgICAgICAkYWRkVXNlck5hbWVGb3JtLmZpbmQoJy5pbnB1dC11c2VyLW5hbWUnKS5lYWNoKGZ1bmN0aW9uIChpbmRleCwgZWxlbWVudCkge1xuICAgICAgICAgICAgJChlbGVtZW50KS52YWwoJycpO1xuICAgICAgICB9KTtcbiAgICAgICAgJGFkZFVzZXJOYW1lRm9ybS5maW5kKCcuaXMtaW52YWxpZCcpLmVhY2goZnVuY3Rpb24gKGluZGV4LCBlbGVtZW50KSB7XG4gICAgICAgICAgICAkKGVsZW1lbnQpLnJlbW92ZUNsYXNzKCdpcy1pbnZhbGlkJyk7XG4gICAgICAgIH0pO1xuICAgICAgICAkYWRkVXNlck5hbWVGb3JtLmZpbmQoJy5hZGQtdXNlci1uYW1lLWJ0bicpLnJlbW92ZSgpO1xuICAgICAgICAkYWRkVXNlck5hbWVGb3JtLmluc2VydEFmdGVyKCQoJy51c2VyLW5hbWU6bGFzdCcpKTtcbiAgICB9KTtcbn0pXG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2dyb3Vwcy9ncm91cENyZWF0ZS5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/groups/groupCreate.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/groups/groupCreate.js"]();
/******/ 	
/******/ })()
;