<div class="h-screen bg-gradient-to-br from-purple-50 to-blue-50 flex">
    <!-- Sidebar Esquerda -->
    <div class="w-80 bg-gray-800 text-white flex flex-col">
        <!-- Header -->
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold">ChatApp</h1>
                    <p class="text-gray-400 text-sm">Sistema de Chat</p>
                </div>
            </div>
        </div>

        <!-- Menu de Navegação -->
        <div class="flex-1 p-4">
            <nav class="space-y-2">
                <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-gray-700 text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"></path>
                    </svg>
                    <span>Todos os chats</span>
                    <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">43</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Trabalho</span>
                    <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">4</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-6a3 3 0 00-3-3H5a3 3 0 00-3 3v6h14z"></path>
                    </svg>
                    <span>Amigos</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z"></path>
                    </svg>
                    <span>Notícias</span>
                </a>
            </nav>
        </div>

        <!-- Perfil do Usuário -->
        <div class="p-4 border-t border-gray-700">
            <div class="flex items-center space-x-3">
                <img class="w-10 h-10 rounded-full object-cover"
                     src="{{ auth()->user()->avatar_url }}"
                     alt="Avatar de {{ auth()->user()->name }}">
                <div class="flex-1">
                    <p class="font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-gray-400 text-sm">Online</p>
                </div>
                <a href="{{ route('profile') }}"
                   class="text-gray-400 hover:text-white"
                   title="Editar perfil">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Área Principal do Chat -->
    <div class="flex-1 flex flex-col bg-white">
        <!-- Header do Chat -->
        <div class="p-6 border-b border-gray-200 bg-white">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Chat Geral</h2>
                    <p class="text-gray-600">2 membros, 2 online</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"></path>
                        </svg>
                    </button>
                    <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                    </button>
                    <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                        </svg>
                    </button>
                    <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Área de Mensagens -->
        <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50" id="messages">
            @forelse($messages as $message)
                <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}" data-message-id="{{ $message->id }}">
                    @if($message->user_id !== auth()->id())
                        <!-- Avatar do remetente -->
                        <div class="flex-shrink-0 mr-3">
                            <img class="w-8 h-8 rounded-full object-cover"
                                 src="{{ $message->user->avatar_url }}"
                                 alt="Avatar de {{ $message->user->name }}">
                        </div>
                    @endif

                    <div class="max-w-xs lg:max-w-md">
                        @if($message->user_id !== auth()->id())
                            <div class="text-xs font-medium text-gray-500 mb-1">{{ $message->user->name }}</div>
                        @endif

                        <div class="px-4 py-3 text-black" style="{{ $this->getUserColor($message->user_id) }}">
                            <div class="text-sm font-medium">{{ $message->body }}</div>
                            <div class="text-xs text-gray-800 opacity-75 mt-1 flex items-center justify-end">
                                <span>{{ $message->created_at->format('H:i') }}</span>
                                @if($message->user_id === auth()->id())
                                    <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($message->user_id === auth()->id())
                        <!-- Avatar do usuário atual -->
                        <div class="flex-shrink-0 ml-3">
                            <img class="w-8 h-8 rounded-full object-cover"
                                 src="{{ auth()->user()->avatar_url }}"
                                 alt="Avatar de {{ auth()->user()->name }}">
                        </div>
                    @endif
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

        <!-- Input de Mensagem -->
        <div class="p-6 border-t border-gray-200 bg-white">
            <form wire:submit.prevent="sendMessage" class="flex items-center space-x-4">
                <button type="button" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <div class="flex-1 relative">
                    <input
                        type="text"
                        wire:model.defer="messageText"
                        placeholder="Digite sua mensagem..."
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"
                        required
                    >
                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 p-1 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <button type="button" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4z"></path>
                        <path d="M5.5 9.643a.75.75 0 00-1.5 0V10c0 3.06 2.29 5.585 5.25 5.954V17.5a.75.75 0 001.5 0v-1.546A6.001 6.001 0 0016 10v-.357a.75.75 0 00-1.5 0V10a4.5 4.5 0 11-9 0v-.357z"></path>
                    </svg>
                </button>

                <button
                    type="submit"
                    class="p-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-2xl hover:from-purple-600 hover:to-pink-600 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105"
                >
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                    </svg>
                </button>
    </form>
        </div>
    </div>

    <!-- Sidebar Direita (Info do Grupo) -->
    <div class="w-80 bg-gray-800 text-white">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold">Informações do Grupo</h3>
                <button class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <!-- Arquivos -->
            <div>
                <h4 class="text-sm font-semibold text-gray-300 mb-3">Arquivos</h4>
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-400">265 fotos</span>
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-400">13 vídeos</span>
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-400">378 arquivos</span>
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Membros -->
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-sm font-semibold text-gray-300">2 membros</h4>
                    <button class="text-gray-400 hover:text-white">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="space-y-3">
                    @foreach($messages->pluck('user')->unique() as $user)
                        <div class="flex items-center space-x-3">
                            <img class="w-8 h-8 rounded-full object-cover"
                                 src="{{ $user->avatar_url }}"
                                 alt="Avatar de {{ $user->name }}">
                            <div class="flex-1">
                                <p class="text-sm font-medium">{{ $user->name }}</p>
                                <p class="text-xs text-gray-400">Online</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let websocket = null;
    let reconnectAttempts = 0;
    const maxReconnectAttempts = 5;

    document.addEventListener('livewire:init', () => {
    // Scroll automático ao receber mensagem
    Livewire.on('messageReceived', () => {
            scrollToBottom();
        });

        // Conectar ao WebSocket real
        connectWebSocket();
    });

    function connectWebSocket() {
        try {
            websocket = new WebSocket('ws://localhost:6001');

            websocket.onopen = function(event) {
                console.log('WebSocket conectado com sucesso!');
                reconnectAttempts = 0;

                // Enviar mensagem de identificação
                websocket.send(JSON.stringify({
                    type: 'join',
                    conversationId: {{ $conversationId }},
                    userId: {{ auth()->id() }}
                }));
            };

            websocket.onmessage = function(event) {
                try {
                    const data = JSON.parse(event.data);
                    console.log('Mensagem recebida via WebSocket:', data);

                    if (data.type === 'message' && data.conversationId === {{ $conversationId }}) {
                        addMessageToInterface(data);
                        scrollToBottom();
                    }
                } catch (error) {
                    console.error('Erro ao processar mensagem WebSocket:', error);
                }
            };

            websocket.onclose = function(event) {
                console.log('WebSocket desconectado. Tentando reconectar...');
                if (reconnectAttempts < maxReconnectAttempts) {
                    setTimeout(() => {
                        reconnectAttempts++;
                        connectWebSocket();
                    }, 2000 * reconnectAttempts);
                } else {
                    console.warn('Máximo de tentativas de reconexão atingido. Usando fallback com polling.');
                    startPollingFallback();
                }
            };

            websocket.onerror = function(error) {
                console.error('Erro no WebSocket:', error);
            };

        } catch (error) {
            console.error('Erro ao conectar WebSocket:', error);
            startPollingFallback();
        }
    }

    function addMessageToInterface(message) {
        console.log('Adicionando mensagem:', message);
        const messagesContainer = document.getElementById('messages');
        const isOwnMessage = message.user_id === {{ auth()->id() }};

        // Verificar se a mensagem já existe
        const existingMessage = messagesContainer.querySelector(`[data-message-id="${message.id}"]`);
        if (existingMessage) {
            console.log('Mensagem já existe, ignorando');
            return;
        }

        const messageElement = document.createElement('div');
        messageElement.className = `flex ${isOwnMessage ? 'justify-end' : 'justify-start'} mb-4`;
        messageElement.setAttribute('data-message-id', message.id);
        messageElement.style.minHeight = '50px'; // Garantir que seja visível

        // Cores para avatares
        const colors = [
            'bg-gradient-to-r from-blue-500 to-blue-600',
            'bg-gradient-to-r from-green-500 to-green-600',
            'bg-gradient-to-r from-purple-500 to-purple-600',
            'bg-gradient-to-r from-pink-500 to-pink-600',
            'bg-gradient-to-r from-indigo-500 to-indigo-600',
            'bg-gradient-to-r from-yellow-500 to-yellow-600',
            'bg-gradient-to-r from-red-500 to-red-600',
            'bg-gradient-to-r from-teal-500 to-teal-600',
            'bg-gradient-to-r from-orange-500 to-orange-600',
            'bg-gradient-to-r from-cyan-500 to-cyan-600',
        ];

        const userColor = colors[message.user_id % colors.length];

        // Cores inline para garantir que funcionem
        const colorStyles = [
            'background: linear-gradient(to right, #3b82f6, #2563eb); border-radius: 24px;',
            'background: linear-gradient(to right, #10b981, #059669); border-radius: 24px;',
            'background: linear-gradient(to right, #8b5cf6, #7c3aed); border-radius: 24px;',
            'background: linear-gradient(to right, #ec4899, #db2777); border-radius: 24px;',
            'background: linear-gradient(to right, #6366f1, #4f46e5); border-radius: 24px;',
            'background: linear-gradient(to right, #eab308, #ca8a04); border-radius: 24px;',
            'background: linear-gradient(to right, #ef4444, #dc2626); border-radius: 24px;',
            'background: linear-gradient(to right, #14b8a6, #0d9488); border-radius: 24px;',
            'background: linear-gradient(to right, #f97316, #ea580c); border-radius: 24px;',
            'background: linear-gradient(to right, #06b6d4, #0891b2); border-radius: 24px;',
        ];

        const userColorStyle = colorStyles[message.user_id % colorStyles.length];

        if (isOwnMessage) {
            messageElement.innerHTML = `
                <div class="max-w-xs lg:max-w-md">
                    <div class="px-4 py-3 text-black" style="${userColorStyle}">
                        <div class="text-sm font-medium">${message.body}</div>
                        <div class="text-xs mt-1 flex items-center justify-end" style="color: #1f2937; opacity: 0.75;">
                            <span>${new Date(message.created_at).toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'})}</span>
                            <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 ml-3">
                    <img class="w-8 h-8 rounded-full object-cover"
                         src="{{ auth()->user()->avatar_url }}"
                         alt="Avatar">
                </div>
            `;
        } else {

            messageElement.innerHTML = `
                <div class="flex-shrink-0 mr-3">
                    <img class="w-8 h-8 rounded-full object-cover"
                         src="${message.user.avatar_url || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(message.user.name) + '&color=7F9CF5&background=EBF4FF'}"
                         alt="Avatar de ${message.user.name}">
                </div>
                <div class="max-w-xs lg:max-w-md">
                    <div class="text-xs font-medium mb-1" style="color: #6b7280;">${message.user.name}</div>
                    <div class="px-4 py-3 text-black" style="${userColorStyle}">
                        <div class="text-sm font-medium">${message.body}</div>
                        <div class="text-xs mt-1 flex items-center justify-end" style="color: #1f2937; opacity: 0.75;">
                            <span>${new Date(message.created_at).toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'})}</span>
                        </div>
                    </div>
                </div>
            `;
        }

        messagesContainer.appendChild(messageElement);
        console.log('Mensagem adicionada ao DOM');
        console.log('HTML gerado:', messageElement.outerHTML);
    }

    function scrollToBottom() {
        let messages = document.getElementById('messages');
        messages.scrollTop = messages.scrollHeight;
    }

    // Fallback com polling caso WebSockets não funcionem
    let lastMessageId = 0;
    let isPolling = false;

    function startPollingFallback() {
        if (isPolling) return;
        isPolling = true;

        // Inicializar lastMessageId
        const messages = document.querySelectorAll('[data-message-id]');
        if (messages.length > 0) {
            const lastMessage = messages[messages.length - 1];
            lastMessageId = parseInt(lastMessage.getAttribute('data-message-id'));
        }

        // Polling a cada 3 segundos como fallback
        setInterval(() => {
            fetchNewMessages();
        }, 3000);
    }

    async function fetchNewMessages() {
        try {
            const response = await fetch(`/api/messages/{{ $conversationId }}?after=${lastMessageId}`);
            const messages = await response.json();

            messages.forEach(message => {
                if (message.id > lastMessageId) {
                    addMessageToInterface(message);
                    lastMessageId = Math.max(lastMessageId, message.id);
                }
            });

            if (messages.length > 0) {
                scrollToBottom();
            }
        } catch (error) {
            console.log('Erro ao buscar mensagens:', error);
        }
    }
</script>
