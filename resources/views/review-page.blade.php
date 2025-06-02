{{--
Parameters:

$display
$module
$message
$currentPageNumber
$totalPageNumber
$prevPage
$isSubmitted
$cannotSubmit
--}}
@extends('master')

@section('title', 'Completed {{ $display }} Module')

@section('content')

    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">

    <div class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-6">{{ $display }} Module Completion</h1>

            <div class="bg-blue-50 p-6 rounded-lg mb-8">
                <p id="instruction" class="text-xl font-semibold text-gray-700">
                    Press the button below to {{ $isSubmitted ? 'un' : ''}}submit the module
                </p>
                <br>
                <p id="submitMsg" class="text-xl font-semibold text-gray-700">
                </p>
            </div>

            <!-- Success/Error Notifications -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 border border-green-400 rounded px-4 py-3 mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-700 border border-red-400 rounded px-4 py-3 mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <div id="submission">
                <!-- Cannot Submit Message -->
                @if ($cannotSubmit)
                    <p class="text-red-600">
                        You cannot submit or unsubmit this module because it is locked or passed the due date.
                    </p>
                @else
                    <!-- Submit Button -->
                    <button type="button" onclick="submit(true)" id="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded"
                        {{ $isSubmitted ? 'hidden' : '' }}>
                        Submit
                    </button>

                    <!-- Unsubmit Button -->
                    <button type="button" onclick="submit(false)" id="unsubmit"
                        class="bg-red-500 text-white px-4 py-2 rounded"
                        {{ !$isSubmitted ? 'hidden' : '' }}>
                        Unsubmit
                    </button>
                @endif
                <br>
                <br>
                <div id="unansweredQuestionsList">
                    @if(!empty($unviewed))
                        <h2 class="text-2xl font-bold mb-6">Unviewed Pages</h2>
                        <ul>
                            @foreach($unviewed as $currPage => $currDisplay)
                                <li>
                                    <a href="{{ route('modules.lab', ['lab' => $module, 'subroute' => $currPage]) }}"
                                        class="text-xl font-bold mb-6 text-blue-500">
                                        {{ ucfirst($currDisplay) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @elseif(!empty($unanswered))
                        <h2 class="text-2xl font-bold mb-6">Unanswered Questions</h2>
                        @foreach($unanswered as $currPage => $questions)
                            <a href="{{ route('modules.lab', ['lab' => $module, 'subroute' => $currPage]) }}" 
                                class="text-xl font-bold mb-6 text-blue-500">
                                Page: {{ $pages[$currPage] }}
                            </a>
                            <ul class="text-lg">
                                @foreach($questions as $id => $questionData)
                                    <li>
                                        <strong>Question:</strong> {{ $questionData['question'] ?? 'N/A' }} | <strong>Type:</strong> {{ $questionData['type'] ?? 'N/A' }}
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    @endif
                </div>

            </div>
            <br>


            <!-- Navigation Buttons -->
            @include('components.nav', [
                'lab'               => $module,
                'currentPageNumber' => $currentPageNumber,
                'totalPageNumber'   => $totalPageNumber,
                'buttons' => [
                    'prev' => [
                        'text' => 'Back',
                        'id' => 'prev',
                        'link' => route('modules.lab', ['lab' => $module, 'subroute' => $prevPage])
                    ],
                    'modules' => [
                        'text' => 'Module List',
                        'id' => 'modules',
                        'link' => route('modules')
                    ]
                ]
            ])
        </div>
    </div>
    <script>
        const module = @json($module);
        const displayName = @json($display);
        let submitted = @json($isSubmitted);
        function submit(done) {
            fetch("{{ route('modules.submit') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    module,
                    done,
                    _token: '{{ csrf_token() }}'
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    submitted = done;
                    placeMessage();
                } else {
                    console.error('Failed to submit module');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function placeMessage() {
            let submitMsg = document.getElementById('submitMsg');
            submitMsg.innerHTML = submitted ? 
                                `Thank you for completing the ${displayName} module!` : 
                                `You have successfully unsubmitted the ${displayName} module.`;
            let instruction = document.getElementById('instruction');
            instruction.innerHTML = submitted ?
                                `Press the button below to unsubmit the module.` :
                                `Press the button below to submit the module.`;

            const submitButton = document.getElementById('submit');
            const unsubmitButton = document.getElementById('unsubmit');

            submitButton.hidden = !submitButton.hidden;
            unsubmitButton.hidden = !unsubmitButton.hidden;
        }
    </script>
@endsection
