<?php

use App\Livewire\Chat;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/chat', Chat::class)->middleware('auth')->name('chat');

// API para mensagens em tempo real
Route::get('/api/messages/{conversationId}', function ($conversationId) {
    $after = request('after', 0);

    $messages = \App\Models\Message::with('user')
        ->where('conversation_id', $conversationId)
        ->where('id', '>', $after)
        ->orderBy('created_at', 'asc')
        ->get();

    return response()->json($messages);
})->middleware('auth');

require __DIR__.'/auth.php';
