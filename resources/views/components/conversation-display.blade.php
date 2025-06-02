{{-- 
Parameters:

$headerText     -> string
$conversation   -> the conversation array to display
--}}

@php
    if (empty($headerText)){
        $headerText = "Conversation Display";
    }
@endphp

<div class="bg-white shadow-lg rounded-lg p-4 flex flex-col h-[500px]">
    <h2 class="text-3xl font-bold mb-2">{{ Str::title($headerText) }}</h2>
    <!-- Conversation Display -->
    <div class="flex-1 overflow-y-auto px-4">
        <div class="space-y-4">
            @forelse($conversation as $entry)
                <div class="message-item">
                    <div class="@if($entry['role'] === 'user') flex justify-end @else flex justify-start @endif">
                        <div class="@if($entry['role'] === 'user') bg-blue-500 text-white @else bg-white text-gray-800 @endif
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
                <p class="text-gray-500 text-center">No messages in this conversation.</p>
            @endforelse
        </div>
    </div>
</div>