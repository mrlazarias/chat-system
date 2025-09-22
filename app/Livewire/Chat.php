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

        broadcast(new \App\Events\MessageSent($message->load('user')))->toOthers();
        $this->dispatch('messageReceived');
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
