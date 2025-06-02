<script>
    function validateCollege() {
        const userInput = document.querySelector('[name="installers-demo-question"]').value.trim();
        
        // Regex to check if "rice" is in the input, case insensitive
        const validRegex = /rice/i;

        if (validRegex.test(userInput)) {
            document.getElementById("feedbackMessage").innerHTML = "<span class='text-green-500 font-semibold'>Correct! Well done.</span>";
        } else {
            document.getElementById("feedbackMessage").innerHTML = "<span class='text-red-500 font-semibold'>Incorrect. Please try again.</span>";
        }
    }
</script>
<!-- Developer Setup Guide -->
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Key Components to Set Up in an Installer</h2>
    <p>This guide explains the essential elements a developer should configure when creating an installer. These elements ensure a smooth installation experience for the end-user.</p>
    <br>
    <ul class="list-disc pl-6">
        <li>
            <strong>Pathing and Environment Variables</strong>: 
            Set the default installation path and environment variables so that the software installs in a consistent location across systems.
            <ul class="list-disc pl-6 mt-2">
                <li>On Windows, define the path in the installer to typically default to <code>C:\Program Files\YourApp</code>. Ensure that environment variables are set for any dependencies the app requires.</li>
                <li>On macOS/Linux, use paths like <code>/usr/local/YourApp</code> and set environment variables in shell startup files if required.</li>
            </ul>
        </li>
        <br>
        <li>
            <strong>License Agreement</strong>: 
            Include a legal document (EULA) that users must agree to before installation begins.
            <ul class="list-disc pl-6 mt-2">
                <li>Use a plain text or HTML file that outlines the terms and conditions of software use.</li>
                <li>The installer should display this agreement with an "Agree" button that users must click to proceed.</li>
            </ul>
        </li>
        <br>
        <li>
            <strong>Configuration Files</strong>: 
            Provide default configuration files that allow users to customize aspects of the software.
            <ul class="list-disc pl-6 mt-2">
                <li>Include options such as install location, language preferences, or database configurations.</li>
                <li>Configuration files should be placed in a common directory, like <code>config/</code>, within the installation path.</li>
            </ul>
        </li>
        <br>
        <li>
            <strong>Error Handling and Logging</strong>: 
            Enable logging to capture any errors that occur during installation. This helps with troubleshooting.
            <ul class="list-disc pl-6 mt-2">
                <li>For Windows, save log files in the user's temp directory (e.g., <code>%TEMP%</code>) or installation directory.</li>
                <li>On macOS/Linux, log files can be saved in <code>/var/log/YourApp</code> or the installation directory.</li>
            </ul>
        </li>
    </ul>
    <br>
    <p>Now let's help you get an idea of what an installer looks like and how it works</p>
    <br>
    <!-- Table of Example Installers -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Download Example Installers</h2>
    <p>Try out a custom installer for your platform to explore a complete installation experience. You can select and download installers for any platform below:</p>
    <p>Note: You may have to `pip install Pillow` before running.</p>
    <p>Note: For Windows, you will have to run anyway because the installer is not notarized.</p>
    <p>Note: For macOS, you will have to right click and open with through the finder to run it.</p>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Platform</th>
                <th class="border border-gray-300 px-4 py-2">File Name</th>
                <th class="border border-gray-300 px-4 py-2">Download</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-300 px-4 py-2">Windows</td>
                <td class="border border-gray-300 px-4 py-2">example-installer.exe</td>
                <td class="border border-gray-300 px-4 py-2"><a href="https://github.com/ayhanmehdiyev/example-installers/raw/refs/heads/main/installers/windows/example-installer.exe" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:underline">Download</a>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-4 py-2">macOS</td>
                <td class="border border-gray-300 px-4 py-2">example-installer.pkg</td>
                <td class="border border-gray-300 px-4 py-2"><a href="https://github.com/ayhanmehdiyev/example-installers/raw/refs/heads/main/installers/macos/ExampleInstallers.pkg" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:underline">Download</a></td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-4 py-2">Linux</td>
                <td class="border border-gray-300 px-4 py-2">example-installer.deb</td>
                <td class="border border-gray-300 px-4 py-2"><a href="https://github.com/ayhanmehdiyev/example-installers/raw/refs/heads/main/installers/linux/example-installer.deb" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:underline">Download</a></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- User Input Section -->
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Validation Question</h2>
    @include('components.textbox', ["question" => "After installing the application, please enter the name of the mentioned college/university in the application:", "name" => "installers-demo-question"])
    <button onclick="validateCollege()" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 mt-4">Submit</button>
    <p id="feedbackMessage" class="mt-4"></p>
</div>