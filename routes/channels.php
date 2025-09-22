use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {
  return $user->isParticipantOf($conversationId);
});

Broadcast::channel('presence-conversation.{conversationId}', function ($user, $conversationId) {
if ($user->isParticipantOf($conversationId)) {
return ['id' => $user->id, 'name' => $user->name];
}
return false;
});
