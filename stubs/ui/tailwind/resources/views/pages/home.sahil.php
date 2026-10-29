@extends('layouts.app')

@section('title')Welcome · {{ app_name ?? 'SahilPHP' }}@endsection

@section('content')
    <div class="max-w-2xl mx-auto py-12">
        <h1 class="text-3xl font-bold text-slate-900 mb-4">Welcome to {{ app_name ?? 'SahilPHP' }}</h1>
        <p class="text-lg text-slate-600 mb-8">Your SahilPHP application is running with Tailwind CSS v4.</p>
    </div>
@endsection