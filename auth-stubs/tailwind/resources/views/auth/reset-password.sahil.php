@extends('layouts.auth')

@section('title')Reset password · {{ app_name ?? 'SahilPHP' }}@endsection

@section('content')
    <div class="space-y-6">
        <div class="space-y-1.5 text-center">
            <h1 class="text-xl font-semibold tracking-tight">Choose a new password</h1>
            <p class="text-sm text-slate-500">
                Your reset link is single use. After saving, sign in with the new password.
            </p>
        </div>

        <form class="space-y-4" method="post" action="/reset-password/{{ token ?? '' }}">
            <input type="hidden" name="_token" value="{{ csrf_token }}">
            <input type="hidden" name="token" value="{{ token ?? '' }}">

            <div class="space-y-2">
                <label class="text-sm font-medium leading-none" for="email">Email</label>
                <input class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm transition placeholder:text-slate-400 focus-visible:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30"
                    id="email" name="email" type="email" placeholder="you@example.com"
                    autocomplete="email" required>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium leading-none" for="password">New password</label>
                <input class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm transition placeholder:text-slate-400 focus-visible:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30"
                    id="password" name="password" type="password" placeholder="At least 8 characters"
                    autocomplete="new-password" minlength="8" required>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium leading-none" for="password_confirmation">Confirm new password</label>
                <input class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm transition placeholder:text-slate-400 focus-visible:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30"
                    id="password_confirmation" name="password_confirmation" type="password"
                    placeholder="Repeat your password" autocomplete="new-password" required>
            </div>

            <button class="inline-flex h-10 w-full items-center justify-center rounded-md bg-primary px-4 text-sm font-semibold text-primary-foreground shadow-sm transition hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40"
                type="submit">Reset password</button>
        </form>

        <p class="text-center text-sm text-slate-500">
            <a class="font-medium text-primary hover:underline" href="/login">← Back to sign in</a>
        </p>
    </div>
@endsection
