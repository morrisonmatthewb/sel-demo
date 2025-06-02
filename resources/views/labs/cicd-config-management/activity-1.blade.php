<h2 class="text-1xl font-bold mb-2">Part 1: Creating a Remote Repository and Pushing Changes</h2>
<ol class='list-decimal list-inside'>
    <li><a href='https://git-scm.com/book/en/v2/Getting-Started-Installing-Git' class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800'>Install Git</a> if not already installed. <a href='https://git-scm.com/book/en/v2/Getting-Started-Installing-Git' class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800'></a></li>
    <li>Create a github account <a class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800' href='https://github.com/signup'>here</a> or login to a pre-existing account</li>
    <li>Follow this guide to create your first repository: <a class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800' href='https://docs.github.com/en/repositories/creating-and-managing-repositories/quickstart-for-repositories'>GitHub Quickstart</a></li>
    <li>Now clone your new repository to your local machine <a class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800' href='https://docs.github.com/en/repositories/creating-and-managing-repositories/quickstart-for-repositories'>using the command line</a></li>
    <li>Make some changes and use <code>'git add .'</code> then <code>'git commit -m ""'</code> then <code>'git push'</code> to push your changes</li>
</ol>
<div class="mt-2 mb-2">
    @include('components.textbox', ["question" => "What do you think are some of the advantages to hosting a remote repository like this?", "name" => "activity1-sa1"])
</div>
<br>
<h2 class="text-1xl font-bold mb-2 mt-2">Part 2: Pulling Changes and Branching</h2>
<ol class='list-decimal list-inside'>
    <li><a class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800' href='https://git-scm.com/book/en/v2/Git-Branching-Basic-Branching-and-Merging'>Create a new branch</a>, switch to that branch, and push some changes.</li>
    <li>Either make some edits to your repository on GitHub or collaborate with a teammate and <a class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800' href='https://git-scm.com/docs/git-pull'>practice pulling changes.</a>
</ol>
<div class="mt-2 mb-2">
    @include('components.textbox', ["question" => "Did you find branching to be simple? Where do you think it could be useful when working on a project?", "name" => "activity1-sa2"])
</div>
<br>
<div class="mt-2 mb-2">
    <h2 class="text-1xl font-bold mb-2 mt-2">Part 3: Mock Project and Merging</h2>
    <p>Now, you and a partner build two seperate web applications that simply display hello world (or more if you want) on the same repository however you like, I'd recommend <a href='https://flask.palletsprojects.com/en/stable/quickstart/' class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800'>Flask</a> or <a class='text-blue-600 hover:text-blue-800 font-medium underline decoration-2 underline-offset-2 hover:decoration-blue-800' href='https://nodejs.org/en/learn/getting-started/introduction-to-nodejs'>Node.js</a> for simplicity. So long as you are both using the same framework its fine. The point of this is to practice what you've learned so far as well as to force merge conflicts so don't collaborate outside of git!<br><b>Hint:</b> The sooner and more often you commit changes the sooner you two will get on the same page.</p>
            @include('components.textbox', ["question" => "What difficulties did you run into when completing this? What did you do to alleviate these difficulties? What would you do differently if you had to do this again? How did you resolve or avoid merge conflicts?", "name" => "activity1-sa3"])
    <br>
</div>
<div class="mt-2 mb-2">
    @include('components.url-input', ["question" => "Enter the link to your repo (must be a github link):", "name" => "activity1-url", "pattern" => "https:\/\/(www\.)?github\.com\/.*", "placeholder" => "https://github.com/username/repo"])
</div>