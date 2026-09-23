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
/*!********************************************!*\
  !*** ./src/keystone-property-card/view.js ***!
  \********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/interactivity */ "@wordpress/interactivity");

const {
  state
} = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)("favoriteBtn", {
  state: {
    get themeText() {
      return state.isDark ? state.darkText : state.lightText;
    }
  },
  actions: {},
  callbacks: {}
});
function setupFavoriteButton(card) {
  const favoriteBtn = card.querySelector(".favorite-btn");
  favoriteBtn.addEventListener("click", async () => {
    const currentPostId = card.dataset.postId;
    const url = "/wp-json/keystone/v1/favorites";
    try {
      const response = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-WP-Nonce": keystone_property_card.nonce
        },
        credentials: "same-origin",
        body: JSON.stringify({
          post_id: currentPostId
        })
      });
      const result = await response.json();
      console.log(result);
      if (result.success) {
        if (result.status === "added") {
          favoriteBtn.classList.add("is-favorited");
        } else if (result.status === "removed") {
          favoriteBtn.classList.remove("is-favorited");
        }
      }
    } catch (error) {
      console.log(error);
    }
  });
}
function setupCardSlider(card) {
  const slides = card.querySelectorAll(".property-image");
  const dots = card.querySelectorAll(".gallery-dot");
  const prevBtn = card.querySelector(".gallery__arrow--prev");
  const nextBtn = card.querySelector(".gallery__arrow--next");
  let currentSlide = 0;
  function updateSlide() {
    slides.forEach((slide, index) => {
      if (index === currentSlide) {
        slide.classList.add("is-active");
      } else {
        slide.classList.remove("is-active");
      }
    });
    dots.forEach((dot, index) => {
      if (index === currentSlide) {
        dot.classList.add("is-active");
      } else {
        dot.classList.remove("is-active");
      }
    });
  }
  nextBtn.addEventListener("click", () => {
    if (currentSlide < slides.length - 1) {
      currentSlide = currentSlide + 1;
    } else {
      currentSlide = 0;
    }
    updateSlide();
  });
  prevBtn.addEventListener("click", () => {
    if (currentSlide > 0) {
      currentSlide = currentSlide - 1;
    } else {
      currentSlide = slides.length - 1;
    }
    updateSlide();
  });
  dots.forEach((dot, index) => {
    dot.addEventListener("click", () => {
      currentSlide = index;
      updateSlide();
    });
  });
}
document.addEventListener("DOMContentLoaded", () => {
  function initializePropertyCard() {
    const cards = document.querySelectorAll(".property-card");
    cards.forEach(card => {
      if (!card.dataset.keystoneInitialized) {
        setupFavoriteButton(card);
        setupCardSlider(card);
        card.dataset.keystoneInitialized = true;
      }
    });
  }
  initializePropertyCard();
  document.addEventListener("keystone-new-cards", initializePropertyCard);
});
})();


//# sourceMappingURL=view.js.map