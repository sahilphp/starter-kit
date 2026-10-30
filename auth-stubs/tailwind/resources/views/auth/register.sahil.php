@extends('layouts.auth')

@section('title')Create account · {{ app_name ?? 'SahilPHP' }}@endsection

@section('content')
    <div class="space-y-6">
        <div class="space-y-1.5 text-center">
            <h1 class="text-xl font-semibold tracking-tight">Create your account</h1>
            <p class="text-sm text-slate-500">Start building on SahilPHP in under a minute.</p>
        </div>

        <form class="space-y-4" method="post" action="/register">
            <input type="hidden" name="_token" value="{{ csrf_token }}">

            <div class="space-y-2">
                <label class="text-sm font-medium leading-none" for="name">Full name</label>
                <input class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm transition placeholder:text-slate-400 focus-visible:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30"
                    id="name" name="name" type="text" placeholder="Ada Lovelace"
                    autocomplete="name" required>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium leading-none" for="email">Work email</label>
                <input class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm transition placeholder:text-slate-400 focus-visible:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30"
                    id="email" name="email" type="email" placeholder="you@example.com"
                    autocomplete="email" required>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium leading-none" for="password">Password</label>
                <input class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm transition placeholder:text-slate-400 focus-visible:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30"
                    id="password" name="password" type="password" placeholder="At least 8 characters"
                    autocomplete="new-password" minlength="8" required>
                <p class="text-xs text-slate-500">Use at least 8 characters, including a number.</p>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium leading-none" for="password_confirmation">Confirm password</label>
                <input class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm transition placeholder:text-slate-400 focus-visible:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30"
                    id="password_confirmation" name="password_confirmation" type="password"
                    placeholder="Repeat your password" autocomplete="new-password" required>
            </div>

            <label class="flex items-start gap-2 text-sm text-slate-600" for="terms">
                <input class="mt-0.5 h-4 w-4 rounded border-slate-300 text-primary focus:ring-2 focus:ring-primary/30"
                    id="terms" name="terms" type="checkbox" value="1" required>
                <span>I agree to the <a class="font-medium text-primary hover:underline" href="#">terms</a> and
                    <a class="font-medium text-primary hover:underline" href="#">privacy policy</a>.</span>
            </label>

            <button class="inline-flex h-10 w-full items-center justify-center rounded-md bg-primary px-4 text-sm font-semibold text-primary-foreground shadow-sm transition hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40"
                type="submit">Create account</button>
        </form>

        <p class="text-center text-sm text-slate-500">
            Already have an account?
            <a class="font-medium text-primary hover:underline" href="/login">Sign in</a>
        </p>
    </div>
@endsection
