{{-- Sample plain-CSS layout. The `none` profile generates these classes. --}}
@extends('layouts.app')

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

@section('main_class')page@endsection

@section('footer')
    <footer class="page muted">
        <p>Plain CSS layout · Built with SahilPHP.</p>
    </footer>
@endsection
