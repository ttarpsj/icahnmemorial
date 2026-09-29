import './bootstrap';

document.querySelector('.menu-toggle')?.addEventListener('click', (event) => {
    const header = event.currentTarget.closest('.site-header');
    header.classList.toggle('open');
    event.currentTarget.setAttribute('aria-expanded', header.classList.contains('open'));
});

document.querySelectorAll('[data-schedule]').forEach((schedule) => {
    schedule.querySelectorAll('[data-schedule-tab]').forEach((button) => button.addEventListener('click', () => {
        const name = button.dataset.scheduleTab;
        schedule.querySelectorAll('[data-schedule-tab]').forEach((item) => item.classList.toggle('active', item === button));
        schedule.querySelectorAll('[data-schedule-panel]').forEach((panel) => panel.classList.toggle('active', panel.dataset.schedulePanel === name));
    }));
});

document.querySelectorAll('[data-info-tabs]').forEach((tabs) => {
    tabs.querySelectorAll('[data-info-tab]').forEach((button) => button.addEventListener('click', () => {
        const index = button.dataset.infoTab;
        tabs.querySelectorAll('[data-info-tab]').forEach((item) => item.classList.toggle('active', item === button));
        tabs.querySelectorAll('[data-info-panel]').forEach((panel) => panel.classList.toggle('active', panel.dataset.infoPanel === index));
    }));
});

document.querySelectorAll('[data-campaign-carousel]').forEach((carousel) => {
    const viewport = carousel.querySelector('[data-campaign-viewport]');
    const slides = [...carousel.querySelectorAll('[data-campaign-slide]')];
    const current = carousel.querySelector('[data-campaign-current]');
    let activeIndex = 0;
    let dragging = false;
    let dragStart = 0;
    let scrollStart = 0;

    const loadVideo = (index) => {
        const video = slides[index]?.querySelector('[data-campaign-video][data-src]');
        if (video && !video.src) {
            video.src = video.dataset.src;
            video.load();
        }
    };

    const updateActiveSlide = () => {
        const viewportCenter = viewport.scrollLeft + viewport.clientWidth / 2;
        const nextIndex = slides.reduce((closest, slide, index) => Math.abs((slide.offsetLeft + slide.offsetWidth / 2) - viewportCenter) < Math.abs((slides[closest].offsetLeft + slides[closest].offsetWidth / 2) - viewportCenter) ? index : closest, 0);
        if (nextIndex === activeIndex) return;
        slides[activeIndex].querySelectorAll('video').forEach((video) => video.pause());
        activeIndex = nextIndex;
        loadVideo(activeIndex);
        current.textContent = String(activeIndex + 1).padStart(2, '0');
    };

    const goTo = (index) => {
        const nextIndex = (index + slides.length) % slides.length;
        slides[nextIndex].scrollIntoView({ behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth', block: 'nearest', inline: 'start' });
    };

    carousel.querySelector('[data-campaign-prev]').addEventListener('click', () => goTo(activeIndex - 1));
    carousel.querySelector('[data-campaign-next]').addEventListener('click', () => goTo(activeIndex + 1));
    viewport.addEventListener('scroll', updateActiveSlide, { passive: true });
    loadVideo(0);

    viewport.addEventListener('pointerdown', (event) => {
        if (event.target.closest('video, button')) return;
        dragging = true;
        dragStart = event.clientX;
        scrollStart = viewport.scrollLeft;
        viewport.classList.add('is-dragging');
        viewport.setPointerCapture(event.pointerId);
    });
    viewport.addEventListener('pointermove', (event) => {
        if (!dragging) return;
        viewport.scrollLeft = scrollStart - (event.clientX - dragStart);
    });
    const stopDragging = () => {
        dragging = false;
        viewport.classList.remove('is-dragging');
    };
    viewport.addEventListener('pointerup', stopDragging);
    viewport.addEventListener('pointercancel', stopDragging);
});

document.querySelectorAll('.button-wipe').forEach((button) => {
    const label = document.createElement('span');
    label.className = 'button-wipe-label';
    label.textContent = button.textContent.trim();
    button.textContent = '';
    button.append(label);

    ['blue', 'yellow', 'green', 'red', 'white'].forEach(() => {
        const panel = document.createElement('span');
        panel.className = 'button-wipe-panel';
        button.append(panel);
    });

    button.addEventListener('mouseenter', () => {
        if (matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        if (button.classList.contains('is-wiping')) return;
        button.classList.add('is-wiping');
    });

    button.lastElementChild.addEventListener('animationend', () => button.classList.remove('is-wiping'));
});

document.querySelectorAll('[data-jumper-reveal]').forEach((composition) => {
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) {
        composition.classList.add('is-revealed');
        return;
    }
    composition.classList.add('is-pending');
    const observer = new IntersectionObserver(([entry]) => {
        if (!entry.isIntersecting) return;
        composition.classList.remove('is-pending');
        composition.classList.add('is-revealed');
        observer.disconnect();
    }, { threshold: 0.2 });
    observer.observe(composition);
});
