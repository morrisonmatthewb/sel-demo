<h2 class="text-1xl font-bold mb-2">Part 1: Moving to GitLab</h2>
<ol class='list-decimal list-inside'>
    <li><a class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800' href='https://about.gitlab.com/get-started/'>Sign-up</a> for a free trial with GitLab.
    <li>Once your done making an account, create a new project. I'd recommend choosing the plain html template for simplicity but its up to you.</li>
    <li>Now navigate the home page and try to figure out how to import your project from activity 1.</li>
</ol>
<div class="mt-2 mb-2">
    @include('components.textbox', ["question" => "Did you find this easy? Is there anything you particularly liked or disliked about the GitLab interface compared to GitHub?", "name" => "activity2-sa1"])
</div>
<br>
<h2 class="text-1xl font-bold mb-2 mt-2">Part 2: Creating a GitLab CI/CD Pipeline</h2>
<ol class='list-decimal list-inside'>
    <li><a class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800' href='https://git-scm.com/book/en/v2/Git-Branching-Basic-Branching-and-Merging'>Create a new branch</a>, switch to that branch, and push some changes.</li>
    <li>Follow <a class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800' href='https://docs.gitlab.com/ee/ci/quick_start/'>this guide</a> to create your first pipeline.</li>
</ol>
<div class="mt-2 mb-2">
    @include('components.textbox', ["question" => "What did you think? Easy? Annoying? Useful? Briefly reflect on your first pipeline what may be good or bad about it, what could be added, what could be changed?", "name" => "activity2-sa2"])
</div>
<br>
<div class="mt-2 mb-2">
    <h2 class="text-1xl font-bold mb-2 mt-2">Part 3: Mock Project and Merging</h2>
    <p>Now that you've created your first pipeline, you can make another! This time, with the same partner, same rules, create a web app that generates and checks a 5 card poker hand. The user will press a button to generate a hand, and another to check its value. <br>This time, talk with your partner and develop a CI/CD pipeline before starting the bulk of the project. Once you're done or time is up, you will seperate and then once again work inpendently on it with no communication other than merges, branches, and commits.<br>Once you've gotten it in a testable state, get back in touch with your partner to add some automated testing to your pipeline.</p>
    <br>
    @include('components.textbox', ["question" => "What difficulties did you run into when completing this? What did you do to alleviate these difficulties? Do you think this project would have been easier or harder had you not developed the pipeline first? Is there anything you would change about your pipeline after completing this project?", "name" => "activity2-sa3"])
    <br>
</div>
<div class="mt-2 mb-2">
    @include('components.url-input', ["question" => "Enter the link to your repo (must be a gitlab link):", "name" => "activity2-url", "pattern" => "https:\/\/(www\.)?gitlab\.com\/.*", "placeholder" => "https://gitlab.com/username/repo"])
</div>