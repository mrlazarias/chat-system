<div class="flex flex-col h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b px-6 py-4">
        <h1 class="text-xl font-semibold text-gray-900">Chat Geral</h1>
        <p class="text-sm text-gray-500">Converse em tempo real</p>
    </div>

    <!-- Messages Area -->
    <div id="messages" class="flex-1 overflow-y-auto p-6 space-y-4">
        @forelse($messages as $message)
            <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}" data-message-id="{{ $message->id }}">
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
                const messagesContainer = document.getElementById('messages');
                const isOwnMessage = message.user_id === {{ auth()->id() }};

                // Verificar se a mensagem já existe
                const existingMessage = messagesContainer.querySelector(`[data-message-id="${message.id}"]`);
                if (existingMessage) return;

                const messageElement = document.createElement('div');
                messageElement.className = `flex ${isOwnMessage ? 'justify-end' : 'justify-start'}`;
                messageElement.setAttribute('data-message-id', message.id);

                messageElement.innerHTML = `
                    <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg ${isOwnMessage ? 'bg-blue-500 text-white' : 'bg-white text-gray-800 shadow-sm'}">
                        ${!isOwnMessage ? `<div class="text-xs font-medium text-gray-500 mb-1">${message.user.name}</div>` : ''}
                        <div class="text-sm">${message.body}</div>
                        <div class="text-xs ${isOwnMessage ? 'text-blue-100' : 'text-gray-400'} mt-1">
                            ${new Date(message.created_at).toLocaleTimeString('pt-BR', {hour: '2-digit', minute: '2-digit'})}
                        </div>
                    </div>
                `;

                messagesContainer.appendChild(messageElement);
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
