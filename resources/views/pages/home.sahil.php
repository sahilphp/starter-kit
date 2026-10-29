@extends('layouts.app')

@section('title')Welcome · {{ app_name ?? 'SahilPHP' }}@endsection

@section('content')
    <h1>Welcome to {{ app_name ?? 'SahilPHP' }}</h1>
    <p>Your SahilPHP application is running. Choose a UI framework with <code>php bin/sahil ui:install</code>.</p>
@endsection
