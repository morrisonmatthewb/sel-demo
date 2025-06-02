
@php 
    $module = 'validation-testing';
    $prevPage = 'v2';
    $currentPage = 'v2-reflect';
    // Questions
    $textQuestions = [
        "How did Budget Tracker v2 differ from Budget Tracker v1?",
        "What features are helpful for Budget Tracker v2?",
        "What can be improved on for Budget Tracker v2?",
        "What actions did you take to catch these bugs or potential points of improvement?",
        "What types of tests could you perform to prevent them from making their way into the final deliverable? (the version submitted to the client)"
    ];
@endphp
@include('templates.survey', [
    'surveyTitle'       => 'Budget Tracker v2 Reflection',
    'textQuestions'     => $textQuestions
])
