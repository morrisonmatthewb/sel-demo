
@php
    // Questions
    $textQuestions = [
        "After completing the validation testing module, which type of test (e.g., Unit, System, Acceptance, Certification, or Regression) do you believe is most critical in ensuring software quality? Why?",
        "What should you test for when running extensive tests?",
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
    'surveyTitle'       => 'Post-Module Knowledge Survey',
    'textQuestions'     => $textQuestions,
    'ratingQuestions'   => $ratingQuestions
])