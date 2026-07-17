/* ============================================================
   GAPLY PRESENTATION — SCRIPT
   ============================================================ */

const slides        = document.querySelectorAll('.slide');
const prevBtn       = document.getElementById('prev-btn');
const nextBtn       = document.getElementById('next-btn');
const dotsContainer = document.getElementById('dots-container');
const progressBar   = document.getElementById('progress-bar');
const slideCounter  = document.getElementById('slide-counter');

let currentSlideIndex = 0;
const totalSlides = slides.length;

// ── Generate dots ────────────────────────────────────────────
slides.forEach((_, index) => {
    const dot = document.createElement('div');
    dot.classList.add('dot');
    if (index === 0) dot.classList.add('active');
    dot.setAttribute('title', `شريحة ${index + 1}`);
    dot.addEventListener('click', () => goToSlide(index));
    dotsContainer.appendChild(dot);
});

const dots = document.querySelectorAll('.dot');

// ── Arabic numeral helper ────────────────────────────────────
function toArabicNumerals(n) {
    return String(n).replace(/\d/g, d => '٠١٢٣٤٥٦٧٨٩'[d]);
}

// ── Update UI controls ───────────────────────────────────────
function updateControls() {
    prevBtn.disabled = currentSlideIndex === 0;
    nextBtn.disabled = currentSlideIndex === totalSlides - 1;

    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlideIndex);
    });

    // Progress bar: percentage through slides
    const pct = totalSlides > 1
        ? (currentSlideIndex / (totalSlides - 1)) * 100
        : 100;
    progressBar.style.width = pct + '%';

    // Slide counter e.g. "١ / ٧"
    slideCounter.textContent =
        toArabicNumerals(currentSlideIndex + 1) +
        ' / ' +
        toArabicNumerals(totalSlides);
}

// ── Navigate to a specific slide ─────────────────────────────
function goToSlide(index) {
    if (index === currentSlideIndex) return;
    slides[currentSlideIndex].classList.remove('active');
    currentSlideIndex = index;
    slides[currentSlideIndex].classList.add('active');
    updateControls();
}

function nextSlide() {
    if (currentSlideIndex < totalSlides - 1) goToSlide(currentSlideIndex + 1);
}

function prevSlide() {
    if (currentSlideIndex > 0) goToSlide(currentSlideIndex - 1);
}

// ── Initial setup ────────────────────────────────────────────
updateControls();

// ── Keyboard navigation (RTL: ← = next, → = prev) ───────────
document.addEventListener('keydown', function (e) {
    if (e.key === 'ArrowLeft')  nextSlide();
    if (e.key === 'ArrowRight') prevSlide();
});

// ── Touch / Swipe support ────────────────────────────────────
(function () {
    let startX = 0, startY = 0, isDragging = false;
    const SWIPE_THRESHOLD = 50;   // minimum px to count as a swipe
    const ANGLE_THRESHOLD = 35;   // max degrees from horizontal

    const container = document.querySelector('.presentation-container');

    container.addEventListener('touchstart', function (e) {
        const t = e.touches[0];
        startX = t.clientX;
        startY = t.clientY;
        isDragging = true;
    }, { passive: true });

    container.addEventListener('touchend', function (e) {
        if (!isDragging) return;
        isDragging = false;
        const t = e.changedTouches[0];
        const dx = t.clientX - startX;
        const dy = t.clientY - startY;
        const angle = Math.abs(Math.atan2(dy, dx) * (180 / Math.PI));

        // Only trigger if mostly horizontal
        if (Math.abs(dx) < SWIPE_THRESHOLD) return;
        if (angle > ANGLE_THRESHOLD && angle < (180 - ANGLE_THRESHOLD)) return;

        // In RTL layout: swipe right → prev, swipe left → next
        if (dx > 0) prevSlide();
        else        nextSlide();
    }, { passive: true });

    container.addEventListener('touchcancel', () => { isDragging = false; });
})();

// ── Theme Toggle ─────────────────────────────────────────────
function toggleTheme() {
    const body = document.body;
    body.classList.toggle('light-theme');
    const isLight = body.classList.contains('light-theme');
    document.querySelector('.theme-icon').textContent = isLight ? '☀️' : '🌙';
    localStorage.setItem('theme', isLight ? 'light' : 'dark');
}

// Load saved theme on boot
document.addEventListener('DOMContentLoaded', () => {
    const saved = localStorage.getItem('theme');
    if (saved === 'light') {
        document.body.classList.add('light-theme');
        document.querySelector('.theme-icon').textContent = '☀️';
    }
});

// ── Visual-tab switcher ───────────────────────────────────────
function switchVisual(button, index) {
    const container = button.closest('.visual-multi');

    container.querySelectorAll('.tab-btn').forEach((btn, i) => {
        btn.classList.toggle('active', i === index);
    });

    container.querySelectorAll('.tab-img').forEach((img, i) => {
        img.classList.toggle('active', i === index);
    });
}
