@php
$textHead = 
<<< HTML
<div class="text-1xl font-bold mb-2">Short Answer Questions</div>
<p class="mb-2">
    These questions are designed to get you thinking about CI/CD and give the instructor an idea of how much you know about CI/CD going into this module.<br>
    Answers may be as long or short as you like. If you have no idea how to answer these questions, just leave them blank or respond with N/A.
</p>
HTML;
$textQuestions = [
"What could go wrong if five developers wait until Friday afternoon to combine all their code changes from the week? How might you solve this?",
"If it takes your team 2 days of careful manual work to release a new version, how often would you be willing to release changes? Why? What do you think a better solution may be?",
"What do you think the difference is between Continuous Integration (CI) and Continuous Deployment (CD)? What is the main goal of each?"
];
$ratingHead = 
<<< HTML
<h2 class="text-1xl font-bold mb-4">Rate Your Knowledge (1-5)</h2>
<p class="mb-4 text-gray-600">1 = No Knowledge, 5 = Expert</p>
HTML;
$ratingQuestions = ['Version Control and Branching Strategies', 'Automated Testing', 'Pipeline Design', 'Deployment Strategies', 'Infrastructure as Code', 'Monitoring and Feedback', 'Container Management', 'Environment Management', 'Recovery and Rollback'];
@endphp
@include('templates.survey', ["surveyTitle" => "Pre-Survey", "textHead" => $textHead, "textQuestions" => $textQuestions, "ratingQuestions" => $ratingQuestions])