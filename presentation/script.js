const slides = document.querySelectorAll('.slide');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const dotsContainer = document.getElementById('dots-container');
let currentSlideIndex = 0;

// Generate dots dynamically
slides.forEach((_, index) => {
    const dot = document.createElement('div');
    dot.classList.add('dot');
    if (index === 0) dot.classList.add('active');
    dot.addEventListener('click', () => goToSlide(index));
    dotsContainer.appendChild(dot);
});

const dots = document.querySelectorAll('.dot');

// Initial setup for controls status
updateControls();

function updateControls() {
    prevBtn.disabled = currentSlideIndex === 0;
    nextBtn.disabled = currentSlideIndex === slides.length - 1;
    
    dots.forEach((dot, index) => {
        if (index === currentSlideIndex) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
}

// Keep RTL logic: Left arrow key goes forward, Right goes backward
function goToSlide(index) {
    slides[currentSlideIndex].classList.remove('active');
    currentSlideIndex = index;
    slides[currentSlideIndex].classList.add('active');
    updateControls();
}

function nextSlide() {
    if (currentSlideIndex < slides.length - 1) {
        goToSlide(currentSlideIndex + 1);
    }
}

function prevSlide() {
    if (currentSlideIndex > 0) {
        goToSlide(currentSlideIndex - 1);
    }
}

// Keyboard Arrow Key Navigation
document.addEventListener('keydown', function(event) {
    if (event.key === 'ArrowLeft') {
        nextSlide(); // Left arrow goes forward in RTL
    } else if (event.key === 'ArrowRight') {
        prevSlide(); // Right arrow goes backward in RTL
    }
});

// Theme Toggle Logic
function toggleTheme() {
    const body = document.body;
    body.classList.toggle('light-theme');
    const isLight = body.classList.contains('light-theme');
    document.querySelector('.theme-icon').textContent = isLight ? '☀️' : '🌙';
    localStorage.setItem('theme', isLight ? 'light' : 'dark');
}

// Load saved theme
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
        document.body.classList.add('light-theme');
        document.querySelector('.theme-icon').textContent = '☀️';
    }
});

// Visual switcher tabs logic
function switchVisual(button, index) {
    const container = button.closest('.visual-multi');
    
    // Toggle active tab button
    const buttons = container.querySelectorAll('.tab-btn');
    buttons.forEach((btn, idx) => {
        if (idx === index) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });

    // Toggle active image
    const images = container.querySelectorAll('.tab-img');
    images.forEach((img, idx) => {
        if (idx === index) {
            img.classList.add('active');
        } else {
            img.classList.remove('active');
        }
    });
}
