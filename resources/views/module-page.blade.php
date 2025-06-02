{{--
Parameters:
$module
$page
$moduleDisplay
$pageDisplay
$currentPageNumber
$locked
$form
$totalPageNumber
$prevPage
$nextPage
--}}

@extends('master')

@section('title', '$pageDisplay | $moduleDisplay Module')

@section('content')
    @php

    use App\Helpers\FormApi;
    $user = FormApi::current_user();
    $formDataJson = FormApi::form_get($user, $module);
    $formData = json_decode($formDataJson, true);
    $pageData = $formData[$page] ?? null;
    $questions = $pageData['questions'] ?? [];
    $buttons = [];
    if(isset($prevPage)) {
        $buttons['prev'] = ['text' => 'Back', 'id' => 'prev', 'page' => $prevPage];
    }
    if(isset($nextPage)) {
        $buttons['next'] = ['text' => 'Next', 'id' => 'next', 'page' => $nextPage];
    }
    $currentPageNumber = $currentPageNumber ?? null;
    $totalPageNumber = $totalPageNumber ?? null;
    @endphp  
    <script>
        const module = @json($module);
        const page = @json($page);
        document.addEventListener('DOMContentLoaded', function () {
            let hasQuestions = false;
            let questions = @json($questions);
            if(!Array.isArray(questions) && Object.keys(questions) !== 0) {
                return;
            }
            questions = {};
            // Find all inputs with specific classes or attributes (modify as needed)
            document.querySelectorAll('[data-type]').forEach(element => {
                const name = element.getAttribute('name');
                const questionText = element.getAttribute('data-question'); 
                const questionType = element.getAttribute('data-type');
                const question = {
                    question: questionText,
                    type: questionType,
                    answer: ""
                };
                if (!(name in questions)) {
                    questions[name] = question;
                }
            });

            if(Object.keys(questions).length !== 0) {
                updateForm('questions', questions);
            }
        });


        function updateForm(field, value = null, logMsg = null, createPage = false) {
            let json = {
                module,
                page,
                field,
                _token: '{{ csrf_token() }}'
            };
            if (logMsg !== null) {
                json.logMsg = logMsg;
            }
            if (!createPage) {
                json.value = value;
            }
            fetch("{{ route('form.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(json),
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Failed to save data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        function answerQuestion(name, question) {
            let pageData = @json($pageData);
            if(pageData === null) {
                pageData = {
                    questions: {
                        [name]: question
                    }
                };
                updateForm(pageData, null, `Create ${page} page`, true);
            } else {
                pageData.questions[name] = question;
            }
            updateForm('questions', pageData.questions, `Saved ${question.answer} for ${name}`)
        }
        function writeLog(logMsg) {
            fetch("{{ route('form.log') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    module,
                    page,
                    logMsg,
                    _token: '{{ csrf_token() }}'
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Failed to write log');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        function enableButton(id) {
            const button = document.getElementById(id);
            if (button) {
                button.disabled = false;
                button.classList.remove("bg-gray-300", "text-gray-600", "cursor-not-allowed");
                button.classList.add(`bg-${button.dataset.color || 'blue'}-500`, `bg-${button.dataset.color || 'blue'}-600`, "text-white");
                button.removeEventListener('click', preventDefaultAction);
            }
        }

        function disableButton(id) {
            const button = document.getElementById(id);
            if (button) {
                button.disabled = true;
                button.classList.remove(`bg-${button.dataset.color || 'blue'}-500`, `hover:bg-${button.dataset.color || 'blue'}-600`,"text-white");
                button.classList.add("bg-gray-300", "text-gray-600", "cursor-not-allowed");
                button.addEventListener('click', preventDefaultAction);
            }
        }

        function preventDefaultAction(event) {
            event.preventDefault();
            alert("Complete the page");
        }

        function hideButton(id) {
            const button = document.getElementById(id);
            if (button) {
                button.hidden = true;
            }
        }
    </script>

    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">

    <div class="bg-gray-100 flex flex-col justify-between">
        <div class="container mx-auto px-6 py-8 flex-grow">
            <h1 class="text-3xl font-bold mb-6">
                {{ $moduleDisplay }}
            </h1>
            <h2 class="text-2xl font-bold mb-6">
                {{ $pageDisplay }}
            </h2>
            <div class="bg-white shadow-md rounded-md p-4 mb-6">

                <div id="lockedMessageDiv">
                    @include('components.module-lock-message', ['isLocked' => $locked])
                </div>
                @include("labs.$module.$page")
            </div>

            <br>
            <!-- Navigation Buttons -->
            @include('components.nav', [
                'module' => $module,
                'page' => $page,
                'currentPageNumber' => $currentPageNumber,
                'totalPageNumber' => $totalPageNumber,
                'buttons' => $buttons
            ])

        </div>
    </div>
@endsection
