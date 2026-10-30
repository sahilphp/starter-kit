@extends('layouts.app')

@section('title')Welcome · {{ app_name ?? 'SahilPHP' }}@endsection

@section('content')
    <section class="hero">
        <span class="hero__badge"><span class="dot"></span> Application ready</span>

        <img class="hero__logo" src="{{ asset('logo.png') }}" alt="SahilPHP"
            width="380" height="160" decoding="async">

        <h1 class="hero__title">Welcome to <span class="hero__app">{{ app_name ?? 'SahilPHP' }}</span></h1>

        <p class="hero__lead">
            Your application is running on the SahilPHP framework. Routing, views,
            sessions, migrations, queues and the scheduler are wired up and ready
            for your first feature.
        </p>

        <div class="hero__actions">
            <a class="btn btn--primary" href="/ui-kit">Explore the UI kit</a>
            <a class="btn btn--ghost" href="/health">Check health endpoint</a>
        </div>

        <p class="hero__meta">
            PHP {{ php_version ?? '' }} · {{ profile_label ?? 'Plain CSS profile' }}
        </p>
    </section>

    <section class="terminal" aria-label="Useful commands">
        <div class="terminal__bar">
            <span class="terminal__dot"></span>
            <span class="terminal__dot"></span>
            <span class="terminal__dot"></span>
            <span class="terminal__label">Terminal</span>
        </div>

        <ul class="terminal__body">
            <li><span class="terminal__prompt">$</span> php sahil start <span class="terminal__note">dev server</span></li>
            <li><span class="terminal__prompt">$</span> php sahil make:auth <span class="terminal__note">auth pages</span></li>
            <li><span class="terminal__prompt">$</span> php sahil migrate <span class="terminal__note">database</span></li>
        </ul>
    </section>

    <section class="features">
        <h2 class="features__heading">Everything is already connected</h2>
        <p class="features__intro">Start in <code>routes/web.php</code>, build views in <code>resources/views</code>.</p>

        <div class="features__grid">
            <article class="card">
                <span class="card__icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 7h10a4 4 0 0 1 0 8H8"></path><path d="M11 18l-3 3 3 3"></path>
                    </svg>
                </span>
                <h3 class="card__title">Routing &amp; HTTP</h3>
                <p class="card__text">Named routes, middleware, CSRF protection and JSON responses are registered at boot.</p>
            </article>

            <article class="card">
                <span class="card__icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 5h16v12H4z"></path><path d="M8 21h8"></path><path d="M12 17v4"></path>
                    </svg>
                </span>
                <h3 class="card__title">Templates &amp; views</h3>
                <p class="card__text">Layouts, sections and partials with escaping by default and compiled views cached on disk.</p>
            </article>

            <article class="card">
                <span class="card__icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path>
                    </svg>
                </span>
                <h3 class="card__title">Queues &amp; scheduler</h3>
                <p class="card__text">Background jobs, retries and scheduled tasks run through one CLI entry point.</p>
            </article>
        </div>
    </section>
@endsection
