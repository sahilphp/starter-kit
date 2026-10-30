@extends('layouts.auth')

@section('title')Reset password · {{ app_name ?? 'SahilPHP' }}@endsection

@section('content')
    <div class="text-center mb-4">
        <h1 class="h4 fw-semibold mb-1">Choose a new password</h1>
        <p class="text-muted small mb-0">
            Your reset link is single use. After saving, sign in with the new password.
        </p>
    </div>

    <form method="post" action="/reset-password/{{ token ?? '' }}">
        <input type="hidden" name="_token" value="{{ csrf_token }}">
        <input type="hidden" name="token" value="{{ token ?? '' }}">

        <div class="mb-3">
            <label class="form-label small fw-medium" for="email">Email</label>
            <input class="form-control" id="email" name="email" type="email"
                placeholder="you@example.com" autocomplete="email" required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-medium" for="password">New password</label>
            <input class="form-control" id="password" name="password" type="password"
                placeholder="At least 8 characters" autocomplete="new-password" minlength="8" required>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-medium" for="password_confirmation">Confirm new password</label>
            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password"
                placeholder="Repeat your password" autocomplete="new-password" required>
        </div>

        <button class="btn btn-primary w-100" type="submit">Reset password</button>
    </form>

    <p class="text-center small mt-4 mb-0">
        <a class="text-decoration-none fw-medium" href="/login">← Back to sign in</a>
    </p>
@endsection
