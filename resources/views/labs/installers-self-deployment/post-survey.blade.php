<p class="mb-2">Reflect on your experience in this module and share your thoughts below.</p>
<br>

<div class="bg-white p-6 rounded-lg shadow mb-6">    
    @include('components.textbox', ["question" => "1. What was the most challenging aspect of creating an installer or writing a deployment README?", "name" => "post-survey-q1"])
    @include('components.textbox', ["question" => "2. Has this module changed your perspective on the importance of clear, concise README documentation? If so, how?", "name" => "post-survey-q2"])
    @include('components.textbox', ["question" => "3. How do you plan to apply the skills gained from this module in future projects?", "name" => "post-survey-q3"])
</div>


<div class="bg-white p-6 rounded-lg shadow mb-6">    
    <h2 class="text-1xl font-bold mb-4">Rate Your Confidence (1-5)</h2>
    <p class="mb-4 text-gray-600">1 = Not confident, 5 = Highly confident</p>
    <div class="space-y-1">
        @foreach(['Building a software installer for your platform', 'Troubleshooting and solving issues related to software setup and deployment', 'Identifying or providing clear and concise instructions', 'Utilizing markdown formatting for writing README files on GitHub or similar platforms'] as $index => $aspect)
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
            @include('components.rating', ["question" => $aspect, "name" => "post-survey-q" . (3 + $loop->iteration)]) 
        </div>
        @endforeach
    </div>
</div>
