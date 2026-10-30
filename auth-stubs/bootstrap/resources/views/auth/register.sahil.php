@extends('layouts.auth')

@section('title')Create account · {{ app_name ?? 'SahilPHP' }}@endsection

@section('content')
    <div class="text-center mb-4">
        <h1 class="h4 fw-semibold mb-1">Create your account</h1>
        <p class="text-muted small mb-0">Start building on SahilPHP in under a minute.</p>
    </div>

    <form method="post" action="/register">
        <input type="hidden" name="_token" value="{{ csrf_token }}">

        <div class="mb-3">
            <label class="form-label small fw-medium" for="name">Full name</label>
            <input class="form-control" id="name" name="name" type="text"
                placeholder="Ada Lovelace" autocomplete="name" required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-medium" for="email">Work email</label>
            <input class="form-control" id="email" name="email" type="email"
                placeholder="you@example.com" autocomplete="email" required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-medium" for="password">Password</label>
            <input class="form-control" id="password" name="password" type="password"
                placeholder="At least 8 characters" autocomplete="new-password" minlength="8" required>
            <div class="form-text">Use at least 8 characters, including a number.</div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-medium" for="password_confirmation">Confirm password</label>
            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password"
                placeholder="Repeat your password" autocomplete="new-password" required>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" id="terms" name="terms" type="checkbox" value="1" required>
            <label class="form-check-label small" for="terms">
                I agree to the <a class="text-decoration-none" href="#">terms</a> and
                <a class="text-decoration-none" href="#">privacy policy</a>.
            </label>
        </div>

        <button class="btn btn-primary w-100" type="submit">Create account</button>
    </form>

    <p class="text-center text-muted small mt-4 mb-0">
        Already have an account? <a class="text-decoration-none fw-medium" href="/login">Sign in</a>
    </p>
@endsection
