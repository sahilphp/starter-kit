{{-- Shared navigation component for the Tailwind profile. --}}
<header class="border-b border-slate-200 bg-white sticky top-0 z-10">
    <nav class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-4 py-4" aria-label="Main navigation">
        <a class="text-lg font-semibold tracking-tight text-slate-900" href="{{ home_url ?? '/' }}">{{ brand ?? 'SahilPHP' }}</a>

        <ul class="flex flex-wrap items-center gap-5">
            @foreach (links as link)
                <li>
                    <a class="text-sm font-medium text-slate-600 hover:text-slate-950" href="{{ link.href }}"
                        @if (link.current ?? false) aria-current="page" @endif>{{ link.label }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
</header>
