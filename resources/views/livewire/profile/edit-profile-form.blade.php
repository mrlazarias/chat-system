<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Volt\Component;

new class extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $bio = '';
    public string $phone = '';
    public string $birth_date = '';
    public string $location = '';
    public string $website = '';
    public $avatar;
    public $currentAvatar = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->bio = $user->bio ?? '';
        $this->phone = $user->phone ?? '';
        $this->birth_date = $user->birth_date ? $user->birth_date->format('Y-m-d') : '';
        $this->location = $user->location ?? '';
        $this->website = $user->website ?? '';
        $this->currentAvatar = $user->avatar_url;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfile(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'bio' => ['nullable', 'string', 'max:1000'],
            'phone' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'location' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'], // 2MB max
        ]);

        // Handle avatar upload
        if ($this->avatar) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $avatarPath = $this->avatar->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Reset avatar input
        $this->avatar = null;
        $this->currentAvatar = $user->avatar_url;

        $this->dispatch('profile-updated', name: $user->name);
        session()->flash('status', 'Perfil atualizado com sucesso!');
    }

    /**
     * Remove the current avatar
     */
    public function removeAvatar(): void
    {
        $user = Auth::user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->update(['avatar' => null]);
            $this->currentAvatar = $user->avatar_url;

            session()->flash('status', 'Avatar removido com sucesso!');
        }
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informações do Perfil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Atualize as informações do seu perfil e personalize sua conta.
        </p>
    </header>

    <form wire:submit="updateProfile" class="mt-6 space-y-6">
        <!-- Avatar Section -->
        <div class="flex items-center space-x-6">
            <div class="shrink-0">
                <img class="h-16 w-16 object-cover rounded-full"
                     src="{{ $currentAvatar }}"
                     alt="Avatar atual">
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700">
                    Foto do Perfil
                </label>
                <div class="mt-1 flex items-center space-x-3">
                    <input wire:model="avatar"
                           type="file"
                           accept="image/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @if(Auth::user()->avatar)
                        <button type="button"
                                wire:click="removeAvatar"
                                class="text-sm text-red-600 hover:text-red-800">
                            Remover
                        </button>
                    @endif
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                <p class="mt-1 text-xs text-gray-500">PNG, JPG até 2MB</p>
            </div>
        </div>

        <!-- Basic Information -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <x-input-label for="name" value="Nome" />
                <x-text-input wire:model="name"
                              id="name"
                              name="name"
                              type="text"
                              class="mt-1 block w-full"
                              required
                              autofocus
                              autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input wire:model="email"
                              id="email"
                              name="email"
                              type="email"
                              class="mt-1 block w-full"
                              required
                              autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        <!-- Bio -->
        <div>
            <x-input-label for="bio" value="Biografia" />
            <textarea wire:model="bio"
                      id="bio"
                      name="bio"
                      rows="4"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                      placeholder="Conte um pouco sobre você..."></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
            <p class="mt-1 text-xs text-gray-500">Máximo 1000 caracteres</p>
        </div>

        <!-- Contact Information -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <x-input-label for="phone" value="Telefone" />
                <x-text-input wire:model="phone"
                              id="phone"
                              name="phone"
                              type="tel"
                              class="mt-1 block w-full"
                              autocomplete="tel"
                              placeholder="(11) 99999-9999" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <div>
                <x-input-label for="birth_date" value="Data de Nascimento" />
                <x-text-input wire:model="birth_date"
                              id="birth_date"
                              name="birth_date"
                              type="date"
                              class="mt-1 block w-full"
                              autocomplete="bday" />
                <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
            </div>
        </div>

        <!-- Location and Website -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <x-input-label for="location" value="Localização" />
                <x-text-input wire:model="location"
                              id="location"
                              name="location"
                              type="text"
                              class="mt-1 block w-full"
                              autocomplete="address-level2"
                              placeholder="São Paulo, Brasil" />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <div>
                <x-input-label for="website" value="Website" />
                <x-text-input wire:model="website"
                              id="website"
                              name="website"
                              type="url"
                              class="mt-1 block w-full"
                              autocomplete="url"
                              placeholder="https://seusite.com" />
                <x-input-error class="mt-2" :messages="$errors->get('website')" />
            </div>
        </div>

        <!-- Email Verification Notice -->
        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
            <div class="rounded-md bg-yellow-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-800">
                            Seu endereço de email não foi verificado.
                            <button wire:click.prevent="sendVerification" class="font-medium underline text-yellow-800 hover:text-yellow-600">
                                Clique aqui para reenviar o email de verificação.
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Success Message -->
        @if (session('status'))
            <div class="rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Submit Button -->
        <div class="flex items-center justify-end">
            <x-primary-button class="ml-4">
                Salvar Alterações
            </x-primary-button>
        </div>
    </form>
</section>
