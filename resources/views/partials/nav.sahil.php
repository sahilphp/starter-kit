{{--
    Shared navigation component.

    Layouts pass framework-specific classes and the link list, so the same
    markup works with Tailwind, Bootstrap and plain CSS. Every attribute is
    escaped by the default `{{ }}` channel.
--}}
<header class="{{ header_class ?? 'site-header' }}">
    <nav class="{{ nav_class ?? 'site-nav' }}" aria-label="Main navigation">
        <a class="{{ brand_class ?? 'site-brand' }}" href="{{ home_url ?? '/' }}">{{ brand ?? 'SahilPHP' }}</a>

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
