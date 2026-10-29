{{
-- Bootstrap 5 layout.
--}}
<!doctype html>
<html lang="{{ lang ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="SahilPHP">
    <title>@yield('title', app_name ?? 'SahilPHP')</title>

    {{-- Vite HMR client (development only) and the active profile's CSS. --}}
    @asset_client
    @asset_css('main')

    {{-- Page-specific styles: define a `head` section in the page. --}}
    @yield('head')
</head>
<body class="@yield('body_class', 'bg-light')">
    @section('nav')
        @include('partials.nav', [
            'brand' => app_name ?? 'SahilPHP',
            'links' => [
                ['label' => 'Home', 'href' => '/'],
                ['label' => 'Health', 'href' => '/health'],
            ],
        ])
    @endsection

    @yield('nav')

    <main class="@yield('main_class', 'container py-5')">
        @yield('content')
    </main>

    @section('footer')
        <footer class="border-top bg-white py-3 mt-5">
            <div class="container text-muted small">
                <p>Built with SahilPHP.</p>
            </div>
        </footer>
    @endsection

    @yield('footer')

    {{-- Profile JavaScript, then page-specific scripts. --}}
    @asset_js('main')
    @yield('scripts')
</body>
</html>
