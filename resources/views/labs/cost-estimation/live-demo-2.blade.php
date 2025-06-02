@php
$options = array_map('strval', range(1, 60));
@endphp
<!-- Instruction Block -->
<div class="bg-white p-6 rounded-lg mb-6">
    <p class="text-gray-700 mb-8">
       <strong> Now is the time to code.</strong> 
    </p>
<p class="mb-2">Create a to-do list web app where users can add, mark, and delete tasks. The app should have the following features:
    <ul class="list-disc pl-6 space-y-2">
        <li>Add tasks with a form</li>
        <li>Mark tasks as completed</li>
        <li>Delete tasks from the list</li>
    </ul>
</p>
    <p class="text-gray-700 mt-8">After coding, answer the below questions. Answer all the questions in minutes.</p>
</div>

<!-- Survey Section -->
    <div class="mb-6">
        @include('components.dropdown', ["question" => "How long do you estimate requirement gathering took?", "name" => "live-demo2-q1", "options" => $options])
    </div>
    <div class="mb-6">
        @include('components.dropdown', ["question" => "How long do you estimate planning took?", "name" => "live-demo2-q2", "options" => $options])
    </div>
    <div class="mb-6">
        @include('components.dropdown', ["question" => "How long do you estimate coding took?", "name" => "live-demo2-q3", "options" => $options])
    </div>
    <div class="mb-6">
        @include('components.dropdown', ["question" => "How long do you estimate testing took?", "name" => "live-demo2-q4", "options" => $options])
    </div>
    <div class="mb-6">
        @include('components.dropdown', ["question" => "How long do you estimate final review took?", "name" => "live-demo2-q5", "options" => $options])
    </div>
    <div class="mb-6">
        @include('components.textbox', ["question" => "Reflect on your answers on the previous page compared to your answers on this page. What surprised you? What parts took longer than expected and what took shorter than expected? Reflect on the reasons for such discrepancies and how to avoid them.", "name" => "live-demo2-textbox"])
    </div>