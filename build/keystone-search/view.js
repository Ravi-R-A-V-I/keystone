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
/*!*************************************!*\
  !*** ./src/keystone-search/view.js ***!
  \*************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/interactivity */ "@wordpress/interactivity");

const {
  state
} = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)("create-block", {
  state: {},
  actions: {},
  callbacks: {}
});
const searchInput = document.querySelector("#filter-search");
let searchTimeout = null;
const suggestionBox = document.querySelector("#search-suggestions");
const clearButton = document.querySelector("#clear-button");
const searchBtn = document.querySelector("#search-button");
clearButton.addEventListener("click", () => {
  searchInput.value = "";
  suggestionBox.innerHTML = "";
  clearButton.style.display = "none";
  searchInput.focus();
});
searchInput.addEventListener("input", event => {
  const inputValue = event.target.value;
  if (inputValue.length > 0) {
    clearButton.style.display = "flex";
  } else {
    clearButton.style.display = "none";
  }
  if (!inputValue.trim()) {
    suggestionBox.innerHTML = "";
    return;
  }
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(async () => {
    try {
      let response = await fetch(`https://nominatim.openstreetmap.org/search?q=${inputValue}&format=json`);
      let data = await response.json();
      suggestionBox.innerHTML = data.map(location => {
        return `<div class="suggestion-item" data-lat="${location.lat}" data-lon="${location.lon}">${location.display_name}</div>`;
      }).join("");
      console.log(data);
    } catch (error) {
      console.log("Failed to search locations:", error);
    }
  }, 500);
});
searchBtn.addEventListener("click", async () => {
  const inputValue = searchInput.value;
  if (!inputValue.trim()) {
    suggestionBox.innerHTML = "";
    return;
  }
  suggestionBox.innerHTML = "";
  try {
    let response = await fetch(`https://nominatim.openstreetmap.org/search?q=${inputValue}&format=json`);
    let data = await response.json();
    if (data && data.length > 0) {
      const lat = data[0].lat;
      const lon = data[0].lon;
      window.location.href = window.location.origin + "/properties/?lat=" + lat + "&lng=" + lon;
    }
    console.log(data);
  } catch (error) {
    console.log("Failed to search locations:", error);
  }
});
suggestionBox.addEventListener("click", event => {
  const item = event.target.closest(".suggestion-item");
  if (!item) return;
  const lat = item.dataset.lat;
  const lon = item.dataset.lon;
  window.location.href = window.location.origin + "/properties/?lat=" + lat + "&lng=" + lon;
  searchInput.value = item.textContent;
  suggestionBox.innerHTML = "";
});
const currentLocation = document.querySelector("#location-button");
currentLocation.addEventListener("click", () => {
  navigator.geolocation.getCurrentPosition(position => {
    const {
      latitude,
      longitude
    } = position.coords;
    window.location.href = window.location.origin + "/properties/?lat=" + latitude + "&lng=" + longitude + "&source=gps";
    console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
  }, error => {
    console.log(`Error ${error.code}: ${error.message}`);
  }, {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
  });
});
})();


//# sourceMappingURL=view.js.map