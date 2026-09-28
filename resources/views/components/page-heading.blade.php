@props(['eyebrow' => 'Aurora Track Night', 'title', 'intro' => null])
<section class="page-heading"><p class="eyebrow">{{ $eyebrow }}</p><h1>{{ $title }}</h1>@if($intro)<p class="lede">{{ $intro }}</p>@endif</section>
