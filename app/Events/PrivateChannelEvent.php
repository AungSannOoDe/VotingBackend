<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PrivateChannelEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
     public $message;
    public $conversation;
    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {
         $this->message = $message;
        $this->conversation = $message->conversation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
         return [
            new PrivateChannel('chat.'.$this->conversation->voter_id),
            new PrivateChannel('chat.'.$this->conversation->user_id),
        ];
    }
     public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'content' => $this->message->content,
            'sender' => [
                'id' => $this->message->sender->id,
                'type' => $this->message->sender_type,
                'name' => $this->message->sender->name,
            ],
            'conversation_id' => $this->conversation->id,
            'sent_at' => $this->message->created_at->toDateTimeString(),
            'is_read' => !is_null($this->message->read_at),
        ];
    }
}
