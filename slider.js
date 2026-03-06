document.addEventListener('DOMContentLoaded', function () {
    const servicesGrid = document.querySelector('.services-grid');
    const dotsContainer = document.querySelector('.services-slider-dots');

    if (!servicesGrid || !dotsContainer) {
        return;
    }

    const cards = Array.from(servicesGrid.querySelectorAll('.service-card'));

    if (!cards.length) {
        dotsContainer.style.display = 'none';
        return;
    }

    let dots = [];

    function isMobileSlider() {
        return window.innerWidth <= 768;
    }

    function clearDots() {
        dotsContainer.innerHTML = '';
        dots = [];
    }

    function setActiveDot(index) {
        dots.forEach((dot, i) => {
            dot.classList.toggle('is-active', i === index);
        });
    }

    function getActiveIndex() {
        const gridRect = servicesGrid.getBoundingClientRect();
        const gridCenter = gridRect.left + gridRect.width / 2;

        let closestIndex = 0;
        let minDistance = Infinity;

        cards.forEach((card, index) => {
            const cardRect = card.getBoundingClientRect();
            const cardCenter = cardRect.left + cardRect.width / 2;
            const distance = Math.abs(gridCenter - cardCenter);

            if (distance < minDistance) {
                minDistance = distance;
                closestIndex = index;
            }
        });

        return closestIndex;
    }

    function scrollToCard(index) {
        const card = cards[index];

        if (!card) {
            return;
        }

        const left = card.offsetLeft - servicesGrid.offsetLeft;

        servicesGrid.scrollTo({
            left: left,
            behavior: 'smooth'
        });
    }

    function buildDots() {
        clearDots();

        if (!isMobileSlider()) {
            return;
        }

        cards.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.className = 'services-slider-dot';
            dot.setAttribute('aria-label', `Перейти к услуге ${index + 1}`);

            dot.addEventListener('click', function () {
                scrollToCard(index);
            });

            dotsContainer.appendChild(dot);
            dots.push(dot);
        });

        setActiveDot(getActiveIndex());
    }

    let scrollTimeout = null;

    function handleScroll() {
        if (!isMobileSlider() || !dots.length) {
            return;
        }

        if (scrollTimeout) {
            window.clearTimeout(scrollTimeout);
        }

        scrollTimeout = window.setTimeout(function () {
            setActiveDot(getActiveIndex());
        }, 40);
    }

    buildDots();
    handleScroll();

    servicesGrid.addEventListener('scroll', handleScroll);

    window.addEventListener('resize', function () {
        buildDots();
        handleScroll();
    });
});
