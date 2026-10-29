{{-- Shared navigation component for the Bootstrap profile. --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom container mx-auto">
    <a class="navbar-brand fw-bold" href="{{ home_url ?? '/' }}">{{ brand ?? 'SahilPHP' }}</a>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @foreach (links as link)
            <li class="nav-item">
                <a class="nav-link" href="{{ link.href }}"
                    @if (link.current ?? false) aria-current="page" @endif>{{ link.label }}</a>
            </li>
        @endforeach
    </ul>
</nav>
