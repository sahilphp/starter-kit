{{-- Tailwind CSS v4 layout. Extends the neutral base structure with utility classes. --}}
<!doctype html>
<html lang="{{ lang ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="SahilPHP">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <title>@yield('title', app_name ?? 'SahilPHP')</title>

    {{-- Vite HMR client (development only) and the active profile's CSS. --}}
    @asset_client
    @asset_css('main')

    {{-- Page-specific styles: define a `head` section in the page. --}}
    @yield('head')
</head>
<body class="@yield('body_class', 'bg-slate-50 text-slate-900 antialiased')">
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

    <main class="@yield('main_class', 'mx-auto w-full max-w-6xl px-4 py-10')">
        @yield('content')
    </main>

    @section('footer')
        <footer class="mx-auto max-w-6xl border-t border-slate-200 px-4 py-6 text-sm text-slate-500">
            <p>Built with SahilPHP.</p>
        </footer>
    @endsection

    @yield('footer')

    {{-- Profile JavaScript, then page-specific scripts. --}}
    @asset_js('main')
    @yield('scripts')
</body>
</html>
