{{-- Base layout: profile layouts and pages extend this and fill its sections. --}}
<!doctype html>
<html lang="{{ lang ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SahilPHP')</title>

    {{-- Vite HMR client (development only) and the active profile's CSS. --}}
    @asset_client
    @asset_css('main')

    {{-- Page-specific styles: define a `head` section in the page. --}}
    @yield('head')
</head>
<body class="@yield('body_class')">
    @section('nav')
        @include('partials.nav', [
            'brand' => 'SahilPHP',
            'header_class' => 'site-header',
            'nav_class' => 'site-nav',
            'brand_class' => 'site-brand',
            'list_class' => 'site-nav__list',
            'link_class' => 'site-nav__link',
            'links' => [
                ['label' => 'Home', 'href' => '/'],
                ['label' => 'UI kit', 'href' => '/ui-kit'],
                ['label' => 'Health', 'href' => '/health'],
            ],
        ])
    @endsection

    @yield('nav')

    <main class="@yield('main_class')">
        @yield('content')
    </main>

    @section('footer')
        <footer class="muted">
            <p>Built with SahilPHP.</p>
        </footer>
    @endsection

    @yield('footer')

    {{-- Profile JavaScript, then page-specific scripts. --}}
    @asset_js('main')
    @yield('scripts')
</body>
</html>
