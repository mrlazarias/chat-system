@props(['user', 'showBio' => false, 'size' => 'md'])

@php
    $sizeClasses = [
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
        'lg' => 'w-16 h-16 text-lg',
        'xl' => 'w-20 h-20 text-xl'
    ];
    $avatarSize = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center space-x-3']) }}>
    <img class="{{ $avatarSize }} rounded-full object-cover"
         src="{{ $user->avatar_url }}"
         alt="Avatar de {{ $user->name }}">

    <div class="flex-1 min-w-0">
        <p class="font-medium text-gray-900 truncate">{{ $user->name }}</p>

        @if($user->email && !$showBio)
            <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>
        @endif

        @if($showBio && $user->bio)
            <p class="text-sm text-gray-600 line-clamp-2">{{ $user->bio }}</p>
        @endif

        @if($user->location)
            <div class="flex items-center text-xs text-gray-500 mt-1">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $user->location }}
            </div>
        @endif
    </div>

    @if(isset($actions))
        <div class="flex-shrink-0">
            {{ $actions }}
        </div>
    @endif
</div>
