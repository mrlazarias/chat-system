<div class="flex flex-col h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b px-6 py-4">
        <h1 class="text-xl font-semibold text-gray-900">Chat Geral</h1>
        <p class="text-sm text-gray-500">Converse em tempo real</p>
    </div>

    <!-- Messages Area -->
    <div id="messages" class="flex-1 overflow-y-auto p-6 space-y-4">
        @forelse($messages as $message)
            <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->user_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-white text-gray-800 shadow-sm' }}">
                    @if($message->user_id !== auth()->id())
                        <div class="text-xs font-medium text-gray-500 mb-1">{{ $message->user->name }}</div>
                    @endif
                    <div class="text-sm">{{ $message->body }}</div>
                    <div class="text-xs {{ $message->user_id === auth()->id() ? 'text-blue-100' : 'text-gray-400' }} mt-1">
                        {{ $message->created_at->format('H:i') }}
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 mt-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <p class="mt-2">Nenhuma mensagem ainda. Seja o primeiro a enviar!</p>
            </div>
        @endforelse
    </div>

    <!-- Message Input -->
    <div class="bg-white border-t px-6 py-4">
        <form wire:submit.prevent="sendMessage" class="flex space-x-4">
            <input type="text"
                   wire:model.defer="messageText"
                   placeholder="Digite sua mensagem..."
                   class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   required>
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Enviar
            </button>
        </form>
    </div>
</div>

<script>
    // Scroll automático ao receber mensagem
    document.addEventListener('livewire:init', () => {
        Livewire.on('messageReceived', () => {
            let messages = document.getElementById('messages');
            messages.scrollTop = messages.scrollHeight;
        });
    });
</script>
