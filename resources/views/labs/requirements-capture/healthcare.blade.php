@php 
    $initialQuestions = [
        ['id' => 1, 'text' => "What kinds of patient data will be stored in the system?", 'irrelevant' => false],
        ['id' => 9, 'text' => "Are security audits important?", 'irrelevant' => true, 'feedback' => "Regular security audits are not a focus for us right now."],
        ['id' => 2, 'text' => "How will different roles, like doctors or administrative staff, use the system?", 'irrelevant' => false],
        ['id' => 3, 'text' => "What are the primary privacy and security concerns for the system?", 'irrelevant' => false],
        ['id' => 8, 'text' => "Will the system track doctor availability?", 'irrelevant' => true, 'feedback' => "Tracking doctor availability is not necessary for our current scope."],
        ['id' => 5, 'text' => "Are there any integration needs with external systems?", 'irrelevant' => false],
        ['id' => 6, 'text' => "How will data backups and disaster recovery be handled?", 'irrelevant' => false],
        ['id' => 7, 'text' => "Is a pharmacy integration required?", 'irrelevant' => true, 'feedback' => "Pharmacy integration isn’t a priority for us at this stage."],
        ['id' => 4, 'text' => "What are the performance requirements?", 'irrelevant' => false]
    ];

    $followUpQuestions = [
        1 => [
            ['text' => "Do you need storage for emergency contacts?", 'type' => "nonEssential", 'message' => "We’re considering storing emergency contact information in the future.", 'requirement' => "Emergency contact storage"],
            ['text' => "Will you be storing insurance information?", 'type' => "core", 'message' => "We’ll be storing medical histories, personal information, and insurance details.", 'requirement' => "Patient data storage (medical history, personal information, insurance)"],
            ['text' => "Is a patient’s medical history essential to store?", 'type' => "core", 'message' => "Yes, storing medical history is critical for patient care.", 'requirement' => "Patient data storage (medical history)"],
            ['text' => "Will you require billing data storage?", 'type' => "irrelevant", 'message' => "Billing data storage isn't a priority at the moment."]
        ],
        2 => [
            ['text' => "Will doctors need quick access to patient records?", 'type' => "core", 'message' => "Yes, doctors need quick access to patient records.", 'requirement' => "Quick access to patient records"],
            ['text' => "Would you consider giving patients some access?", 'type' => "nonEssential", 'message' => "Patient access is something we may consider in the future.", 'requirement' => "Patient access"],
            ['text' => "Is there a need for scheduling tools for staff?", 'type' => "core", 'message' => "Scheduling and billing tools are necessary for administrative staff.", 'requirement' => "Scheduling tools for staff"],
            ['text' => "Should the system track doctor availability?", 'type' => "irrelevant", 'message' => "Tracking doctor availability isn’t necessary."]
        ],
        3 => [
            ['text' => "Do you require HIPAA compliance?", 'type' => "core", 'message' => "Yes, HIPAA compliance and encryption are essential for us.", 'requirement' => "HIPAA compliance and encryption"],
            ['text' => "Will the system need a patient portal?", 'type' => "nonEssential", 'message' => "A patient portal is a secondary consideration for us.", 'requirement' => "Patient portal"],
            ['text' => "Should data access be role-based?", 'type' => "core", 'message' => "Role-based access is required to ensure security.", 'requirement' => "Role-based access"],
            ['text' => "Are security audits important?", 'type' => "irrelevant", 'message' => "Audits aren’t a priority for us currently."]
        ],
        4 => [
            ['text' => "Will it need to be accessible 24/7?", 'type' => "core", 'message' => "24/7 availability is a must.", 'requirement' => "24/7 system availability"],
            ['text' => "Is AI-based health tracking something you want?", 'type' => "nonEssential", 'message' => "AI-based health tracking is something we may explore in the future.", 'requirement' => "AI-based health tracking"],
            ['text' => "Is instant data retrieval crucial?", 'type' => "irrelevant", 'message' => "Instant retrieval isn’t critical at this point."],
            ['text' => "Do you want load balancing?", 'type' => "irrelevant", 'message' => "Load balancing isn’t necessary for now."]
        ],
        5 => [
            ['text' => "Will you need integration with insurance providers?", 'type' => "core", 'message' => "Integration with insurance providers is essential.", 'requirement' => "Insurance integration"],
            ['text' => "Is telehealth integration on the roadmap?", 'type' => "nonEssential", 'message' => "Telehealth integration may be something we consider later.", 'requirement' => "Telehealth integration"],
            ['text' => "Do you need integration with labs?", 'type' => "core", 'message' => "Lab integration is required for our system.", 'requirement' => "Lab integration"],
            ['text' => "Is pharmacy integration necessary?", 'type' => "irrelevant", 'message' => "We’re not prioritizing pharmacy integration at this time."]
        ],
        6 => [
            ['text' => "Will backups need to be encrypted?", 'type' => "core", 'message' => "Encrypted backups are necessary.", 'requirement' => "Encrypted backups"],
            ['text' => "Would you prefer a hybrid cloud storage?", 'type' => "nonEssential", 'message' => "Hybrid cloud storage is something we might look at later.", 'requirement' => "Hybrid cloud storage"],
            ['text' => "Is daily backup frequency acceptable?", 'type' => "irrelevant", 'message' => "Daily backups aren't a strict requirement."],
            ['text' => "Would you like auto-recovery options?", 'type' => "irrelevant", 'message' => "Auto-recovery options are not currently a focus."]
        ]
    ];
    $scenarioText = "Our goal is to create a robust system for managing patient records and administrative tasks, ensuring security and easy access for healthcare providers.";
@endphp
@include('templates.scenario', [
    'initialQuestions' => $initialQuestions,
    'followUpQuestions' => $followUpQuestions,
    'scenarioText' => $scenarioText,
    'maxCoreReqs' => 10
])