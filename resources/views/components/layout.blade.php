@props(['title' => null, 'hero' => false])
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>{{ $title ? $title.' · ' : '' }}{{ config('event.name') }}</title>@vite(['resources/css/app.css', 'resources/js/app.js'])</head>
<body class="{{ $hero ? 'has-hero' : '' }}"><x-header :overlay="$hero" />{{ $slot }}<x-footer /></body></html>
