<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;
use App\Models\Conversation;

class OpenAIController extends Controller
{
    public function index()
    {
        return view('chat'); // Blade file for the chat interface
    }

    public function chat(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        try {
            $client = OpenAI::client(config('services.openai.api_key'));

            $response = $client->chat()->create([
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful customer support agent.'],
                    ['role' => 'user', 'content' => $validated['message']],
                ],
            ]);

            // Truncate the AI response to 30 characters
            $aiReply = $response['choices'][0]['message']['content'] ?? 'No response from AI.';
            $aiReply = mb_strimwidth($aiReply, 0, 30, '...');

            // Save the conversation to the database
            Conversation::create([
                'user_message' => $validated['message'],
                'ai_reply' => $aiReply,
            ]);

            return response()->json([
                'reply' => $aiReply,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to process your request. Please try again later.',
            ], 500);
        }
    }
}
