{{-- Sample Tailwind CSS v4 layout. Extend this from a page. --}}
@extends('layouts.app')

@section('body_class')bg-slate-50 text-slate-900 antialiased@endsection

@section('nav')
    @include('partials.nav', [
        'brand' => 'SahilPHP',
        'header_class' => 'border-b border-slate-200 bg-white',
        'nav_class' => 'mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-4 py-4',
        'brand_class' => 'text-lg font-semibold tracking-tight text-slate-900',
        'list_class' => 'flex flex-wrap items-center gap-5',
        'link_class' => 'text-sm font-medium text-slate-600 hover:text-slate-950',
        'links' => [
            ['label' => 'Home', 'href' => '/'],
            ['label' => 'UI kit', 'href' => '/ui-kit'],
            ['label' => 'Health', 'href' => '/health'],
        ],
    ])
@endsection

@section('main_class')mx-auto w-full max-w-6xl px-4 py-10@endsection

@section('footer')
    <footer class="mx-auto max-w-6xl border-t border-slate-200 px-4 py-6 text-sm text-slate-500">
        <p>Tailwind CSS v4 layout · Built with SahilPHP.</p>
    </footer>
@endsection
