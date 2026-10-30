@extends('layouts.auth')

@section('title')Sign in · {{ app_name ?? 'SahilPHP' }}@endsection

@section('content')
    <div class="space-y-6">
        <div class="space-y-1.5 text-center">
            <h1 class="text-xl font-semibold tracking-tight">Sign in</h1>
            <p class="text-sm text-slate-500">Enter your credentials to open your dashboard.</p>
        </div>

        <form class="space-y-4" method="post" action="/login">
            <input type="hidden" name="_token" value="{{ csrf_token }}">

            <div class="space-y-2">
                <label class="text-sm font-medium leading-none" for="email">Email</label>
                <input class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm transition placeholder:text-slate-400 focus-visible:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30"
                    id="email" name="email" type="email" value="" placeholder="you@example.com"
                    autocomplete="email" required>
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label class="text-sm font-medium leading-none" for="password">Password</label>
                    <a class="text-xs font-medium text-primary hover:underline" href="/forgot-password">Forgot password?</a>
                </div>
                <input class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm transition placeholder:text-slate-400 focus-visible:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30"
                    id="password" name="password" type="password" placeholder="••••••••"
                    autocomplete="current-password" required>
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-600" for="remember">
                <input class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-2 focus:ring-primary/30"
                    id="remember" name="remember" type="checkbox" value="1">
                Remember me for 30 days
            </label>

            <button class="inline-flex h-10 w-full items-center justify-center rounded-md bg-primary px-4 text-sm font-semibold text-primary-foreground shadow-sm transition hover:opacity-90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40"
                type="submit">Sign in</button>
        </form>

        <p class="text-center text-sm text-slate-500">
            Don't have an account?
            <a class="font-medium text-primary hover:underline" href="/register">Create one</a>
        </p>
    </div>
@endsection
