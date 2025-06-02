@php
$options = array_map('strval', range(1, 60));
@endphp
<!-- Instruction Block -->
<div class="bg-white p-6 rounded-lg mb-6">
    <p class="text-gray-700 mb-8">
        Now you will get the opportunity to estimate how long a problem will take you and then solve the problem. Create a to-do list web app where users can add, mark, and delete tasks. The app should have the following features:
    </p>

    <ul class="list-disc pl-6 space-y-2">
        <li>Add tasks with a form</li>
        <li>Mark tasks as completed</li>
        <li>Delete tasks from the list</li>
    </ul>

    <p class="text-gray-700 mt-8">Before starting to code, answer the below questions. Answer all the questions in minutes.</p>
</div>

<!-- Survey Section -->
    <div class="mb-6">
        @include('components.dropdown', ["question" => "How long do you estimate requirement gathering will take?", "name" => "live-demo-q1", "options" => $options])
    </div>
    <div class="mb-6">
        @include('components.dropdown', ["question" => "How long do you estimate planning will take?", "name" => "live-demo-q2", "options" => $options])
    </div>
    <div class="mb-6">
        @include('components.dropdown', ["question" => "How long do you estimate coding will take?", "name" => "live-demo-q3", "options" => $options])
    </div>
    <div class="mb-6">
        @include('components.dropdown', ["question" => "How long do you estimate testing will take?", "name" => "live-demo-q4", "options" => $options])
    </div>
    <div class="mb-6">
        @include('components.dropdown', ["question" => "How long do you estimate final review will take?", "name" => "live-demo-q5", "options" => $options])
    </div>