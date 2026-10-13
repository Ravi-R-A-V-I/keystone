document.addEventListener("DOMContentLoaded", () => {
  const bioText = document.querySelector(".profile-about-section p");
  const readMoreBtn = document.querySelector(".read-more-toggle");
  if (!bioText || !readMoreBtn) return;

  readMoreBtn.addEventListener("click", () => {
    bioText.classList.toggle("is-expanded");
    if (bioText.classList.contains("is-expanded")) {
      readMoreBtn.textContent = "Show less";
    } else {
      readMoreBtn.textContent = "Read more";
    }
  });
  function initSlider(sectionClass) {
    let section = document.querySelector(sectionClass);
    if (!section) return;

    const track = section.querySelector(".listings-track");
    const arrows = section.querySelectorAll(".nav-arrow");

    arrows[1].addEventListener("click", () => {
      track.scrollBy({
        left: 340 * 3,
        behavior: "smooth",
      });
    });

    arrows[0].addEventListener("click", () => {
      track.scrollBy({
        left: -340 * 3,
        behavior: "smooth",
      });
    });

    function updateArrow() {
      if (track.scrollLeft <= 0) {
        arrows[0].classList.add("is-disabled");
      } else {
        arrows[0].classList.remove("is-disabled");
      }

      if (track.scrollLeft + track.clientWidth >= track.scrollWidth - 1) {
        arrows[1].classList.add("is-disabled");
      } else {
        arrows[1].classList.remove("is-disabled");
      }
    }

    track.addEventListener("scroll", () => {
      updateArrow();
    });

    updateArrow();
  }

  initSlider(".profile-listings-sale");
  initSlider(".profile-listings-rent");
});
