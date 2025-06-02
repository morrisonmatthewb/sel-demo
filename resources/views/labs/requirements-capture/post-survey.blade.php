@php
    // Text Questions
    $textQuestions = [
        "Describe in your own words what requirements gathering means in software development.",
        "What do you think are the most challenging aspects of understanding a clients needs?",
        "Can you give an example of how miscommunication might lead to a project failure?",
        "How would you approach gathering requirements from a client who is not very technical?",
        "Describe a time (real or hypothetical) when changing requirements impacted a projects scope or outcome."
    ];

    // Rating Questions
    $ratingQuestions = [
        "Understanding the importance of requirements gathering",
        "Identifying stakeholders in a software project",
        "Effective communication with clients to elicit requirements",
        "Asking probing and clarifying questions",
        "Documenting requirements accurately",
        "Understanding the impact of incomplete or incorrect requirements",
        "Recognizing potential misunderstandings or ambiguities in requirements"
    ];
@endphp  
@include('templates.survey', [
    'surveyTitle'       => 'Pre-Module Knowledge Survey',
    'textQuestions'     => $textQuestions,
    'ratingQuestions'   => $ratingQuestions
])
