<script>

    // Topic data
    const topics = {
        'intro': {
            title: 'Introduction to Installers',
            content: `
                <h2 class="text-2xl font-bold mb-4">What is an Installer?</h2>
                <div class="prose max-w-none">
                    <p class="mb-4">
                        An installer is a software package used to set up an application on a computer, automating the process of extracting files, configuring settings, and ensuring compatibility with the target system. Common installer types include '.exe' for Windows, '.dmg' for macOS, and '.deb' for Linux. They play a crucial role in delivering a smooth user experience.
                    </p>
                    <h3 class="text-xl font-semibold mb-3">Benefits of Using Installers:</h3>
                    <ul class="list-disc pl-6 mb-4">
                        <li>Automates installation processes, reducing user effort.</li>
                        <li>Ensures that all necessary files and dependencies are included.</li>
                        <li>Provides a user-friendly interface for setup, reducing errors.</li>
                        <li>Handles versioning, updates, and security requirements efficiently.</li>
                    </ul>
                    <p>Examples include popular software like Zoom, Discord, and Slack, each utilizing tailored installers for different platforms to provide seamless setup experiences.</p>
                </div>
            `
        },
        'installer_creation': {
            title: 'Creating Software Installers',
            content: `
                <h2 class="text-2xl font-bold mb-4">How to Create a Software Installer</h2>
                <div class="prose max-w-none">
                    <p class="mb-4">
                        Creating installers involves using tools specific to each platform. Key tools include:
                    </p>
                    <ul class="list-disc pl-6 mb-4">
                        <li><strong>Inno Setup:</strong> A free tool for creating Windows installers. It allows customization of setup dialogs and scripting options.</li>
                        <li><strong>NSIS (Nullsoft Scriptable Install System):</strong> Suitable for complex Windows installer needs with script-based setup creation.</li>
                        <li><strong>pkgbuild:</strong> A macOS tool that assists in packaging software as '.pkg' files, making it easy for users to install applications.</li>
                    </ul>
                    <p>Building a basic installer typically involves defining which files are included, setting up installation paths, and configuring post-installation scripts for setup.</p>
                    
                    <div class="bg-gray-100 p-4 rounded-lg mb-6">
                        <h3 class="text-lg font-semibold mb-2">Sample Analysis</h3>
                        <p class="mb-2">Imagine you are creating an installer for a cross-platform app that requires different file structures for Windows and macOS. What should you consider when specifying installation paths?</p>
                        <p class="text-gray-600 italic mb-2">Hint: Think about how different operating systems handle file permissions and user directories.</p>
                        <button onclick="showAnswer('installer_creation')" class="text-blue-500 hover:text-blue-700">Show Answer</button>
                        <div id="answer-installer_creation" class="hidden mt-2 p-3 bg-green-50 border border-green-200 rounded">
                            You need to ensure that installation paths comply with the OS conventions. For example, on Windows, it’s common to install programs in 'C:\\Program Files', while on macOS, applications typically reside in the 'Applications' folder. Additionally, consider user permissions and ensure that files are placed in directories where users have appropriate access.
                        </div>
                    </div>
                </div>
            `
        },
        'documentation': {
            title: 'Importance of Documentation',
            content: `
                <h2 class="text-2xl font-bold mb-4">Role of Documentation in Self-Deployment</h2>
                <div class="prose max-w-none">
                    <p class="mb-4">
                        Documentation is essential for guiding users through the deployment process. A well-written 'README' file helps users understand how to install, configure, and run applications. Effective documentation can greatly enhance the user's ability to deploy software independently.
                    </p>
                    <h3 class="text-xl font-semibold mb-3">Best Practices:</h3>
                    <ul class="list-disc pl-6 mb-4">
                        <li>Clearly list prerequisites and dependencies.</li>
                        <li>Provide step-by-step instructions with examples.</li>
                        <li>Include troubleshooting tips for common issues.</li>
                        <li>Use screenshots or video guides for complex steps.</li>
                    </ul>
                    
                    <div class="bg-gray-100 p-4 rounded-lg mb-6">
                        <h3 class="text-lg font-semibold mb-2">Sample Analysis</h3>
                        <p class="mb-2">You are writing a README file for a new web app that requires a specific Node.js version and certain environment variables. What sections should you include in the README to ensure users can successfully set up the app?</p>
                        <p class="text-gray-600 italic mb-2">Hint: Consider prerequisites and the installation process.</p>
                        <button onclick="showAnswer('documentation')" class="text-blue-500 hover:text-blue-700">Show Answer</button>
                        <div id="answer-documentation" class="hidden mt-2 p-3 bg-green-50 border border-green-200 rounded">
                            The README should include a 'Prerequisites' section listing the required Node.js version and instructions for setting up environment variables. A 'Setup' section should provide a step-by-step guide to cloning the repository, installing dependencies, and running the app. Including a 'Troubleshooting' section can help users resolve common issues during setup.
                        </div>
                    </div>
                </div>
            `
        }
    };

    // Initialize topicViewed object using Local Storage
    const topicViewed = JSON.parse(localStorage.getItem('topicViewed')) || Object.keys(topics).reduce((acc, key) => {
        acc[key] = false; // Initially set all topics to unviewed
        return acc;
    }, {});

    // Save progress to Local Storage
    function saveProgress() {
        localStorage.setItem('topicViewed', JSON.stringify(topicViewed));
    }

    function checkAllTopicsViewed() {
        const allViewed = Object.values(topicViewed).every(viewed => viewed === true);
        const nextButton = document.getElementById('nextButton');
        const completionMessage = document.getElementById('completionMessage');
        if (nextButton && completionMessage) {
            if (allViewed) {
                nextButton.classList.remove('hidden');
                completionMessage.classList.add('hidden');
            } else {
                nextButton.classList.add('hidden');
                completionMessage.classList.remove('hidden');
            }
        }
    }

    function showTopic(topicKey) {
        const contentDiv = document.getElementById('topicContent');
        if (contentDiv && topics[topicKey]) {
            contentDiv.innerHTML = topics[topicKey].content;
        }

        if (!topicViewed[topicKey]) {
            topicViewed[topicKey] = true;
            saveProgress();
            checkAllTopicsViewed();
        }

        document.querySelectorAll('#topicsList div').forEach(div => {
            div.classList.remove('bg-blue-50');
        });

        event.currentTarget.classList.add('bg-blue-50');
    }

    function showAnswer(topicKey) {
        const answerDiv = document.getElementById(`answer-${topicKey}`);
        const button = event.target;
        answerDiv.classList.toggle('hidden');
        button.textContent = answerDiv.classList.contains('hidden') ? 'Show Answer' : 'Hide Answer';
    }

    document.addEventListener('DOMContentLoaded', function () {
        const topicsList = document.getElementById('topicsList');
        Object.entries(topics).forEach(([key, topic]) => {
            const topicElement = document.createElement('div');
            topicElement.className = `p-4 hover:bg-gray-50 cursor-pointer ${topicViewed[key] ? 'bg-blue-50' : ''}`;
            topicElement.textContent = topic.title;
            topicElement.onclick = (event) => showTopic(key);
            topicsList.appendChild(topicElement);
        });
        checkAllTopicsViewed();
    });
</script>
<div class="bg-gray-100 min-h-screen flex flex-col justify-between">
    <div class="container mx-auto px-6 py-8 flex-grow">
        <p>Go through these topics to introduce yourself to installers and self-deployment.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Topics List -->
            <div class="bg-white rounded-lg shadow">
                <h2 class="text-xl font-bold p-4 border-b">Topics</h2>
                <div class="overflow-y-auto max-h-[600px]">
                    <div id="topicsList" class="divide-y"></div>
                </div>
            </div>
            <!-- Content Display -->
            <div class="md:col-span-2">
                <div id="topicContent" class="bg-white p-6 rounded-lg shadow min-h-[600px]">
                    <div class="text-center text-gray-500 mt-20">
                        <p class="text-xl">Select a topic from the list to view its content</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
