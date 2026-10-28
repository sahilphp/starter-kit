@extends('layouts.app')

@section('title')
    {{ title ?? 'SahilPHP' }}
@endsection

@section('content')
    <h1>{{ heading }}</h1>

    @if (empty(posts))
        <p>No posts yet.</p>
    @else
        <ul>
            @foreach (posts as index => post)
                <li>
                    <a href="/posts/{{ post.slug }}">{{ post.title }}</a>
                    @include('partials.post-meta', ['post' => post])
                    <small>#{{ index }}</small>
                </li>
            @endforeach
        </ul>

        <p>{{ count(posts) }} post(s).</p>
    @endif

    {{-- Raw output is opt-in and must only ever receive markup this application produced. --}}
    {!! attribution !!}
@endsection

@section('footer')
    @parent
    <p>Rendered {{ rendered_at }}.</p>
@endsection
