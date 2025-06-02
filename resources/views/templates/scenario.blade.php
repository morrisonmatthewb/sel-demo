{{--
Parameters:
$initialQuestions
$followUpQuestions
$scenarioText
$maxCoreReqs
--}}
@php
    $completed = $pageData['completed'] ?? false;
    $reqs = $pageData['coreRequirements'] ?? [];
@endphp
<a href="{{ route('modules.lab', ['lab' => $module, 'subroute' => 'journey-mode']) }}"
    class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 mb-8"
    id="back"
    data-color="green">
    Back to Scenarios
</a>
<br>
<br>
<div class="grid grid-cols-3 gap-6">
    <!-- Left Column: Questions and Follow-up Questions -->
    <div class="col-span-2 bg-white p-6 rounded-lg shadow">

        <!-- Initial Questions -->
        <div id="initial-questions" class="space-y-4">
            @foreach ($initialQuestions as $question)
                <button id="question{{ $question['id'] }}"
                        class="question-button bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 block mb-4"
                        data-irrelevant="{{ $question['irrelevant'] }}"
                        onclick="selectInitialQuestion({{ $question['id'] }}, '{{ $question['irrelevant'] }}', '{{ $question['irrelevant'] == 'true' ? $question['feedback'] : '' }}')">
                    {{ $question['text'] }}
                </button>
            @endforeach
        </div>

        <!-- Follow-Up Questions Header -->
        <h2 class="mt-6 text-lg font-semibold text-gray-700 mb-2">Follow-Up Questions</h2>
        
        <!-- Follow-Up Questions -->
        <div id="follow-up-questions" class="mt-6 space-y-4 hidden">
            <!-- Follow-up questions will appear here -->
        </div>
    </div>

    <!-- Right Column: Client Brief, Client Response, Core Requirements -->
    <div class="bg-gray-50 p-6 rounded-lg shadow">        
        <!-- Client Brief -->
        <div class="client-brief mb-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Client Brief</h2>
            <p class="text-gray-600">{{ $scenarioText }}</p>
        </div>

        <!-- Core Requirements Counter -->
        <div class="core-requirements mb-6">
            <h2 class="text-xl font-bold text-gray-700 mb-2">
                Core Requirements Found: <span id="core-count">{{ count($reqs) }}</span>/{{ $maxCoreReqs }}
            </h2>
            <ul id="core-list" class="list-disc list-inside text-left text-gray-600"></ul>
        </div>

        <!-- Client Response -->
        <div id="client-response" class="client-response mb-6 hidden">
            <p id="response-message" class="text-lg text-gray-600"></p>
        </div>

        
    </div>
</div>

<script>
    const followUpQuestions = @json($followUpQuestions);
    const maxCoreReqs = @json($maxCoreReqs);
    const coreRequirementsFound = new Set(@json($reqs));
    const prevCompleted = @json($completed);

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('nav-bar').hidden = true;
        loadFoundRequirements();
    });

    function loadFoundRequirements() {
        let coreList = document.getElementById('core-list');
        const reqs = @json($reqs);
        coreList.innerHTML = "";

        // Loop through the array and create list items
        reqs.forEach(req => {
            const listItem = document.createElement('li'); // Create a new <li> element
            listItem.textContent = req; // Set the text of the list item
            coreList.appendChild(listItem); // Append the list item to the unordered list
        });

    }

    // Function to update the button color based on type
    function updateQuestionButtonStyles(button, type) {
        if (type === "core") {
            button.classList.remove("bg-blue-500 hover:bg-blue-600");
            button.classList.add("bg-green-500 hover:bg-green-600");
        } else if (type === "nonEssential") {
            button.classList.remove("bg-blue-500 hover:bg-blue-600");
            button.classList.add("bg-yellow-500 hover:bg-yellow-600");
        } else if (type === "irrelevant") {
            button.classList.remove("bg-blue-500 hover:bg-blue-600");
            button.classList.add("bg-red-500 hover:bg-red-600");
        }
    }

    // Select an initial question and load its follow-up questions if any
    function selectInitialQuestion(questionId, isIrrelevant, feedback) {
        const followUps = followUpQuestions[questionId] || [];
        const followUpContainer = document.getElementById('follow-up-questions');
        const initQuestion = document.getElementById(`question${questionId}`);
        followUpContainer.innerHTML = ""; // Clear previous follow-up questions

        // Display follow-up questions for the selected initial question
        followUps.forEach(followUp => {
            const followUpButton = document.createElement("button");
            followUpButton.classList.add("follow-up-button", "px-4", "py-2", "rounded", "text-white", "mb-4", "focus:outline-none", "focus:ring-2", "block");
            followUpButton.innerText = followUp.text;
            followUpButton.onclick = () => handleFollowUpQuestion(followUpButton, followUp);

            followUpButton.classList.add("bg-blue-500", "hover:bg-blue-600");

            // Append follow-up button to the container
            followUpContainer.appendChild(followUpButton);
        });

        // Make the follow-up section visible
        followUpContainer.classList.remove("hidden");

        // Update the core count and list
        document.getElementById("core-count").innerText = coreRequirementsFound.size;
        document.getElementById("core-list").innerHTML = Array.from(coreRequirementsFound)
            .map(req => `<li>${req}</li>`)
            .join("");

        // If the initial question is irrelevant, show its feedback in the client response
        const clientResponseElement = document.getElementById("client-response");
        const response = document.getElementById("response-message");
        if (isIrrelevant) {
            response.innerHTML = `<strong>Irrelevant Response: </strong>${feedback}`;
            response.classList = "text-red-500";
            initQuestion.classList.remove("bg-blue-500", "hover:bg-blue-600");
            initQuestion.classList.add("bg-red-500", "hover:bg-red-600");

        } else {
            response.innerText = "";
        }

        // Make the client response section visible
        clientResponseElement.classList.remove("hidden");
        writeLog(`Initial Question ${questionId} selected. Irrelevant: ${isIrrelevant}`);
    }

    function storeNewReq(name, arr, log) {
        // Log the updates and submit form data
        updateForm(name, arr, log);
        if(coreRequirementsFound.size == maxCoreReqs) {
            enableButton('back');
            updateForm('completed', true, `Completed ${page} page`);
        }
    }

    // Handle follow-up question selection and display its message
    function handleFollowUpQuestion(followUpButton, followUp) {
        const followUpContainer = document.getElementById('follow-up-questions');
        const response = document.getElementById("response-message");
        // Display the follow-up question message on the right column
        response.innerHTML = `<strong>Client Response: </strong>${followUp.message}`;
        
        // Track core requirements found and color of button   
        followUpButton.classList.remove("bg-blue-500", "hover:bg-blue-600"); 
        if (followUp.type === "core") {
            followUpButton.classList.add("bg-green-500", "hover:bg-green-600");
            response.classList = "text-green-500";
            coreRequirementsFound.add(followUp.requirement);
            storeNewReq('coreRequirements', Array.from(coreRequirementsFound), `New Core Requirements Found: ${followUp.requirement}`);
        } else if (followUp.type === "nonEssential") {
            followUpButton.classList.add("bg-yellow-500", "hover:bg-yellow-600");
            response.classList = "text-yellow-500";
            writeLog(`Non Essential Question asked: ${followUp.text}`);
        } else if (followUp.type === "irrelevant") {
            followUpButton.classList.add("bg-red-500", "hover:bg-red-600");
            response.classList = "text-red-500";
            writeLog(`Irrelevant Question asked: ${followUp.text}`);
        }

        // Update the core count and list
        document.getElementById("core-count").innerText = coreRequirementsFound.size;
        document.getElementById("core-list").innerHTML = Array.from(coreRequirementsFound)
            .map(req => `<li>${req}</li>`)
            .join("");
    }
</script>
