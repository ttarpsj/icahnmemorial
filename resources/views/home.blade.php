<x-layout :hero="true">
  <main>
    <section class="hero" style="background-image:url('{{ config('event.hero') }}')"><video class="hero-video" autoplay muted loop playsinline preload="metadata" poster="{{ config('event.hero') }}" aria-hidden="true" tabindex="-1">
        <source src="{{ asset('videos/icahn-memorial-hero.mp4') }}" type="video/mp4">
      </video>
      <div class="hero-overlay" aria-hidden="true"></div>
      <div class="hero-copy">
        <p class="eyebrow">{{ config('event.location') }}</p>
        <h1><span class="hero-edition">1ST</span><br><i>EDITION</i> ICAHN<br>MEMORIAL.</h1>
        <p class="hero-date">{{ config('event.date') }} <span>·</span> {{ config('event.venue') }}</p><a class="button light button-wipe" href="{{ route('timetable') }}">Explore the programme</a>
      </div>
      <div class="hero-index">01 / 05<br><span>Scroll to discover</span></div>
    </section>
    <section class="intro section">
      <p class="eyebrow">A meeting in motion</p><img class="intro-runner" src="{{ asset('images/icahn-runners-blue.png') }}" alt="" aria-hidden="true">
      <div>
        <h2>A new kind of summer athletics night.</h2>
        <p class="lede">Icahn Memorial brings elite competition, a full stadium and a generous welcome to one illuminated track. Every detail is illustrative—and ready to become your event’s own story.</p><a class="arrow-link" href="{{ route('about') }}">Meet the Icahn Memorial →</a>
      </div>
    </section>
    <section class="quick section" style="background-image:url('{{ asset('images/icahn-landscape-bw.png') }}')"><a href="{{ route('competition') }}"><b>Competition</b><span>Disciplines, awards & rules →</span></a><a href="{{ route('timetable') }}"><b>Timetable</b><span>From community to elite →</span></a><a href="{{ route('contact') }}"><b>Visit</b><span>Tickets, venue & access →</span></a></section>
    <section class="feature-split">
      <div class="feature-image jumper-reveal" data-jumper-reveal><img class="jumper-layer jumper-fill" src="{{ asset('images/icahn-jumper-yellow-fill.png') }}" alt="" aria-hidden="true"><img class="jumper-layer jumper-photo" src="{{ asset('images/icahn-jumper-yellow.png') }}" alt="Yellow-tinted athlete jumping"></div>
      <div class="feature-copy">
        <p class="eyebrow">Built for the moment</p>
        <h2>One track.<br>Every eye.</h2>
        <p>Fast races and field-event drama share a compact, fan-first stage. Discover the disciplines and the night’s rhythm.</p><a class="button" href="{{ route('competition') }}">Competition information</a><a class="arrow-link feature-time-standards" href="#">Time Standards →</a>
      </div>
    </section>
    <section class="section featured-athletes">
      <div class="section-title">
        <p class="eyebrow">Athletics legends</p>
        <h2>Featured athletes</h2><a class="arrow-link" href="{{ route('athletes') }}">View all profiles →</a>
      </div>
      <div class="athlete-grid">@foreach(config('event.athletes') as $athlete)<article class="athlete-card"><img src="{{ asset($athlete['image']) }}" alt="Portrait of {{ $athlete['name'] }}" loading="lazy">
          <div>
            <p>{{ $athlete['country'] }} · {{ $athlete['discipline'] }}</p>
            <h3>{{ $athlete['name'] }}</h3>
            @if(!empty($athlete['highlight']))
            <p class="athlete-highlight">{{ $athlete['highlight'] }}</p>
            @endif
          </div>
        </article>@endforeach</div>
    </section>
    <section class="dark-section section timetable-section">
      <div class="section-title">
        <div>
          <p class="eyebrow">On the clock</p>
          <h2>Timetable</h2>
        </div><a class="arrow-link" href="{{ route('timetable') }}">Full timetable →</a>
      </div><x-timetable />
    </section>
    <section class="section latest-news">
      <div class="section-title">
        <div>
          <p class="eyebrow">Journal</p>
          <h2>Latest news</h2>
        </div><a class="arrow-link" href="{{ route('news') }}">All stories →</a>
      </div>
      <div class="news-grid">@foreach(config('event.news') as $article)<x-news-card :article="$article" />@endforeach</div>
    </section>
    <section class="media-banner" style="background-image:linear-gradient(90deg,rgba(8,16,28,.8),rgba(8,16,28,.25)),url('{{ asset('images/icahn-seating-bw.png') }}')">
      <p class="eyebrow">Watch the night unfold</p>
      <h2>At the stadium<br>and around the world.</h2><a class="button light button-wipe" href="{{ route('media') }}">Media & broadcast</a>
    </section><x-campaign-showcase />
  </main>
</x-layout>
