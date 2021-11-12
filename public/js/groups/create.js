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

/***/ "./resources/js/groups/create.js":
/*!***************************************!*\
  !*** ./resources/js/groups/create.js ***!
  \***************************************/
/***/ (() => {

eval("$(function () {\n  $('.add-user-name-btn').on('click', function () {\n    var $userNameForm = $(this).parent().parent();\n    var $addUserNameForm = $userNameForm.clone(true);\n    $addUserNameForm.find('.user-name-label').each(function (index, element) {\n      $(element).text('');\n    });\n    $addUserNameForm.find('.invalid-feedback').each(function (index, element) {\n      $(element).text('');\n    });\n    $addUserNameForm.find('.input-user-name').each(function (index, element) {\n      $(element).val('');\n    });\n    $addUserNameForm.find('.is-invalid').each(function (index, element) {\n      $(element).removeClass('is-invalid');\n    });\n    $addUserNameForm.find('.add-user-name-btn').remove();\n    $addUserNameForm.insertAfter($('.user-name:last'));\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZ3JvdXBzL2NyZWF0ZS5qcz8xN2U2Il0sIm5hbWVzIjpbIiQiLCJvbiIsIiR1c2VyTmFtZUZvcm0iLCJwYXJlbnQiLCIkYWRkVXNlck5hbWVGb3JtIiwiY2xvbmUiLCJmaW5kIiwiZWFjaCIsImluZGV4IiwiZWxlbWVudCIsInRleHQiLCJ2YWwiLCJyZW1vdmVDbGFzcyIsInJlbW92ZSIsImluc2VydEFmdGVyIl0sIm1hcHBpbmdzIjoiQUFBQUEsQ0FBQyxDQUFDLFlBQVk7QUFDVkEsRUFBQUEsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0JDLEVBQXhCLENBQTJCLE9BQTNCLEVBQW9DLFlBQVc7QUFDM0MsUUFBSUMsYUFBYSxHQUFHRixDQUFDLENBQUMsSUFBRCxDQUFELENBQVFHLE1BQVIsR0FBaUJBLE1BQWpCLEVBQXBCO0FBQ0EsUUFBSUMsZ0JBQWdCLEdBQUdGLGFBQWEsQ0FBQ0csS0FBZCxDQUFvQixJQUFwQixDQUF2QjtBQUNBRCxJQUFBQSxnQkFBZ0IsQ0FBQ0UsSUFBakIsQ0FBc0Isa0JBQXRCLEVBQTBDQyxJQUExQyxDQUErQyxVQUFVQyxLQUFWLEVBQWlCQyxPQUFqQixFQUEwQjtBQUNyRVQsTUFBQUEsQ0FBQyxDQUFDUyxPQUFELENBQUQsQ0FBV0MsSUFBWCxDQUFnQixFQUFoQjtBQUNILEtBRkQ7QUFHQU4sSUFBQUEsZ0JBQWdCLENBQUNFLElBQWpCLENBQXNCLG1CQUF0QixFQUEyQ0MsSUFBM0MsQ0FBZ0QsVUFBVUMsS0FBVixFQUFpQkMsT0FBakIsRUFBMEI7QUFDdEVULE1BQUFBLENBQUMsQ0FBQ1MsT0FBRCxDQUFELENBQVdDLElBQVgsQ0FBZ0IsRUFBaEI7QUFDSCxLQUZEO0FBR0FOLElBQUFBLGdCQUFnQixDQUFDRSxJQUFqQixDQUFzQixrQkFBdEIsRUFBMENDLElBQTFDLENBQStDLFVBQVVDLEtBQVYsRUFBaUJDLE9BQWpCLEVBQTBCO0FBQ3JFVCxNQUFBQSxDQUFDLENBQUNTLE9BQUQsQ0FBRCxDQUFXRSxHQUFYLENBQWUsRUFBZjtBQUNILEtBRkQ7QUFHQVAsSUFBQUEsZ0JBQWdCLENBQUNFLElBQWpCLENBQXNCLGFBQXRCLEVBQXFDQyxJQUFyQyxDQUEwQyxVQUFVQyxLQUFWLEVBQWlCQyxPQUFqQixFQUEwQjtBQUNoRVQsTUFBQUEsQ0FBQyxDQUFDUyxPQUFELENBQUQsQ0FBV0csV0FBWCxDQUF1QixZQUF2QjtBQUNILEtBRkQ7QUFHQVIsSUFBQUEsZ0JBQWdCLENBQUNFLElBQWpCLENBQXNCLG9CQUF0QixFQUE0Q08sTUFBNUM7QUFDQVQsSUFBQUEsZ0JBQWdCLENBQUNVLFdBQWpCLENBQTZCZCxDQUFDLENBQUMsaUJBQUQsQ0FBOUI7QUFDSCxHQWpCRDtBQWtCSCxDQW5CQSxDQUFEIiwic291cmNlc0NvbnRlbnQiOlsiJChmdW5jdGlvbiAoKSB7XG4gICAgJCgnLmFkZC11c2VyLW5hbWUtYnRuJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKSB7XG4gICAgICAgIGxldCAkdXNlck5hbWVGb3JtID0gJCh0aGlzKS5wYXJlbnQoKS5wYXJlbnQoKTtcbiAgICAgICAgbGV0ICRhZGRVc2VyTmFtZUZvcm0gPSAkdXNlck5hbWVGb3JtLmNsb25lKHRydWUpO1xuICAgICAgICAkYWRkVXNlck5hbWVGb3JtLmZpbmQoJy51c2VyLW5hbWUtbGFiZWwnKS5lYWNoKGZ1bmN0aW9uIChpbmRleCwgZWxlbWVudCkge1xuICAgICAgICAgICAgJChlbGVtZW50KS50ZXh0KCcnKTtcbiAgICAgICAgfSk7XG4gICAgICAgICRhZGRVc2VyTmFtZUZvcm0uZmluZCgnLmludmFsaWQtZmVlZGJhY2snKS5lYWNoKGZ1bmN0aW9uIChpbmRleCwgZWxlbWVudCkge1xuICAgICAgICAgICAgJChlbGVtZW50KS50ZXh0KCcnKTtcbiAgICAgICAgfSlcbiAgICAgICAgJGFkZFVzZXJOYW1lRm9ybS5maW5kKCcuaW5wdXQtdXNlci1uYW1lJykuZWFjaChmdW5jdGlvbiAoaW5kZXgsIGVsZW1lbnQpIHtcbiAgICAgICAgICAgICQoZWxlbWVudCkudmFsKCcnKTtcbiAgICAgICAgfSk7XG4gICAgICAgICRhZGRVc2VyTmFtZUZvcm0uZmluZCgnLmlzLWludmFsaWQnKS5lYWNoKGZ1bmN0aW9uIChpbmRleCwgZWxlbWVudCkge1xuICAgICAgICAgICAgJChlbGVtZW50KS5yZW1vdmVDbGFzcygnaXMtaW52YWxpZCcpO1xuICAgICAgICB9KTtcbiAgICAgICAgJGFkZFVzZXJOYW1lRm9ybS5maW5kKCcuYWRkLXVzZXItbmFtZS1idG4nKS5yZW1vdmUoKTtcbiAgICAgICAgJGFkZFVzZXJOYW1lRm9ybS5pbnNlcnRBZnRlcigkKCcudXNlci1uYW1lOmxhc3QnKSk7XG4gICAgfSk7XG59KVxuIl0sImZpbGUiOiIuL3Jlc291cmNlcy9qcy9ncm91cHMvY3JlYXRlLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/groups/create.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/groups/create.js"]();
/******/ 	
/******/ })()
;