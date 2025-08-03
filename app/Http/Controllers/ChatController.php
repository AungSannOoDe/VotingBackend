<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;

class ChatController extends Controller
{
    public function userConversations()
    {
        $user = Auth::user();
        return Chat::with(['voter', 'messages'])
            ->where('user_id', $user->id)
            ->orderBy('last_message_at', 'desc')
            ->get();
    }

    public function userConversation(Chat $conversation)
    {
        $this->authorize('view', $conversation);

        // Mark messages as read
        $conversation->messages()
            ->whereNull('read_at')
            ->where('sender_type', 'App\Models\Voter')
            ->update(['read_at' => now()]);

        return $conversation->load('messages.sender', 'voter');
    }

    public function userSendMessage(Request $request, Chat $conversation)
    {
        $this->authorize('update', $conversation);

        $message = $conversation->messages()->create([
            'sender_id' => Auth::id(),
            'sender_type' => 'App\Models\User',
            'content' => $request->input('content'),
        ]);

        $conversation->update(['last_message_at' => now()]);

        event(new MessageSent($message));

        return response()->json($message, 201);
    }

    // Voter methods (similar but for voter)
    public function voterConversations()
    {
        $voter = Auth::guard('voter')->user();
        return Chat::with(['user', 'messages'])
            ->where('voter_id', $voter->id)
            ->orderBy('last_message_at', 'desc')
            ->get();
    }
}
