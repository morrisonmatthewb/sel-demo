@php
    // Text Questions
    $textQuestions = [
        "What tests have you developed in the past? (Classwork, Projects, Internships, Work)",
        "What should you test for when running tests?"
    ];

    // Rating Questions
    $ratingQuestions = [
        "Unit Tests",
        "System Tests",
        "Acceptance Tests",
        "Certification Tests",
        "Regression Tests"
    ];
@endphp  
@include('templates.survey', [
    'surveyTitle'       => 'Pre-Module Knowledge Survey',
    'textQuestions'     => $textQuestions,
    'ratingQuestions'   => $ratingQuestions
])