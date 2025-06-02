<div class="text-1xl font-bold mb-2">Post-Module Survey</div>
<p class="mb-2">
    Now that you've completed the web security module, please answer these questions to help us understand what you've learned.
    Your feedback will help us improve the learning experience.
</p>
<br>

@include('components.textbox', ["question" => "After completing this module, what do you now consider to be the most critical web security vulnerabilities?", "name" => "post-survey-sa1"])
@include('components.textbox', ["question" => "Based on what you've learned, how would you now explain the difference between 'authentication' and 'authorization'?", "name" => "post-survey-sa2"])
@include('components.textbox', ["question" => "What security measures would you now implement to protect a login form, and why?", "name" => "post-survey-sa3"])

<h2 class="text-1xl font-bold mb-4">Rate Your Knowledge (1-5)</h2>
<p class="mb-4 text-gray-600">1 = No Knowledge, 5 = Expert</p>
<div class="space-y-1">
    @foreach(['Authentication & Authorization', 'Cross-Site Scripting (XSS)', 'SQL Injection', 'Insecure Direct Object References (IDOR)', 'Data Encryption', 'Security Best Practices'] as $topic)
    <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
        @include('components.rating', ["question" => $topic, "name" => "post-survey-$topic"])
    </div>
    @endforeach
</div>
