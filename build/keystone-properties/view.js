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
/*!*****************************************!*\
  !*** ./src/keystone-properties/view.js ***!
  \*****************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/interactivity */ "@wordpress/interactivity");

const {
  state
} = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)("keystone-properties", {
  state: {
    get isDropdownOpen() {
      const context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
      return context.openDropdown === context.id;
    }
  },
  actions: {
    toggleDropdown(event) {
      const context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
      const clickedId = event.currentTarget.dataset.dropdownId;
      if (clickedId === context.openDropdown) {
        context.openDropdown = null;
      } else {
        context.openDropdown = clickedId;
      }
    },
    closeDropdown(event) {
      const context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
      const clickedElement = event.target.closest(".keystone-dropdown");
      if (!clickedElement) {
        context.openDropdown = null;
      }
    }
  },
  callbacks: {}
});
let map;
let fetchStatus = new URLSearchParams(window.location.search).get("status");
let currentPage = 1;
const bedsInput = document.querySelector("#filter-beds");
const bathsInput = document.querySelector("#filter-baths");
const priceInput = document.querySelector("#filter-budget-1");
const priceOutput = document.querySelector("#price-range-1");
const priceInput2 = document.querySelector("#filter-budget-2");
const priceOutput2 = document.querySelector("#price-range-2");
const priceGap = 250000;
const filterStatus = document.querySelectorAll('input[name="filter-status"]');
const results = document.getElementById("keystone-results-feed");
const emptyStateHTML = `<div class="keystone-empty-state">
    <div class="empty-header">
      <h2>No matching results</h2>
      <p>Try changing your search.</p>
    </div>
    <div class="empty-tips">
      <p class="tips-header">SEARCH TIPS</p>
      
      <div class="tip-item">
        <span class="dashicons dashicons-location-alt"></span>
        <div>
          <strong>Check your location search</strong>
          <ul>
            <li>Ensure the city, neighborhood, or ZIP code is spelled correctly.</li>
            <li>Try searching for a broader area, like a full city instead of a single neighborhood.</li>
          </ul>
        </div>
      </div>

      <div class="tip-item">
        <span class="dashicons dashicons-admin-settings"></span>
        <div>
          <strong>Broaden your filters</strong>
          <p>Lower your minimum bedroom or bathroom requirements, or expand your price range to reveal more options.</p>
        </div>
      </div>

      <div class="tip-item">
        <span class="dashicons dashicons-admin-site-alt3"></span>
        <div>
          <strong>Increase the scope of your search</strong>
          <p>Zoom out on the map or pan to a nearby city to load more properties in the surrounding area.</p>
        </div>
      </div>
    </div>
  </div>`;
if (!fetchStatus) {
  if (window.location.pathname.includes("buy")) {
    fetchStatus = "sale";
  } else if (window.location.pathname.includes("rent")) {
    fetchStatus = "rent";
  } else {
    fetchStatus = "";
  }
}
function updateFilterUI(filterName) {
  if (filterName === "price") {
    const rawVal1 = parseInt(priceInput.value);
    const rawVal2 = parseInt(priceInput2.value);

    // Reusable formatter function so we don't repeat the USD code twice!
    const formatUSD = num => num.toLocaleString("en-US", {
      style: "currency",
      currency: "USD",
      maximumFractionDigits: 0
    });
    priceOutput.textContent = formatUSD(rawVal1);
    priceOutput2.textContent = formatUSD(rawVal2);
    const minPercentage = rawVal1 / priceInput.max * 100;
    const maxPercentage = rawVal2 / priceInput2.max * 100;
    const element = document.querySelector(".slider-track-container");
    const lightgray = "#d1d5db";
    const blue = "#3b82f6";
    element.style.backgroundImage = `linear-gradient(to right, ${lightgray} ${minPercentage}%, ${blue} ${minPercentage}%, ${blue} ${maxPercentage}%, ${lightgray} ${maxPercentage}%)`;
  } else {
    const input = document.querySelector("#filter-" + filterName);
    const output = document.querySelector("#" + filterName + "-range-1");
    const rawValue = input.value;
    let realNumber = parseInt(rawValue);
    if (!isNaN(realNumber)) {
      if (realNumber === parseInt(input.max)) {
        output.textContent = realNumber + "+";
      } else {
        output.textContent = realNumber;
      }
    }
    const percentage = input.value / input.max * 100;
    const track = input.parentElement;
    const lightgray = "#d1d5db";
    const blue = "#3b82f6";
    track.style.backgroundImage = `linear-gradient(to right, ${blue} ${percentage}%, ${lightgray} ${percentage}%)`;
  }
}
filterStatus.forEach(radio => {
  if (radio.value === fetchStatus) radio.checked = true;
  radio.addEventListener("change", () => {
    fetchStatus = radio.value;
    currentPage = 1;
    map.fire("moveend");
  });
});
bedsInput.addEventListener("input", () => {
  updateFilterUI("beds");
});
bathsInput.addEventListener("input", () => {
  updateFilterUI("baths");
});
priceInput.addEventListener("input", event => {
  if (parseInt(event.target.value) > parseInt(priceInput2.value) - priceGap) {
    priceInput.value = parseInt(priceInput2.value) - priceGap;
  }
  updateFilterUI("price");
});
priceInput2.addEventListener("input", event => {
  if (parseInt(event.target.value) < parseInt(priceInput.value) + priceGap) {
    priceInput2.value = parseInt(priceInput.value) + priceGap;
  }
  updateFilterUI("price");
});
let isLoading = false;
let loader = document.getElementById("keystone-loader");
let northEdge = null;
let southEdge = null;
let eastEdge = null;
let westEdge = null;
let observer = new IntersectionObserver(async entries => {
  if (!entries[0].isIntersecting || isLoading) return;
  isLoading = true;
  loader.classList.add("is-fetching");
  let apiUrl = new URL(window.location.origin + "/wp-json/keystone/v1/properties");
  if (fetchStatus) apiUrl.searchParams.append("status", fetchStatus);
  apiUrl.searchParams.append("page", currentPage);
  if (northEdge) apiUrl.searchParams.append("north_lat", northEdge);
  if (southEdge) apiUrl.searchParams.append("south_lat", southEdge);
  if (eastEdge) apiUrl.searchParams.append("east_lng", eastEdge);
  if (westEdge) apiUrl.searchParams.append("west_lng", westEdge);
  if (priceInput.value) {
    apiUrl.searchParams.append("min_price", priceInput.value);
    apiUrl.searchParams.append("max_price", priceInput2.value);
  }
  if (bedsInput.value) apiUrl.searchParams.append("beds", bedsInput.value);
  if (bathsInput.value) apiUrl.searchParams.append("baths", bathsInput.value);
  try {
    let response = await fetch(apiUrl, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        "X-WP-Nonce": keystone_property_card.nonce
      },
      credentials: "same-origin"
    });
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    let data = await response.json();
    if (data.html_output.trim() === "") {
      observer.unobserve(loader);
      return;
    }
    const tempSandbox = document.createElement("div");
    tempSandbox.innerHTML = data.html_output;
    const newCards = tempSandbox.querySelectorAll(".property-card");
    newCards.forEach(card => {
      loader.insertAdjacentElement("beforebegin", card);
    });
    const keystoneNewCards = new CustomEvent("keystone-new-cards", {
      detail: data.html_output,
      bubbles: true,
      composed: true
    });
    document.dispatchEvent(keystoneNewCards);
    currentPage++;
  } catch (error) {
    console.error("Failed to load more properties:", error);
  } finally {
    // ALWAYS runs, success or failure, preventing the infinite spinner bug
    isLoading = false;
    loader.classList.remove("is-fetching");
  }
});
observer.observe(loader);
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
      map.flyTo([lat, lon], 13, {
        animate: true,
        duration: 2
      });
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
  map.flyTo([lat, lon], 13, {
    animate: true,
    duration: 2
  });
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
    map.flyTo([latitude, longitude], 13, {
      animate: true,
      duration: 2
    });
    console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
    let cricle = L.circleMarker([latitude, longitude], {
      color: "white",
      fillColor: "#3b82f6",
      fillOpacity: 1,
      radius: 10
    }).addTo(map);
  }, error => {
    console.log(`Error ${error.code}: ${error.message}`);
  }, {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
  });
});
async function initMap() {
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.get("lat");
  urlParams.get("lng");
  let startLat = null;
  let startLng = null;
  if (urlParams.get("lat") && urlParams.get("lng")) {
    startLat = urlParams.get("lat");
    startLng = urlParams.get("lng");
  } else {
    try {
      let ipResponse = await fetch("https://ipapi.co/json/");
      let ipData = await ipResponse.json();
      startLat = ipData.latitude;
      startLng = ipData.longitude;
    } catch (error) {
      console.error("IP lookup failed, using fallback:", error);
    }
  }
  let markerRegistry = {};
  map = L.map("keystone-map-canvas").setView([startLat, startLng], 11);
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);
  if (urlParams.get("lat") && urlParams.get("lng") && urlParams.get("source") === "gps") {
    let cricle = L.circleMarker([startLat, startLng], {
      color: "white",
      fillColor: "#3b82f6",
      fillOpacity: 1,
      radius: 10
    }).addTo(map);
  }
  const properties = JSON.parse(document.getElementById("keystone-map-canvas").dataset.properties);
  properties.forEach(property => {
    const {
      lat,
      lng,
      post_id,
      title
    } = property;
    const currentMarker = L.marker([lat, lng]).bindPopup(title).addTo(map);
    markerRegistry[post_id] = currentMarker;
  });
  results.addEventListener("mouseover", event => {
    const cardTarget = event.target.closest(".property-card");
    if (cardTarget) {
      const postId = cardTarget.dataset.postId;
      markerRegistry[postId].openPopup();
    }
  });
  results.addEventListener("mouseout", event => {
    const cardTarget = event.target.closest(".property-card");
    if (cardTarget) {
      const postId = cardTarget.dataset.postId;
      markerRegistry[postId].closePopup();
    }
  });
  map.on("moveend", async () => {
    let currentBounds = map.getBounds();
    northEdge = currentBounds.getNorth();
    southEdge = currentBounds.getSouth();
    eastEdge = currentBounds.getEast();
    westEdge = currentBounds.getWest();
    isLoading = true;
    loader.classList.add("is-fetching");
    currentPage = 1;
    let apiUrl = new URL(window.location.origin + "/wp-json/keystone/v1/properties");
    if (fetchStatus) apiUrl.searchParams.append("status", fetchStatus);
    apiUrl.searchParams.append("page", currentPage);
    apiUrl.searchParams.append("north_lat", northEdge);
    apiUrl.searchParams.append("south_lat", southEdge);
    apiUrl.searchParams.append("east_lng", eastEdge);
    apiUrl.searchParams.append("west_lng", westEdge);
    if (priceInput.value) {
      apiUrl.searchParams.append("min_price", priceInput.value);
      apiUrl.searchParams.append("max_price", priceInput2.value);
    }
    if (bedsInput.value) apiUrl.searchParams.append("beds", bedsInput.value);
    if (bathsInput.value) apiUrl.searchParams.append("baths", bathsInput.value);
    try {
      let response = await fetch(apiUrl, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          "X-WP-Nonce": keystone_property_card.nonce
        },
        credentials: "same-origin"
      });
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      let data = await response.json();
      Array.from(loader.parentElement.children).forEach(child => {
        if (child.id !== "keystone-loader") child.remove();
      });
      // 2. Sweep away the old map pins
      for (let id in markerRegistry) {
        map.removeLayer(markerRegistry[id]);
      }
      markerRegistry = {}; // Reset the memory

      // 3. Paste the new HTML cards
      if (data.html_output.trim() === "") {
        loader.insertAdjacentHTML("beforebegin", emptyStateHTML);
        observer.unobserve(loader);
      } else {
        loader.insertAdjacentHTML("beforebegin", data.html_output);
        observer.observe(loader);
      }

      // 4. Draw the new map pins
      if (data.map_markers) {
        data.map_markers.forEach(markerData => {
          let pin = L.marker([markerData.latitude, markerData.longitude]).addTo(map);
          markerRegistry[markerData.post_id] = pin;
        });
      }
      observer.unobserve(loader);
      let cards = document.querySelectorAll(".property-card");
      cards.forEach(card => {
        card.remove();
      });
      let tempSandbox = document.createElement("div");
      tempSandbox.innerHTML = data.html_output;
      let newCards = tempSandbox.querySelectorAll(".property-card");
      newCards.forEach(card => {
        loader.insertAdjacentElement("beforebegin", card);
      });
      let keystoneNewCards = new CustomEvent("keystone-new-cards", {
        detail: data.html_output,
        bubbles: true,
        composed: true
      });
      document.dispatchEvent(keystoneNewCards);
      currentPage++;
    } catch (error) {
      console.error("Failed to load properties:", error);
    } finally {
      isLoading = false;
      loader.classList.remove("is-fetching");
      observer.observe(loader);
    }
    console.log(northEdge, southEdge, eastEdge, westEdge);
  });
  map.fire("moveend");
}
priceInput.addEventListener("change", event => {
  map.fire("moveend");
});
priceInput2.addEventListener("change", event => {
  map.fire("moveend");
});
bedsInput.addEventListener("change", event => {
  map.fire("moveend");
});
bathsInput.addEventListener("change", event => {
  map.fire("moveend");
});
initMap();
updateFilterUI("price");
updateFilterUI("beds");
updateFilterUI("baths");
})();


//# sourceMappingURL=view.js.map