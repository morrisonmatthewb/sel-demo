<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-4">Read the following case studies and answer the related quesions.</h1>
    <p>
        <span class="text-2xl font-bold">Healthcare.gov Website:</span>
        <a href="https://d3.harvard.edu/platform-rctom/submission/the-failed-launch-of-www-healthcare-gov/" class="text-blue-500 hover:underline"  target="_blank" rel="noopener noreferrer">click here</a>
    </p>

    <div class="mt-2 mb-2">
        @include("components.textbox", [
            "question" => "Identify specific communication or requirements gathering failures that directly contributed to the projects breakdown. For each failure, propose a concrete strategy that could have prevented or mitigated the issue.",
            "name" => "prompt1answer1"
        ])
    </div>

    <div class="mt-2 mb-2">
        @include("components.textbox", [
            "question" => "If you were the project manager, what key changes would you implement in the requirements gathering and stakeholder communication process to prevent a similar project failure?",
            "name" => "prompt1answer2"
            ])
    </div>

    <div class="mt-2 mb-2">
        <p>
            <span class="text-2xl font-bold">Denver Airport Baggage System Case Study:</span>
            <a href="https://calleam.com/WTPF/?page_id=2086" class="text-blue-500 hover:underline" target="_blank" rel="noopener noreferrer">click here</a>
        </p>
    </div>

    <div class="mt-2 mb-2">
        @include("components.textbox", [
            "question" => "Identify specific communication or requirements gathering failures that directly contributed to the project\"s breakdown. For each failure, propose a concrete strategy that could have prevented or mitigated the issue.",
            "name" => "prompt2answer1"
            ])
    </div>

    <div class="mt-2 mb-2">
        @include("components.textbox", [
            "question" => "If you were the project manager, what key changes would you implement in the requirements gathering and stakeholder communication process to prevent a similar project failure?",
            "name" => "prompt2qanswer2"
            ])
    </div>
</div>