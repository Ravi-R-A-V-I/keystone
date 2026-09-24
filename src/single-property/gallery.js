document.addEventListener("DOMContentLoaded", () => {
  const images = document.querySelectorAll(".single-property-image");
  const thumbnails = document.querySelectorAll(".gallery-thumbnail");
  let currentIndex = 0;

  function updateGallery(index) {
    images.forEach((image, i) => {
      image.classList.toggle("is-active", i === index);
    });
    thumbnails.forEach((thumbnail, i) => {
      thumbnail.classList.toggle("is-active", i === index);
    });
  }

  let autoPlayTimer = setInterval(() => {
    currentIndex = (currentIndex + 1) % images.length;
    updateGallery(currentIndex);
  }, 3000);

  thumbnails.forEach((thumbnail) => {
    thumbnail.addEventListener("click", (event) => {
      const clickedIndex = parseInt(event.target.dataset.index);
      currentIndex = clickedIndex;
      updateGallery(currentIndex);
      clearInterval(autoPlayTimer);
      autoPlayTimer = setInterval(() => {
        currentIndex = (currentIndex + 1) % images.length;
        updateGallery(currentIndex);
      }, 3000);
    });
  });
});
