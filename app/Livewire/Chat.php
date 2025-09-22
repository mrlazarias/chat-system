<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Chat extends Component
{
    use WithPagination;
    public $messageText = '';
    public $conversationId;

    protected $rules = [
        'messageText' => 'required|string|max:500',
    ];
    protected $listeners = ['messageReceived' => '$refresh'];

    public function mount()
    {
        // Criar ou obter conversa padrão
        $this->conversationId = $this->getOrCreateDefaultConversation();
    }

    private function getOrCreateDefaultConversation()
    {
        // Buscar conversa padrão (geral)
        $conversation = Conversation::where('type', 'general')->first();

        if (!$conversation) {
            // Criar conversa padrão se não existir
            $conversation = Conversation::create([
                'type' => 'general',
                'title' => 'Chat Geral'
            ]);

            // Adicionar usuário atual à conversa
            $conversation->participants()->attach(Auth::id());
        } else {
            // Verificar se usuário já está na conversa
            if (!$conversation->participants()->where('user_id', Auth::id())->exists()) {
                $conversation->participants()->attach(Auth::id());
            }
        }

        return $conversation->id;
    }

    public function sendMessage()
    {
        $this->validate();
        $message = Message::create([
            'conversation_id' => $this->conversationId,
            'user_id' => Auth::id(),
            'body' => $this->messageText,
        ]);
        $this->messageText = '';

        // Notificar WebSocket server via HTTP
        $this->notifyWebSocketServer($message->load('user'));
    }

    private function notifyWebSocketServer($message)
    {
        try {
            $data = [
                'type' => 'message',
                'conversationId' => $message->conversation_id,
                'id' => $message->id,
                'user_id' => $message->user_id,
                'body' => $message->body,
                'user' => [
                    'id' => $message->user->id,
                    'name' => $message->user->name,
                ],
                'created_at' => $message->created_at->toDateTimeString(),
            ];

            // Enviar via HTTP para o WebSocket server
            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json',
                    'content' => json_encode($data),
                    'timeout' => 1
                ]
            ]);

            @file_get_contents('http://127.0.0.1:6001/broadcast', false, $context);
        } catch (\Exception $e) {
            // WebSocket server não disponível, continuar normalmente
        }
    }

    public function render()
    {
        return view('livewire.chat', [
            'messages' => Message::with('user')
                ->where('conversation_id', $this->conversationId)
                ->latest()
                ->take(20)
                ->get()
                ->reverse(),
        ]);
    }
}
