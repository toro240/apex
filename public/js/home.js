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

/***/ "./resources/js/home.js":
/*!******************************!*\
  !*** ./resources/js/home.js ***!
  \******************************/
/***/ (() => {

eval("$(function () {\n  $(document).on('show.bs.modal', '#taskRemoveModal', function (event) {\n    var button = $(event.relatedTarget);\n    var isMeTarget = button.data('is-me-target') === 1;\n    var isAnotherTarget = button.data('is-another-target') === 1;\n    var modal = $(this);\n    modal.find('#task-remove-me').attr('hidden', !isMeTarget);\n    modal.find('#remove-me-form').attr('action', button.data('remove-me-action'));\n    modal.find('#remove-form').attr('action', button.data('remove-action'));\n    modal.find('#task-modal-title').text('Do you want to remove the \\\"' + button.data('task-subject') + '\\\"?');\n    var modalBodyText = isAnotherTarget ? '<h5 class=\"text-danger font-weight-bold\">Another user has been assigned to this task!</h5>' : '';\n    modalBodyText += '<h5>Do you really want to delete this?</h5>';\n\n    if (isMeTarget) {\n      modalBodyText += '<h5><span class=\"text-success\">\\\"RemoveMe\\\"</span> if you want to remove only yourself from tha assignment, <span class=\"text-danger\">\\\"Remove\\\"</span> to delete this.</h5>';\n    }\n\n    modal.find('#task-modal-body').html(modalBodyText);\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvaG9tZS5qcz8yNDJiIl0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsIm9uIiwiZXZlbnQiLCJidXR0b24iLCJyZWxhdGVkVGFyZ2V0IiwiaXNNZVRhcmdldCIsImRhdGEiLCJpc0Fub3RoZXJUYXJnZXQiLCJtb2RhbCIsImZpbmQiLCJhdHRyIiwidGV4dCIsIm1vZGFsQm9keVRleHQiLCJodG1sIl0sIm1hcHBpbmdzIjoiQUFBQUEsQ0FBQyxDQUFDLFlBQVk7QUFDVkEsRUFBQUEsQ0FBQyxDQUFDQyxRQUFELENBQUQsQ0FBWUMsRUFBWixDQUFlLGVBQWYsRUFBZ0Msa0JBQWhDLEVBQW9ELFVBQVNDLEtBQVQsRUFBZ0I7QUFDaEUsUUFBTUMsTUFBTSxHQUFHSixDQUFDLENBQUNHLEtBQUssQ0FBQ0UsYUFBUCxDQUFoQjtBQUNBLFFBQU1DLFVBQVUsR0FBR0YsTUFBTSxDQUFDRyxJQUFQLENBQVksY0FBWixNQUFnQyxDQUFuRDtBQUNBLFFBQU1DLGVBQWUsR0FBR0osTUFBTSxDQUFDRyxJQUFQLENBQVksbUJBQVosTUFBcUMsQ0FBN0Q7QUFFQSxRQUFNRSxLQUFLLEdBQUdULENBQUMsQ0FBQyxJQUFELENBQWY7QUFDQVMsSUFBQUEsS0FBSyxDQUFDQyxJQUFOLENBQVcsaUJBQVgsRUFBOEJDLElBQTlCLENBQW1DLFFBQW5DLEVBQTZDLENBQUNMLFVBQTlDO0FBQ0FHLElBQUFBLEtBQUssQ0FBQ0MsSUFBTixDQUFXLGlCQUFYLEVBQThCQyxJQUE5QixDQUFtQyxRQUFuQyxFQUE2Q1AsTUFBTSxDQUFDRyxJQUFQLENBQVksa0JBQVosQ0FBN0M7QUFDQUUsSUFBQUEsS0FBSyxDQUFDQyxJQUFOLENBQVcsY0FBWCxFQUEyQkMsSUFBM0IsQ0FBZ0MsUUFBaEMsRUFBMENQLE1BQU0sQ0FBQ0csSUFBUCxDQUFZLGVBQVosQ0FBMUM7QUFDQUUsSUFBQUEsS0FBSyxDQUFDQyxJQUFOLENBQVcsbUJBQVgsRUFBZ0NFLElBQWhDLENBQXFDLGlDQUFpQ1IsTUFBTSxDQUFDRyxJQUFQLENBQVksY0FBWixDQUFqQyxHQUErRCxLQUFwRztBQUVBLFFBQUlNLGFBQWEsR0FBR0wsZUFBZSxHQUFHLDRGQUFILEdBQWtHLEVBQXJJO0FBQ0FLLElBQUFBLGFBQWEsSUFBSSw2Q0FBakI7O0FBQ0EsUUFBSVAsVUFBSixFQUFnQjtBQUNaTyxNQUFBQSxhQUFhLElBQUksOEtBQWpCO0FBQ0g7O0FBQ0RKLElBQUFBLEtBQUssQ0FBQ0MsSUFBTixDQUFXLGtCQUFYLEVBQStCSSxJQUEvQixDQUFvQ0QsYUFBcEM7QUFDSCxHQWpCRDtBQWtCSCxDQW5CQSxDQUFEIiwic291cmNlc0NvbnRlbnQiOlsiJChmdW5jdGlvbiAoKSB7XG4gICAgJChkb2N1bWVudCkub24oJ3Nob3cuYnMubW9kYWwnLCAnI3Rhc2tSZW1vdmVNb2RhbCcsIGZ1bmN0aW9uKGV2ZW50KSB7XG4gICAgICAgIGNvbnN0IGJ1dHRvbiA9ICQoZXZlbnQucmVsYXRlZFRhcmdldCk7XG4gICAgICAgIGNvbnN0IGlzTWVUYXJnZXQgPSBidXR0b24uZGF0YSgnaXMtbWUtdGFyZ2V0JykgPT09IDE7XG4gICAgICAgIGNvbnN0IGlzQW5vdGhlclRhcmdldCA9IGJ1dHRvbi5kYXRhKCdpcy1hbm90aGVyLXRhcmdldCcpID09PSAxO1xuXG4gICAgICAgIGNvbnN0IG1vZGFsID0gJCh0aGlzKTtcbiAgICAgICAgbW9kYWwuZmluZCgnI3Rhc2stcmVtb3ZlLW1lJykuYXR0cignaGlkZGVuJywgIWlzTWVUYXJnZXQpO1xuICAgICAgICBtb2RhbC5maW5kKCcjcmVtb3ZlLW1lLWZvcm0nKS5hdHRyKCdhY3Rpb24nLCBidXR0b24uZGF0YSgncmVtb3ZlLW1lLWFjdGlvbicpKTtcbiAgICAgICAgbW9kYWwuZmluZCgnI3JlbW92ZS1mb3JtJykuYXR0cignYWN0aW9uJywgYnV0dG9uLmRhdGEoJ3JlbW92ZS1hY3Rpb24nKSk7XG4gICAgICAgIG1vZGFsLmZpbmQoJyN0YXNrLW1vZGFsLXRpdGxlJykudGV4dCgnRG8geW91IHdhbnQgdG8gcmVtb3ZlIHRoZSBcXFwiJyArIGJ1dHRvbi5kYXRhKCd0YXNrLXN1YmplY3QnKSArICdcXFwiPycpO1xuXG4gICAgICAgIGxldCBtb2RhbEJvZHlUZXh0ID0gaXNBbm90aGVyVGFyZ2V0ID8gJzxoNSBjbGFzcz1cInRleHQtZGFuZ2VyIGZvbnQtd2VpZ2h0LWJvbGRcIj5Bbm90aGVyIHVzZXIgaGFzIGJlZW4gYXNzaWduZWQgdG8gdGhpcyB0YXNrITwvaDU+JyA6ICcnO1xuICAgICAgICBtb2RhbEJvZHlUZXh0ICs9ICc8aDU+RG8geW91IHJlYWxseSB3YW50IHRvIGRlbGV0ZSB0aGlzPzwvaDU+JztcbiAgICAgICAgaWYgKGlzTWVUYXJnZXQpIHtcbiAgICAgICAgICAgIG1vZGFsQm9keVRleHQgKz0gJzxoNT48c3BhbiBjbGFzcz1cInRleHQtc3VjY2Vzc1wiPlxcXCJSZW1vdmVNZVxcXCI8L3NwYW4+IGlmIHlvdSB3YW50IHRvIHJlbW92ZSBvbmx5IHlvdXJzZWxmIGZyb20gdGhhIGFzc2lnbm1lbnQsIDxzcGFuIGNsYXNzPVwidGV4dC1kYW5nZXJcIj5cXFwiUmVtb3ZlXFxcIjwvc3Bhbj4gdG8gZGVsZXRlIHRoaXMuPC9oNT4nXG4gICAgICAgIH1cbiAgICAgICAgbW9kYWwuZmluZCgnI3Rhc2stbW9kYWwtYm9keScpLmh0bWwobW9kYWxCb2R5VGV4dCk7XG4gICAgfSlcbn0pXG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2hvbWUuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/home.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/home.js"]();
/******/ 	
/******/ })()
;