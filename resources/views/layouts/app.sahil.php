{{-- Base layout: profile layouts and pages extend this and fill its sections. --}}
<!doctype html>
<html lang="{{ lang ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="SahilPHP">
    <meta name="theme-color" content="#0b6fe8">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- Firefiber's optional package-managed state styles. --}}
    @asset_css('@fiberstyles')
    <title>@yield('title', app_name ?? 'SahilPHP')</title>

    {{-- Page-specific styles: define a `head` section in the page. --}}
    @yield('head')
</head>
<body class="@yield('body_class')">
    @section('nav')
        @include('partials.nav', [
            'links' => [
                ['label' => 'Home', 'href' => '/'],
                ['label' => 'UI kit', 'href' => '/ui-kit'],
                ['label' => 'Health', 'href' => '/health'],
            ],
        ])
    @endsection

    @yield('nav')

    <main class="@yield('main_class', 'container')">
        @yield('content')
    </main>

    @section('footer')
        <footer class="site-footer">
            <div class="site-footer__inner">
                <div>
                    @include('partials.brand', ['variant' => 'mark', 'class' => 'brand'])
                    <p style="margin: .5rem 0 0;">Built with SahilPHP.</p>
                </div>

                <nav class="site-footer__links" aria-label="Footer navigation">
                    <a href="/">Home</a>
                    <a href="/ui-kit">UI kit</a>
                    <a href="/health">Health</a>
                </nav>
            </div>
        </footer>
    @endsection

    @yield('footer')

    {{-- Firefiber browser runtime from the installed Composer package. --}}
    @asset_js('@fiberscripts')
    @yield('scripts')
</body>
</html>
