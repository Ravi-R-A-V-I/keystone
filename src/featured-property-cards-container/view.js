import { store, getContext, getElement } from "@wordpress/interactivity";

const getSliderDetails = (ref) => {
  const container = ref.closest(".featured-properties-container");
  const track = container.querySelector(".featured-properties-track");
  const cardWidth = track.querySelector(".property-card").offsetWidth;
  const scrollDistance = (cardWidth + 20) * 3;

  return {
    track,
    leftBtn: container.querySelector(".prev-btn"),
    rightBtn: container.querySelector(".next-btn"),
    scrollDistance,
    maxScroll: track.scrollWidth - track.clientWidth,
  };
};

const { state } = store("keystone/property-slider", {
  state: {},
  actions: {
    scrollLeft: () => {
      const { ref } = getElement();
      const { track, leftBtn, rightBtn, scrollDistance } =
        getSliderDetails(ref);
      track.scrollLeft -= scrollDistance;

      rightBtn.style.display = "flex";

      if (track.scrollLeft <= scrollDistance) {
        leftBtn.style.display = "none";
      }
    },

    scrollRight: () => {
      const { ref } = getElement();
      const { track, leftBtn, rightBtn, scrollDistance, maxScroll } =
        getSliderDetails(ref);

      track.scrollLeft += scrollDistance;
      leftBtn.style.display = "flex";

      if (track.scrollLeft >= maxScroll - scrollDistance) {
        rightBtn.style.display = "none";
      }
    },
  },
  callbacks: {},
});
