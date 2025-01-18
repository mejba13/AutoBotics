<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SupportController extends Controller
{
    public function showLiveSupport()
    {
        // Fetch previous conversations for the authenticated user
        $conversations = Conversation::where('customer_id', auth()->id())->get();

        return view('live-support', ['conversations' => $conversations]);
    }

    public function handleChat(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        try {
            // Send the message to Rasa API
            $response = Http::post('http://localhost:5005/webhooks/rest/webhook', [
                'sender' => auth()->user()->id, // Unique user identifier
                'message' => $validated['message'],
            ]);

            // Parse the Rasa response
            if ($response->ok()) {
                $rasaReply = $response->json();
                $replyMessage = $rasaReply[0]['text'] ?? 'No response from AI.';

                // Save the conversation in the database
                Conversation::create([
                    'customer_id' => auth()->id(),
                    'user_message' => $validated['message'],
                    'ai_reply' => $replyMessage,
                ]);

                return response()->json(['reply' => $replyMessage], 200);
            }

            return response()->json(['error' => 'Failed to communicate with AI.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
