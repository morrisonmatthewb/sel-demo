<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.1.0/github-markdown.min.css">
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
    function switchTab(tab) {
        document.getElementById('rawTextTab').classList.toggle('hidden', tab !== 'raw');
        document.getElementById('previewTab').classList.toggle('hidden', tab !== 'preview');
        if (tab === 'preview') updatePreview();
    }
    function updatePreview() {
        const markdownText = document.getElementById('readmeTextbox').value;
        document.getElementById('previewContent').innerHTML = marked.parse(markdownText);
    }
</script>


<!-- Instructions -->
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Instructions</h2>
    <p class="mb-4">Now that you've tried deploying the application using two drastically different README styles, it’s up to you to create a README that strikes the perfect balance between detail and conciseness.</p>
    <p class="mb-4">Your README should be informative enough to guide users with clear setup instructions and troubleshooting tips, but concise enough to avoid overwhelming information.</p>
    <h3 class="text-lg font-semibold mt-6">Best Practices for README Creation</h3>
    <ul class="list-disc pl-6 mt-4">
        <li><strong>Keep it Structured</strong>: Divide your README into sections such as <em>Introduction</em>, <em>Installation</em>, <em>Usage</em>, and <em>Troubleshooting</em>.</li>
        <li><strong>Use Clear and Simple Language</strong>: Write instructions that are easy to follow for all users, regardless of their technical background.</li>
        <li><strong>Include Code Blocks</strong>: Use code formatting for commands and code snippets, making it easy for users to copy and paste commands.</li>
        <li><strong>Add Examples</strong>: Provide examples of how to run the application or use its main features.</li>
        <li><strong>Address Common Issues</strong>: List potential issues users might encounter during setup or usage, along with their solutions.</li>
        <li><strong>Provide Contact Information</strong>: Optionally, include ways users can reach out for help or report issues, like a GitHub Issues link.</li>
    </ul>
</div>



<!-- README Input and Preview -->
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Create Your README</h2>
    <p class="mb-4">Write your README in the text editor below. Use the tabs to switch between raw Markdown and a preview of your file.</p>
    <p class="mb-4">Please refer to <a href="https://docs.github.com/en/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:underline">GitHub Markdown Formatting</a> for help writting a README.</p>
    <!-- Tab Navigation -->
    <div class="flex mb-4 space-x-4">
        <button onclick="switchTab('raw')" class="bg-blue-500 text-white px-4 py-2 rounded">Raw Text</button>
        <button onclick="switchTab('preview')" class="bg-gray-500 text-white px-4 py-2 rounded">Preview</button>
    </div>
    <!-- Raw Text Tab -->
    <div id="rawTextTab">
        @include('components.textbox', ['question' => 'Write your README file here:', 'name' => 'self-deployment-creation-readme', 'id' => 'readmeTextbox'])
    </div>
    <!-- Preview Tab -->
    <div id="previewTab" class="hidden">
        <div id="previewContent" class="markdown-body p-4 border rounded-lg bg-gray-100"></div>
    </div>
</div>