{{--
    Shared navigation component.

    Layouts pass framework-specific classes and the link list, so the same
    markup works with Tailwind, Bootstrap and plain CSS. The brand slot always
    renders the official SahilPHP logo through `partials.brand`; a caller can
    override it with `brand_partial`.
--}}
<header class="{{ header_class ?? 'site-header' }}">
    <nav class="{{ nav_class ?? 'site-nav' }}" aria-label="Main navigation">
        @include(brand_partial ?? 'partials.brand', [
            'home_url' => home_url ?? '/',
            'class' => brand_class ?? 'brand',
            'variant' => brand_variant ?? 'wordmark',
        ])

        <ul class="{{ list_class ?? 'site-nav__list' }}">
            @foreach (links as link)
                <li>
                    <a class="{{ link_class ?? 'site-nav__link' }}" href="{{ link.href }}"
                        @if (link.current ?? false) aria-current="page" @endif>{{ link.label }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
</header>
