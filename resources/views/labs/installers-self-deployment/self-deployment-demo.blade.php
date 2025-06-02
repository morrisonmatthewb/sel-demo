<!-- Instructions -->
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Instructions</h2>
    <p class="mb-4">
        In this portion of the exercise, try setting up the application from the provided GitHub repositories by following each README. 
        Take mental notes on what makes the README helpful or challenging, as in the next part of the exercise, you’ll create your own README.
    </p>
    <p class="mb-4">
        After each deployment attempt, reset your setup environment by navigating out of the project directory and removing it. 
        Use the following commands based on your platform:
    </p>
    <ul class="list-disc pl-6">
        <li><strong>Windows:</strong></li>
        @include('components.code', [
            'language' => 'bash',
            'code' => "cd ..\nrmdir /S /Q deployment-exercise"
        ])
        <li><strong>macOS/Linux:</strong></li>
        @include('components.code', [
            'language' => 'bash',
            'code' => "cd ..\nrm -rf deployment-exercise"
        ])
    </ul>
</div>

<!-- GitHub Links Section -->
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">GitHub Links</h2>
    <p class="mb-4">Click each link below to access a different version of the application README. Follow the instructions provided in each README to deploy the application.</p>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">README</th>
                <th class="border border-gray-300 px-4 py-2">GitHub Link</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-300 px-4 py-2">README #1</td>
                <td class="border border-gray-300 px-4 py-2"><a href="https://github.com/ayhanmehdiyev/deployment-exercise/tree/minimal" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:underline">Visit README #1</a></td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-4 py-2">README #2</td>
                <td class="border border-gray-300 px-4 py-2"><a href="https://github.com/ayhanmehdiyev/deployment-exercise/tree/detailed" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:underline">Visit README #2</a></td>
            </tr>
        </tbody>
    </table>
</div>
