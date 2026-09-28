<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/competition', 'competition')->name('competition');
Route::view('/athletes', 'athletes')->name('athletes');
Route::view('/timetable', 'timetable')->name('timetable');
Route::view('/news', 'news')->name('news');
Route::view('/media', 'media')->name('media');
Route::view('/results', 'results')->name('results');
Route::view('/contact', 'contact')->name('contact');
Route::get('/news/{slug}', function (string $slug) {
    $article = collect(config('event.news'))->firstWhere('slug', $slug);
    abort_unless($article, 404);
    return view('news-show', compact('article'));
})->name('news.show');
