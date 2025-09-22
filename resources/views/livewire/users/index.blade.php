<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $search = '';

    public function with(): array
    {
        return [
            'users' => User::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('bio', 'like', '%' . $this->search . '%')
                      ->orWhere('location', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(12)
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}; ?>

<div>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Usuários da Comunidade
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Conheça outros membros da nossa comunidade
                </p>
            </div>
        </div>

        <!-- Search -->
        <div class="mb-6">
            <div class="max-w-md">
                <label for="search" class="sr-only">Buscar usuários</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input wire:model.live="search"
                           id="search"
                           type="text"
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Buscar por nome, email, bio ou localização...">
                </div>
            </div>
        </div>

        <!-- Users Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($users as $user)
                <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-200">
                    <div class="p-6">
                        <!-- User Avatar and Name -->
                        <div class="flex items-center">
                            <img class="h-12 w-12 rounded-full object-cover"
                                 src="{{ $user->avatar_url }}"
                                 alt="Avatar de {{ $user->name }}">
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $user->name }}</h3>
                                @if($user->location)
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $user->location }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Bio -->
                        @if($user->bio)
                            <p class="mt-4 text-sm text-gray-600 line-clamp-3">
                                {{ $user->bio }}
                            </p>
                        @endif

                        <!-- Stats -->
                        <div class="mt-4 grid grid-cols-2 gap-4 text-center">
                            <div>
                                <p class="text-lg font-semibold text-gray-900">{{ $user->messages()->count() }}</p>
                                <p class="text-xs text-gray-500">Mensagens</p>
                            </div>
                            <div>
                                <p class="text-lg font-semibold text-gray-900">{{ $user->conversations()->count() }}</p>
                                <p class="text-xs text-gray-500">Conversas</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 flex space-x-3">
                            <a href="{{ route('profile.show', $user) }}"
                               class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors duration-200">
                                Ver Perfil
                            </a>
                            @if(auth()->id() !== $user->id)
                                <button class="flex-1 bg-gray-100 text-gray-700 text-center py-2 px-4 rounded-md text-sm font-medium hover:bg-gray-200 transition-colors duration-200">
                                    Conversar
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum usuário encontrado</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @if($search)
                                Tente buscar com outros termos.
                            @else
                                Não há usuários cadastrados ainda.
                            @endif
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="mt-8">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
