@php
    $social = $siteSettings->social_links ?? [];
    $profiles = [
        'chorki' => ['label' => 'Chorki', 'mark' => 'C'],
        'imdb' => ['label' => 'IMDb', 'mark' => 'IMDb'],
        'facebook' => ['label' => 'Facebook', 'mark' => 'f'],
        'youtube' => ['label' => 'YouTube', 'mark' => '▶'],
        'wikipedia' => ['label' => 'Wikipedia', 'mark' => 'W'],
    ];
@endphp
@foreach($profiles as $key => $profile)
    @if(filled($social[$key] ?? null))
        @php
            $socialLinkIsExternal = \Illuminate\Support\Str::startsWith($social[$key], ['http://', 'https://']);
        @endphp
        <a class="social-link social-link-{{ $key }} {{ $key === 'chorki' ? 'chorki' : '' }}" href="{{ $social[$key] }}" @if($socialLinkIsExternal) target="_blank" rel="noopener noreferrer" @endif aria-label="{{ $profile['label'] }}">
            <span class="social-icon" aria-hidden="true">{{ $profile['mark'] }}</span>
            <span>{{ $profile['label'] }}</span>
        </a>
    @endif
@endforeach
