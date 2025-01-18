document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('live-support-form');
    const chatbox = document.getElementById('chatbox');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const messageInput = document.getElementById('message');
        const message = messageInput.value;

        // Display the user's message
        const userMessage = document.createElement('div');
        userMessage.className = 'text-right mb-2';
        userMessage.textContent = `You: ${message}`;
        chatbox.appendChild(userMessage);

        try {
            // Send the message to Laravel, which forwards it to Rasa
            const response = await fetch('/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ message }),
            });

            const replies = await response.json();

            // Display the bot's replies
            replies.forEach((reply) => {
                const botMessage = document.createElement('div');
                botMessage.className = 'text-left mb-2';
                botMessage.textContent = `Bot: ${reply.text}`;
                chatbox.appendChild(botMessage);
            });
        } catch (error) {
            const errorMessage = document.createElement('div');
            errorMessage.className = 'text-left mb-2 text-red-500';
            errorMessage.textContent = `Error: ${error.message}`;
            chatbox.appendChild(errorMessage);
        }

        // Clear the input field
        messageInput.value = '';
    });
});
