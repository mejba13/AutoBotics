<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('AI Support Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">Chat with AI Support</h1>
                    <div id="chat-box" class="border p-4 mb-4 bg-gray-100 dark:bg-gray-700 text-black dark:text-white"
                         style="height: 400px; overflow-y: scroll;"></div>
                    <form id="chat-form">
                        @csrf
                        <textarea id="user-input" name="message" class="w-full border p-2 mb-2" rows="3" placeholder="Type your message here..."></textarea>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('chat-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = e.target;
            const message = form.message.value;
            const chatBox = document.getElementById('chat-box');

            if (message.trim() === '') return;

            chatBox.innerHTML += `<p><strong>You:</strong> ${message}</p>`;
            form.reset();

            fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ message }),
            })
                .then((response) => response.json())
                .then((data) => {
                    chatBox.innerHTML += `<p><strong>AutoBotic:</strong> ${data.reply}</p>`;
                    chatBox.scrollTop = chatBox.scrollHeight;
                })
                .catch((error) => {
                    console.error('Error:', error);
                    chatBox.innerHTML += `<p><strong>Error:</strong> Unable to fetch AI response.</p>`;
                });
        });
    </script>
</x-app-layout>
