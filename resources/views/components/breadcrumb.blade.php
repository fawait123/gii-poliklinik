@props([
    'pageName' => 'Dashboard',
    'items' => null, // Array of breadcrumb items: [['label' => 'Home', 'url' => '/'], ['label' => 'Users']]
])

@php
    // If items not provided, create default breadcrumb
    if (!$items) {
        $items = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => $pageName]
        ];
    }
@endphp

<div class="flex flex-col flex-wrap items-start">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">{{ $pageName }}</h2>

    <nav>
        <ol class="flex items-center gap-1.5">
            @foreach($items as $index => $item)
                <li class="flex items-center gap-1.5">
                    @if(isset($item['url']) && $index < count($items) - 1)
                        <a class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300" href="{{ $item['url'] }}">
                            {{ $item['label'] }}
                        </a>
                        <svg class="stroke-current text-gray-500 dark:text-gray-400" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @else
                        <span class="text-sm text-gray-800 dark:text-white/90">{{ $item['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
</div>
