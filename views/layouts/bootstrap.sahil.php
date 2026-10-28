{{-- Sample Bootstrap 5 layout. Extend this from a page. --}}
@extends('layouts.app')

@section('body_class')bg-light@endsection

@section('nav')
    @include('partials.nav', [
        'brand' => 'SahilPHP',
        'header_class' => 'bg-white border-bottom',
        'nav_class' => 'navbar navbar-expand-lg navbar-light bg-white container',
        'brand_class' => 'navbar-brand fw-bold',
        'list_class' => 'navbar-nav ms-auto mb-2 mb-lg-0',
        'link_class' => 'nav-link',
        'links' => [
            ['label' => 'Home', 'href' => '/'],
            ['label' => 'UI kit', 'href' => '/ui-kit'],
            ['label' => 'Health', 'href' => '/health'],
        ],
    ])
@endsection

@section('main_class')container py-5@endsection

@section('footer')
    <footer class="border-top bg-white py-3 mt-5">
        <div class="container text-muted small">
            Bootstrap 5 layout · Built with SahilPHP.
        </div>
    </footer>
@endsection
