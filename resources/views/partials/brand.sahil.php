{{--
    SahilPHP brand lockup.

    The official framework logo ships with every project: `public/logo.png`
    (mark + wordmark), `public/logo-mark.png` (mark only) and `favicon.ico`.
    Layouts pass the classes that match their UI profile, so the same markup
    works for Tailwind, Bootstrap and plain CSS.

    Usage:
        @include('partials.brand', ['home_url' => '/'])
        @include('partials.brand', ['variant' => 'mark'])
--}}
<a class="{{ class ?? 'brand' }}" href="{{ home_url ?? '/' }}" aria-label="SahilPHP home">
    @if ((variant ?? 'wordmark') == 'mark')
        <img class="brand__logo brand__logo--mark" src="{{ asset('logo-mark.png') }}" alt="SahilPHP"
            width="109" height="160" decoding="async">
    @else
        <img class="brand__logo" src="{{ asset('logo.png') }}" alt="SahilPHP"
            width="380" height="160" decoding="async">
    @endif
</a>
