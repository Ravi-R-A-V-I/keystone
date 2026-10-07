import { store, getContext } from "@wordpress/interactivity";

const { state } = store("create-block", {
  state: {},
  actions: {},
  callbacks: {},
});
console.log("Header JS loaded!");

document.addEventListener("DOMContentLoaded", () => {
  const profileWrapper = document.querySelector(".profile-dropdown-wrapper");
  const dropdownToggle = document.querySelector(".dropdown-toggle");
  const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
  const mobileCollapse = document.querySelector(".mobile-collapse");

  if (mobileMenuToggle && mobileCollapse) {
    mobileMenuToggle.addEventListener("click", () => {
      mobileCollapse.classList.toggle("is-mobile-open");
    });
  }

  if (profileWrapper && dropdownToggle) {
    dropdownToggle.addEventListener("click", (e) => {
      e.stopPropagation();
      profileWrapper.classList.toggle("is-active");
    });
    document.addEventListener("click", (e) => {
      if (!profileWrapper.contains(e.target)) {
        profileWrapper.classList.remove("is-active");
      }
    });
  }
});
