<?php

test('the homepage and primary event pages are available', function () {
    foreach (['/', '/about', '/competition', '/athletes', '/timetable', '/news', '/media', '/results', '/contact'] as $url) {
        $this->get($url)->assertOk();
    }
});

test('news articles resolve and unknown stories do not', function () {
    $this->get('/news/the-night-session-takes-shape')->assertOk()->assertSee('The night session takes shape');
    $this->get('/news/not-a-story')->assertNotFound();
});

test('competition presents its central information', function () {
    $this->get('/competition')->assertOk()->assertSee('Event Details')->assertSee('Disciplines')->assertSee('FAQs');
});
