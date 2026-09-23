import { store, getContext } from "@wordpress/interactivity";

const { state } = store("create-block", {
  state: {},
  actions: {},
  callbacks: {},
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

searchInput.addEventListener("input", (event) => {
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
      let response = await fetch(
        `https://nominatim.openstreetmap.org/search?q=${inputValue}&format=json`,
      );
      let data = await response.json();
      suggestionBox.innerHTML = data
        .map((location) => {
          return `<div class="suggestion-item" data-lat="${location.lat}" data-lon="${location.lon}">${location.display_name}</div>`;
        })
        .join("");
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
    let response = await fetch(
      `https://nominatim.openstreetmap.org/search?q=${inputValue}&format=json`,
    );
    let data = await response.json();

    if (data && data.length > 0) {
      const lat = data[0].lat;
      const lon = data[0].lon;
      window.location.href =
        window.location.origin + "/properties/?lat=" + lat + "&lng=" + lon;
    }
    console.log(data);
  } catch (error) {
    console.log("Failed to search locations:", error);
  }
});

suggestionBox.addEventListener("click", (event) => {
  const item = event.target.closest(".suggestion-item");
  if (!item) return;
  const lat = item.dataset.lat;
  const lon = item.dataset.lon;
  window.location.href =
    window.location.origin + "/properties/?lat=" + lat + "&lng=" + lon;
  searchInput.value = item.textContent;
  suggestionBox.innerHTML = "";
});

const currentLocation = document.querySelector("#location-button");

currentLocation.addEventListener("click", () => {
  navigator.geolocation.getCurrentPosition(
    (position) => {
      const { latitude, longitude } = position.coords;
      window.location.href =
        window.location.origin +
        "/properties/?lat=" +
        latitude +
        "&lng=" +
        longitude +
        "&source=gps";
      console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
    },
    (error) => {
      console.log(`Error ${error.code}: ${error.message}`);
    },
    {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0,
    },
  );
});
