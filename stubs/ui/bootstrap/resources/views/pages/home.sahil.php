@extends('layouts.app')

@section('title')Welcome · {{ app_name ?? 'SahilPHP' }}@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">Welcome to {{ app_name ?? 'SahilPHP' }}</h1>
                <p class="lead">Your SahilPHP application is running with Bootstrap 5.</p>
            </div>
        </div>
    </div>
@endsection