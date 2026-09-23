import * as __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__ from "@wordpress/interactivity";
/******/ var __webpack_modules__ = ({

/***/ "@wordpress/interactivity"
/*!*******************************************!*\
  !*** external "@wordpress/interactivity" ***!
  \*******************************************/
(module) {

module.exports = __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__;

/***/ }

/******/ });
/************************************************************************/
/******/ // The module cache
/******/ const __webpack_module_cache__ = {};
/******/ 
/******/ // The require function
/******/ function __webpack_require__(moduleId) {
/******/ 	// Check if module is in cache
/******/ 	const cachedModule = __webpack_module_cache__[moduleId];
/******/ 	if (cachedModule !== undefined) {
/******/ 		return cachedModule.exports;
/******/ 	}
/******/ 	// Create a new module (and put it into the cache)
/******/ 	const module = __webpack_module_cache__[moduleId] = {
/******/ 		// no module.id needed
/******/ 		// no module.loaded needed
/******/ 		exports: {}
/******/ 	};
/******/ 
/******/ 	// Execute the module function
/******/ 	if (!(moduleId in __webpack_modules__)) {
/******/ 		delete __webpack_module_cache__[moduleId];
/******/ 		const e = new Error("Cannot find module '" + moduleId + "'");
/******/ 		e.code = 'MODULE_NOT_FOUND';
/******/ 		throw e;
/******/ 	}
/******/ 	__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 
/******/ 	// Return the exports of the module
/******/ 	return module.exports;
/******/ }
/******/ 
/************************************************************************/
/******/ /* webpack/runtime/make namespace object */
/******/ // define __esModule on exports
/******/ __webpack_require__.r = (exports) => {
/******/ 	Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 	Object.defineProperty(exports, '__esModule', { value: true });
/******/ };
/******/ 
/************************************************************************/
let __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*******************************************************!*\
  !*** ./src/featured-property-cards-container/view.js ***!
  \*******************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/interactivity */ "@wordpress/interactivity");

const getSliderDetails = ref => {
  const container = ref.closest(".featured-properties-container");
  const track = container.querySelector(".featured-properties-track");
  const cardWidth = track.querySelector(".property-card").offsetWidth;
  const scrollDistance = (cardWidth + 20) * 3;
  return {
    track,
    leftBtn: container.querySelector(".prev-btn"),
    rightBtn: container.querySelector(".next-btn"),
    scrollDistance,
    maxScroll: track.scrollWidth - track.clientWidth
  };
};
const {
  state
} = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)("keystone/property-slider", {
  state: {},
  actions: {
    scrollLeft: () => {
      const {
        ref
      } = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getElement)();
      const {
        track,
        leftBtn,
        rightBtn,
        scrollDistance
      } = getSliderDetails(ref);
      track.scrollLeft -= scrollDistance;
      rightBtn.style.display = "flex";
      if (track.scrollLeft <= scrollDistance) {
        leftBtn.style.display = "none";
      }
    },
    scrollRight: () => {
      const {
        ref
      } = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getElement)();
      const {
        track,
        leftBtn,
        rightBtn,
        scrollDistance,
        maxScroll
      } = getSliderDetails(ref);
      track.scrollLeft += scrollDistance;
      leftBtn.style.display = "flex";
      if (track.scrollLeft >= maxScroll - scrollDistance) {
        rightBtn.style.display = "none";
      }
    }
  },
  callbacks: {}
});
})();


//# sourceMappingURL=view.js.map