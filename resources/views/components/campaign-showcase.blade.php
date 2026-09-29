@php($campaign = config('campaign'))
<section class="campaign-showcase" data-campaign-carousel aria-labelledby="campaign-heading">
    <div class="campaign-intro">
        <p class="eyebrow">The campaign</p>
        <div>
            <h2 id="campaign-heading">Made for the moment.</h2>
            <p>A collection of campaign material, event imagery, and promotional work created around the meeting.</p>
        </div>
    </div>
    <div class="campaign-carousel">
        <div class="campaign-viewport" data-campaign-viewport aria-label="Campaign showcase">
            @foreach($campaign as $item)
                <article class="campaign-slide" data-campaign-slide>
                    <div class="campaign-media campaign-media--contain">
                        <img
                            src="{{ asset($item['path']) }}"
                            alt="{{ $item['alt'] }}"
                            loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                            @if($loop->first) fetchpriority="high" @endif
                        >
                    </div>
                    <div class="campaign-caption">
                        <p class="eyebrow">{{ $item['category'] }}</p>
                        <h3>{{ $item['title'] }}</h3>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="campaign-controls">
            <div class="campaign-arrows">
                <button type="button" data-campaign-prev aria-label="Previous campaign item">←</button>
                <button type="button" data-campaign-next aria-label="Next campaign item">→</button>
            </div>
            <p class="campaign-counter" aria-live="polite"><span data-campaign-current>01</span> / {{ str_pad(count($campaign), 2, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>
</section>
