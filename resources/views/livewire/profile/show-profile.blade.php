<?php

use App\Models\User;
use Livewire\Volt\Component;

new class extends Component
{
    public User $user;

    public function mount(User $user): void
    {
        $this->user = $user;
    }
}; ?>

<div class="max-w-4xl mx-auto">
    <!-- Profile Header -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Cover/Header Section -->
        <div class="h-32 bg-gradient-to-r from-blue-500 to-purple-600"></div>

        <!-- Profile Info Section -->
        <div class="px-6 py-4">
            <div class="flex flex-col sm:flex-row sm:items-end sm:space-x-6">
                <!-- Avatar -->
                <div class="relative -mt-16 sm:-mt-12">
                    <img class="h-24 w-24 sm:h-32 sm:w-32 rounded-full border-4 border-white object-cover shadow-lg"
                         src="{{ $user->avatar_url }}"
                         alt="Avatar de {{ $user->name }}">
                </div>

                <!-- User Info -->
                <div class="mt-4 sm:mt-0 flex-1">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>

                    @if($user->bio)
                        <p class="mt-2 text-gray-600">{{ $user->bio }}</p>
                    @endif

                    <!-- User Stats/Meta -->
                    <div class="mt-4 flex flex-wrap gap-4 text-sm text-gray-500">
                        @if($user->location)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $user->location }}
                            </div>
                        @endif

                        @if($user->website)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                </svg>
                                <a href="{{ $user->website }}"
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ parse_url($user->website, PHP_URL_HOST) ?: $user->website }}
                                </a>
                            </div>
                        @endif

                        @if($user->birth_date)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Nasceu em {{ $user->birth_date->format('d/m/Y') }}
                            </div>
                        @endif

                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Membro desde {{ $user->created_at->format('M Y') }}
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                @if(auth()->id() === $user->id)
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('profile') }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Editar Perfil
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Additional Info Sections -->
    <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Contact Information -->
        @if($user->phone || $user->email)
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Contato</h3>

                <div class="space-y-3">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-gray-900">{{ $user->email }}</span>
                    </div>

                    @if($user->phone)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-gray-900">{{ $user->phone }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Recent Activity (placeholder for future features) -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Atividade Recente</h3>
            <div class="text-gray-500 text-sm">
                <p>Participou de {{ $user->conversations()->count() }} conversas</p>
                <p class="mt-2">Enviou {{ $user->messages()->count() }} mensagens</p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Estatísticas</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Conversas</span>
                    <span class="font-semibold text-gray-900">{{ $user->conversations()->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Mensagens</span>
                    <span class="font-semibold text-gray-900">{{ $user->messages()->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Membro há</span>
                    <span class="font-semibold text-gray-900">{{ $user->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
