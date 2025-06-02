<p class="mb-2">
    These questions are designed to give yourself and the instructor a preliminary idea of what you know, so please just answer as honestly as you can.</p>
<br>


<div class="bg-white p-6 rounded-lg shadow mb-6">    
    <!-- Created an Installer? -->
    <div class="mb-6">
        @include('components.dropdown', ["question" => "Have you ever created a software installer before?", "name" => "pre-survey-q1", "options" => ['Yes', 'No']])
    </div>
    <!-- Encounter README Issues? -->
    <div class="mb-6">
        @include('components.dropdown', ["question" => "How often do you encounter issues when following ‘README’ instructions to set up a new project or application?", "name" => "pre-survey-q2", "options" => ['Never', 'Rarely', 'Sometimes', 'Often', 'Always']])
    </div>
</div>
<div class="bg-white p-6 rounded-lg shadow mb-6">    
    <!-- Rating Confidence -->
    <h2 class="text-1xl font-bold mb-4">Rate Your Confidence (1-5)</h2>
    <p class="mb-4 text-gray-600">1 = Not confident, 5 = Highly confident</p>
    <div class="space-y-1">
        @foreach(['Building a software installer for your platform', 'Troubleshooting and solving issues related to software setup and deployment', 'Identifying or providing clear and concise instructions', 'Utilizing markdown formatting for writing README files on GitHub or similar platforms'] as $index => $aspect)
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
            @include('components.rating', ["question" => $aspect, "name" => "pre-survey-q" . (2 + $loop->iteration)]) 
        </div>
        @endforeach
    </div>
</div>
