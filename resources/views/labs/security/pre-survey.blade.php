<div class="text-1xl font-bold mb-2">Pre-Module Survey</div>
<p class="mb-2">
    These questions will help gauge your initial understanding of web security concepts. Answer them to the best of your knowledge.
    If you're unsure about any question, you can leave it blank or write "N/A".
</p>
<br>

@include('components.textbox', ["question" => "What do you think are the most common web security vulnerabilities?", "name" => "pre-survey-sa1"])
@include('components.textbox', ["question" => "How would you explain the concept of 'authentication' versus 'authorization'?", "name" => "pre-survey-sa2"])
@include('components.textbox', ["question" => "What security measures would you implement to protect a login form?", "name" => "pre-survey-sa3"])

<h2 class="text-1xl font-bold mb-4">Rate Your Knowledge (1-5)</h2>
<p class="mb-4 text-gray-600">1 = No Knowledge, 5 = Expert</p>
<div class="space-y-1">
    @foreach(['Authentication & Authorization', 'Cross-Site Scripting (XSS)', 'SQL Injection', 'Insecure Direct Object References (IDOR)', 'Data Encryption', 'Security Best Practices'] as $topic)
    <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
        @include('components.rating', ["question" => $topic, "name" => "pre-survey-$topic"])
    </div>
    @endforeach
</div>
