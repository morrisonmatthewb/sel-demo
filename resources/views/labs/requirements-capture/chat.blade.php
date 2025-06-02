@php
$conversation = $pageData['conversation'] ?? [];

if(count($conversation) > 0){
    if ($pageData['conversation'][0]['role'] == 'system'){
        $conversation = array_slice($conversation, 1);
    }
}
@endphp

<div class="grid grid-cols-2 gap-4 max-w-5xl mx-auto">
    <!-- Task Prompt Box -->
    <div class="bg-white shadow-lg rounded-lg p-4">
        <h2 class="text-lg font-bold mb-4 text-center">Your Task</h2>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
            <h3 class="font-semibold text-base mb-2">Website Redesign Project</h3>
            <p class="text-base">
                You are a project manager tasked with gathering requirements for a local bakery's website redesign. 
                The client (AI) owns "Sweet Delights Bakery" and wants to modernize their online presence. 
            </p>
            <ul class="list-disc list-inside mt-3 text-base space-y-1">
                <li class="pl-1">Ask questions about their current website</li>
                <li class="pl-1">Understand their goals for the redesign</li>
                <li class="pl-1">Gather specific requirements about functionality</li>
                <li class="pl-1">Discuss their budget and timeline expectations</li>
            </ul>
            <p class="mt-3 text-sm italic">
                Remember to be professional and thorough in your requirements gathering process.
            </p>
        </div>
    </div>

    <!-- Chat Interface -->
    <div class="bg-white shadow-lg rounded-lg p-4 flex flex-col h-[500px]">
        <!-- Header -->
        <h2 class="text-lg font-bold mb-4 text-center flex-none">Chat with Your Client</h2>

        <!-- Conversation Display -->
        <div id="chat-container" class="flex-1 overflow-y-auto p-4 border border-gray-300 rounded bg-gray-50 mb-4">
            <div id="message-list" class="space-y-4">
                @forelse($conversation as $entry)
                    <div class="message-item">
                        <div class="@if($entry['role'] === 'user') flex justify-end @else flex justify-start @endif">
                            <div class="@if($entry['role'] === 'user') bg-blue-500 text-white @else bg-gray-200 text-gray-800 @endif 
                                        rounded-lg p-4 max-w-[80%] w-auto shadow-md">
                                <p class="text-base">
                                    {{ $entry['content'] }}
                                </p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2 @if($entry['role'] === 'user') text-right @endif">
                            {{ ucfirst($entry['role']) }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500 text-center text-base">Start the conversation by typing a message below.</p>
                @endforelse
            </div>
        </div>

        <!-- message input form -->
        <form id="chat-form" action="{{ route('modules.labpost', ['lab' => 'requirements-capture', 'subroute' => 'message']) }}" method="POST" class="flex flex-none">
            @csrf
            <input type="text" 
                    name="message" 
                    class="flex-grow p-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Type your message..." 
                    required
                    {{ $locked ? 'disabled' : '' }}>
            <button type="submit" class="bg-blue-500 text-white px-4 rounded-r hover:bg-blue-600">Send</button>
        </form>
    </div>
</div>

<br>

<div class="text-center mb-4">
    <form action="{{ route('modules.labpost', ['lab' => 'requirements-capture', 'subroute' => 'init']) }}" method="POST" class="inline">
        @csrf
        <button type="submit" 
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                {{ $locked ? 'disabled' : '' }}>
            Start New Conversation
        </button>
    </form>
</div>

<script>
    // Function to scroll chat to bottom
    const locked = @json($locked);
    function scrollToBottom() {
        const chatContainer = document.getElementById('chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Add message to chat
    function appendMessage(message, isUser) {
        const messageList = document.getElementById('message-list');
        
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message-item space-y-4';
        
        messageDiv.innerHTML = `
            <div class="${isUser ? 'flex justify-end' : 'flex justify-start'}">
                <div class="${isUser ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800'} 
                            rounded-lg p-4 max-w-[80%] w-auto shadow-md">
                    <p class="text-base">${message}</p>
                </div>
            </div>
            <p class="text-sm text-gray-500 mt-2 ${isUser ? 'text-right' : ''}">
                ${isUser ? 'User' : 'Assistant'}
            </p>
        `;
        
        messageList.appendChild(messageDiv);
        scrollToBottom();
    }

    // Handle form submission
    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        const messageInput = form.querySelector('input[name="message"]');
        const message = messageInput.value;
        
        // Clear input
        messageInput.value = '';
        
        // Append user message immediately
        appendMessage(message, true);
        
        // Send message to server
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Append assistant's response
                appendMessage(data.last_message, false);
            } else {
                console.error('Error:', data.error);
                alert('Error sending message: ' + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error sending message');
        });
    });

    // Initial scroll to bottom
    window.onload = scrollToBottom;
    document.addEventListener('DOMContentLoaded', scrollToBottom);
</script>