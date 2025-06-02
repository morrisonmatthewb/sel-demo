<div class="text-1xl font-bold mb-2">Reflection Questions</div>
<p class="mb-2">
    Reflect on your experience with the provided READMEs and your own creation. Keep your responses concise but insightful.
</p>
<br>

<div class="bg-white p-6 rounded-lg shadow mb-6">    
    @include('components.textbox', ["question" => "1. What specific challenges did you face while working with the minimal and detailed READMEs? How did these challenges shape your approach to creating your own README?", "name" => "self-deployment-reflection-q1"])
    @include('components.textbox', ["question" => "2. If you had to share your README with a teammate, what feedback would you expect, and how would you improve it based on that feedback?", "name" => "self-deployment-reflection-q2"])
</div>

<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Rate Your Experience</h2>
    <p class="mb-4 text-gray-600">1 = Far below satisfactory, 5 = Excellent</p>

    <div class="space-y-1">
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
            @include('components.rating', ["question" => "Clarity of instructions in the minimal README", "name" => "self-deployment-reflection-q3"])
        </div>
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
            @include('components.rating', ["question" => "Clarity of instructions in the detailed README", "name" => "self-deployment-reflection-q4"])
        </div>
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
            @include('components.rating', ["question" => "Overall effectiveness of your own balanced README", "name" => "self-deployment-reflection-q5"])
        </div>
    </div>
</div>
