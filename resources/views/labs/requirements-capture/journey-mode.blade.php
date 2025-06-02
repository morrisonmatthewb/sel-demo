@php
    $scenarios = [
            'ecommerce' => 'Start E-commerce Scenario',
            'healthcare' => 'Start Healthcare Scenario',
            'education' => 'Start Education Scenario',
        ]; 
    $completedPages = []; 

    foreach ($scenarios as $scenario => $scenarioDisplay) {
        if (isset($formData[$scenario]['completed']) && $formData[$scenario]['completed']) {
            $completedPages[] = $scenario;
        }
    }
@endphp

<h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Select a Scenario to Begin</h1>
<p class="text-gray-600 mb-6 text-center">
    In this section, you'll work through three different scenarios to practice gathering requirements. In each scenario, you will be required to choose from a list of questions to ask your client. To finish the scenario, you must find all of the core requirements for that scenario. Not every requirement you find will be a core requirement, but it may still extract important information. Each scenario focuses on a unique project with a different client:
</p>

<div class="bg-yellow-50 p-6 rounded-lg shadow">
    <ul class="list-disc list-inside mb-6 mx-auto text-left text-gray-600 space-y-2 w-full">
        <li><strong class="text-gray-700">E-commerce Platform</strong>: Create an online store with features like inventory management, payment processing, and user experience.</li>
        <li><strong class="text-gray-700">Healthcare Management System</strong>: Design a system for managing patient records, complying with data privacy, and streamlining administrative tasks.</li>
        <li><strong class="text-gray-700">Educational Learning Platform</strong>: Build a platform for interactive learning, course tracking, and student assessments with a focus on accessibility and scalability.</li>
    </ul>
</div>

<p class="text-gray-600 mb-8 text-center">
    Complete each scenario to gather all core requirements and learn to ask clarifying questions. You will need to complete all three scenarios to proceed.
</p>

<div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
    @foreach ($scenarios as $key => $label)
        <a href="{{ route('modules.lab', ['lab' => 'requirements-capture', 'subroute' => $key]) }}" 
           class="px-6 py-3 rounded text-white font-semibold
           focus:outline-none focus:ring-2 focus:ring-blue-500
           {{ in_array($key, $completedPages) ? 'bg-green-500 hover:bg-green-600' : 'bg-blue-500 hover:bg-blue-600' }}">
            {{ $label }}
        </a>
    @endforeach
</div>

<script>
    function allScenariosCompleted() {
        const completedPages = @json($completedPages);
        const requiredScenarios = @json(array_keys($scenarios));
        
        return requiredScenarios.every(scenario => completedPages.includes(scenario));
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('next').href = "{{ route('modules.lab', ['lab' => $module, 'subroute' => 'post-mortem']) }}";
        if (allScenariosCompleted()) {
            enableButton('next');
        } else {
            disableButton('next');
        }
    });
</script>
