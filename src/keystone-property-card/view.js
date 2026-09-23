import { store, getContext } from "@wordpress/interactivity";

const { state } = store("favoriteBtn", {
  state: {
    get themeText() {
      return state.isDark ? state.darkText : state.lightText;
    },
  },
  actions: {},
  callbacks: {},
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
          "X-WP-Nonce": keystone_property_card.nonce,
        },
        credentials: "same-origin",
        body: JSON.stringify({
          post_id: currentPostId,
        }),
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

    cards.forEach((card) => {
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
