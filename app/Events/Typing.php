<?php
namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Typing implements ShouldBroadcast
{
  public $payload;
  public function __construct(array $payload)
  {
    $this->payload = $payload;
  }
  public function broadcastOn()
  {
    return new PrivateChannel('conversation.' . $this->payload['conversation_id']);
  }
  public function broadcastWith()
  {
    return $this->payload;
  }
}
