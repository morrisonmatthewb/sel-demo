@php 
    // Questions
    $textQuestions = [
        "What features are helpful for Budget Tracker v1?",
        "What can be improved on for Budget Tracker v1?",
        "What actions did you take to catch these bugs or potential points of improvement?",
        "What types of tests could you perform to prevent them from making their way into the final deliverable? (the version submitted to the client)"
    ];
@endphp
@include('templates.survey', [
    'surveyTitle'       => 'Budget Tracker v1 Reflection',
    'textQuestions'     => $textQuestions
])