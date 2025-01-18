<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Live Support Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="p-6">
                    <div class="chat-container border rounded-lg overflow-hidden bg-gray-50">
                        <!-- Chat Messages -->
                        <div id="chatMessages" class="h-80 overflow-y-auto p-4 space-y-4">
                            <!-- Previous Messages -->
                            @foreach ($conversations as $conversation)
                                <div class="customer-message">
                                    <div class="bubble">{{ $conversation->user_message }}</div>
                                </div>
                                <div class="ai-message">
                                    <div class="bubble">{{ $conversation->ai_reply }}</div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Message Input -->
                        <div class="border-t p-4 bg-white">
                            <form id="chatForm" class="flex items-center space-x-4">
                                <input type="text" id="message" name="message"
                                       class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:outline-none"
                                       placeholder="Type your message..." required>
                                <button type="submit"
                                        class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600">
                                    Send
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .chat-container {
            display: flex;
            flex-direction: column;
            height: 500px;
        }

        #chatMessages {
            flex-grow: 1;
            overflow-y: auto;
            background: #f9f9f9;
        }

        /* Message Bubbles */
        .customer-message {
            text-align: right;
        }

        .customer-message .bubble {
            display: inline-block;
            background: #4F46E5;
            color: white;
            padding: 8px 12px;
            border-radius: 12px;
            margin-bottom: 8px;
            animation: slideFromRight 0.3s ease-in-out;
        }

        .ai-message {
            text-align: left;
        }

        .ai-message .bubble {
            display: inline-block;
            background: #E5E7EB;
            color: #111827;
            padding: 8px 12px;
            border-radius: 12px;
            margin-bottom: 8px;
            animation: slideFromLeft 0.3s ease-in-out;
        }

        /* Animations */
        @keyframes slideFromRight {
            from {
                transform: translateX(50%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideFromLeft {
            from {
                transform: translateX(-50%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>

    <script>
        document.getElementById('chatForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const messageInput = document.getElementById('message');
            const chatMessages = document.getElementById('chatMessages');
            const userMessage = messageInput.value;

            // Display customer message
            const customerMessageDiv = document.createElement('div');
            customerMessageDiv.classList.add('customer-message');
            customerMessageDiv.innerHTML = `<div class="bubble">${userMessage}</div>`;
            chatMessages.appendChild(customerMessageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            messageInput.value = '';

            try {
                const response = await fetch('{{ route('chat') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ message: userMessage }),
                });

                const data = await response.json();

                // Display AI response
                const aiMessageDiv = document.createElement('div');
                aiMessageDiv.classList.add('ai-message');
                aiMessageDiv.innerHTML = `<div class="bubble">${data.reply || 'No response from AI.'}</div>`;
                chatMessages.appendChild(aiMessageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;

            } catch (error) {
                const errorDiv = document.createElement('div');
                errorDiv.classList.add('ai-message');
                errorDiv.innerHTML = `<div class="bubble bg-red-500 text-white">An error occurred. Please try again.</div>`;
                chatMessages.appendChild(errorDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    </script>
</x-app-layout>
