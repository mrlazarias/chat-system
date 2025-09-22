<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $fillable = ['type', 'title'];

    public function participants(): BelongsToMany
    {
      return $this->belongsToMany(User::class, 'conversation_user')
     ->withPivot('last_read_at')
     ->withTimestamps();
    }
    public function messages(): HasMany
    {
      return $this->hasMany(Message::class);
    }

    public function lastMessage(): HasMany
    {
      return $this->messages()->latestOfMany();
    }

    public function scopeForUser($query, $userId)
    {
      return $query->whereHas('participants', fn($q) => $q->where('user_id', $userId));
    }
}
