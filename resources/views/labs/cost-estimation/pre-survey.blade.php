@php
$options = array_map('strval', range(1, 10));

$dropdownQuestions = [
    [
        "question" => "How many people would be required for this project?",
        "options" => $options
    ],
    [
        "question" => "How many weeks might this project take?",
        "options" => $options
    ],
    [
        "question" => "How many hours per week would be necessary?",
        "options" => $options
    ]
];

$textQuestions = [
    "Identify potential risks or challenges that could affect the project."
];
@endphp

<p> Imagine embarking on a project to design a sophisticated Hospital Management System (HMS) that covers critical areas like patient registration, scheduling, medical records, billing, and external integration with systems such as insurance and lab services. Reflect on these questions to form preliminary thoughts on project estimation.</p>
<br>
@include('templates.survey', ["surveyTitle" => "Pre-Survey","textQuestions" => $textQuestions,"dropdownQuestions" => $dropdownQuestions])
