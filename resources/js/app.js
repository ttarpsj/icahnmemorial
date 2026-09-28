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
