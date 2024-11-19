const thumbnailContainer = document.querySelector('.thumbnail-container');
const thumbnails = document.querySelectorAll('.thumbnail');
const prevButton = document.getElementById('prev-button');
const nextButton = document.getElementById('next-button');
let scrollPosition = 0;

// Change the main image when a thumbnail is clicked
function changeMainImage(thumbnail) {
    const mainImage = document.querySelector('.main-image');
    mainImage.src = thumbnail.src;
    mainImage.alt = thumbnail.alt;
}

// Scroll the thumbnails container left
prevButton.addEventListener('click', () => {
    scrollPosition -= 100; // Adjust scroll step size as needed
    thumbnailContainer.scrollTo({
        left: scrollPosition,
        behavior: 'smooth'
    });
});

// Scroll the thumbnails container right
nextButton.addEventListener('click', () => {
    scrollPosition += 100; // Adjust scroll step size as needed
    thumbnailContainer.scrollTo({
        left: scrollPosition,
        behavior: 'smooth'
    });
});
