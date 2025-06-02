@php 
    $initialQuestions = [
        ['id' => 1, 'text' => "What type of interactivity do you envision between students and the platform?", 'irrelevant' => false],
        ['id' => 2, 'text' => "How will instructors interact with the platform?", 'irrelevant' => false],
        ['id' => 4, 'text' => "How will user data and privacy be managed?", 'irrelevant' => false],
        ['id' => 7, 'text' => "Will the platform support live chat?", 'irrelevant' => true, 'feedback' => "Live chat isn’t a priority for us at this stage."],
        ['id' => 8, 'text' => "Is parental monitoring important?", 'irrelevant' => true, 'feedback' => "Parental monitoring is a secondary feature for us."],
        ['id' => 5, 'text' => "Will the platform support multimedia content?", 'irrelevant' => false],
        ['id' => 6, 'text' => "What are the expectations for student assessments?", 'irrelevant' => false],
        ['id' => 3, 'text' => "What are the scalability requirements?", 'irrelevant' => false],
        ['id' => 9, 'text' => "Would you like social media integration?", 'irrelevant' => true, 'feedback' => "Social media integration is not necessary."]
    ];

    $followUpQuestions = [
        1 => [
            ['text' => "Are discussion forums necessary?", 'type' => "nonEssential", 'message' => "We might consider adding forums as a feature.", 'requirement' => "Discussion forums"],
            ['text' => "Do you want real-time quizzes?", 'type' => "core", 'message' => "Real-time quizzes and assignment feedback are essential.", 'requirement' => "Real-time quizzes and feedback"],
            ['text' => "Is live chat important?", 'type' => "irrelevant", 'message' => "Live chat isn’t a priority."],
            ['text' => "Would you like social media integration?", 'type' => "irrelevant", 'message' => "Social media integration isn’t necessary at this time."]
        ],
        2 => [
            ['text' => "Will grading tools be necessary?", 'type' => "core", 'message' => "Grading tools and progress tracking are crucial for us.", 'requirement' => "Grading tools and progress tracking"],
            ['text' => "Would you consider a peer-grading system?", 'type' => "nonEssential", 'message' => "Peer-grading could be an interesting future addition.", 'requirement' => "Peer grading system"],
            ['text' => "Will instructors need to communicate with students?", 'type' => "irrelevant", 'message' => "Communication tools are not a current priority."],
            ['text' => "Should instructors create student groups?", 'type' => "irrelevant", 'message' => "Grouping features are not essential at this time."]
        ],
        3 => [
            ['text' => "Will it need to support corporate training?", 'type' => "nonEssential", 'message' => "Corporate training is a potential future goal.", 'requirement' => "Corporate training expansion"],
            ['text' => "Do you need support for thousands of users?", 'type' => "core", 'message' => "Yes, the platform must be scalable to support large numbers of users.", 'requirement' => "Platform scalability"],
            ['text' => "Will small class sizes suffice?", 'type' => "irrelevant", 'message' => "We are looking for something beyond small class sizes."],
            ['text' => "Are multiple regions required?", 'type' => "irrelevant", 'message' => "Regional support is not currently needed."]
        ],
        4 => [
            ['text' => "Should it be FERPA-compliant?", 'type' => "core", 'message' => "FERPA compliance is essential.", 'requirement' => "FERPA compliance"],
            ['text' => "Would you want parental monitoring features?", 'type' => "nonEssential", 'message' => "Parental monitoring may be a secondary feature.", 'requirement' => "Parental monitoring"],
            ['text' => "Do you need encryption?", 'type' => "core", 'message' => "Encryption and secure data handling are mandatory.", 'requirement' => "Secure data handling"],
            ['text' => "Will you need detailed data analytics?", 'type' => "irrelevant", 'message' => "Detailed analytics aren’t a priority."]
        ],
        5 => [
            ['text' => "Do you want AR/VR elements?", 'type' => "nonEssential", 'message' => "AR/VR is something we might consider later.", 'requirement' => "AR/VR features"],
            ['text' => "Will it support video lectures?", 'type' => "core", 'message' => "Supporting video lectures, PDFs, and images is crucial.", 'requirement' => "Multimedia support"],
            ['text' => "Is audio integration essential?", 'type' => "irrelevant", 'message' => "Audio integration isn’t critical at the moment."],
            ['text' => "Do you need interactive animations?", 'type' => "irrelevant", 'message' => "Interactive animations aren’t a requirement."]
        ],
        6 => [
            ['text' => "Do you want flexible grading rubrics?", 'type' => "core", 'message' => "Customizable exam formats and flexible grading rubrics are important.", 'requirement' => "Customizable assessments and grading rubrics"],
            ['text' => "Is competency-based learning a priority?", 'type' => "nonEssential", 'message' => "Competency-based learning could be explored in the future.", 'requirement' => "Competency-based learning"],
            ['text' => "Should grading be automated?", 'type' => "irrelevant", 'message' => "Automated grading isn’t necessary."],
            ['text' => "Will tests include written answers?", 'type' => "irrelevant", 'message' => "This isn’t a critical requirement."]
        ]
    ];
    $scenarioText = "We’re aiming to build a platform for online courses, with assignments, tests, and interactive elements for an engaging learning experience.";
@endphp
@include('templates.scenario', [
    'initialQuestions' => $initialQuestions,
    'followUpQuestions' => $followUpQuestions,
    'scenarioText' => $scenarioText,
    'maxCoreReqs' => 7
])