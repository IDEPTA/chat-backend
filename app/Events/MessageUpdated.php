<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MessageUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public  $message;

    public function __construct($message)
    {
        try {
            $this->message = $message;
        } catch (\Throwable $e) {
            Log::error('Ошибка в событии MessageCreated:', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat.' . $this->message->chat_id),
        ];
    }

    public function broadcastAs()
    {
        return 'message.updated';
    }

    public function broadcastWith()
    {
        $data =
            [
                'id' => $this->message->id,
                // 'user_id' => $this->message->user_id,
                'message' => $this->message->message,
                // 'chat_id' => $this->message->chat_id,
                // 'user' => $this->message->user,
            ];

        return $data;
    }
}
