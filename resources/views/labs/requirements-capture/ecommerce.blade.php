@php
    $initialQuestions = [
        ['id' => 9, 'text' => "Would you like to integrate chat support on the platform?", 'irrelevant' => true, 'feedback' => "Chat support is not essential for the initial launch."],
        ['id' => 1, 'text' => "What kind of products will be sold on this platform?", 'irrelevant' => false],
        ['id' => 2, 'text' => "Are there specific user experiences or features you envision for your target audience?", 'irrelevant' => false],
        ['id' => 8, 'text' => "Do you plan to have seasonal promotions?", 'irrelevant' => true, 'feedback' => "Seasonal promotions are not a priority at this stage."],
        ['id' => 4, 'text' => "What are your expectations for payment processing on the platform?", 'irrelevant' => false],
        ['id' => 5, 'text' => "How important is user experience in terms of ease of use and visual appeal?", 'irrelevant' => false],
        ['id' => 6, 'text' => "Are there any privacy or security requirements we should be aware of?", 'irrelevant' => false],
        ['id' => 7, 'text' => "Is the store targeting international customers?", 'irrelevant' => true, 'feedback' => "Our focus is mainly domestic for now, with potential for international expansion later."],
        ['id' => 3, 'text' => "How do you plan to manage inventory and product categorization?", 'irrelevant' => false]
    ];

    $followUpQuestions = [
        1 => [
            ['text' => "Do you expect to add more categories in the future?", 'type' => "nonEssential", 'message' => "In the future, we’re considering exclusive product drops.", 'requirement' => "Exclusive product drops"],
            ['text' => "Will there be seasonal product categories?", 'type' => "core", 'message' => "We will sell clothing and accessories with seasonal collections.", 'requirement' => "Product type (clothing, accessories, seasonal collections)"],
            ['text' => "Are you considering accessories as well?", 'type' => "irrelevant", 'message' => "We’re still considering accessories as part of our product line."],
            ['text' => "Do you have a specific brand identity in mind?", 'type' => "irrelevant", 'message' => "We haven’t fully decided on our brand identity yet."]
        ],
        2 => [
            ['text' => "Do you want social media integration?", 'type' => "core", 'message' => "We want fast-loading product pages and integrated social media sharing.", 'requirement' => "Fast load times and social media integration"],
            ['text' => "How about influencer collaborations?", 'type' => "nonEssential", 'message' => "We might collaborate with influencers.", 'requirement' => "Influencer integration"],
            ['text' => "Would you like to offer a loyalty program?", 'type' => "irrelevant", 'message' => "A loyalty program is not a priority right now."],
            ['text' => "Do you envision a lot of visual content on the site?", 'type' => "irrelevant", 'message' => "Visual content is important but not a top priority."]
        ],
        3 => [
            ['text' => "Would you like an automated inventory system?", 'type' => "core", 'message' => "An automated inventory system is essential for us.", 'requirement' => "Automated inventory management"],
            ['text' => "Is product categorization by season important?", 'type' => "core", 'message' => "Yes, categorization by season and popularity is important.", 'requirement' => "Product categorization"],
            ['text' => "Do you want users to save products in a wishlist?", 'type' => "nonEssential", 'message' => "A wishlist is nice to have but not critical.", 'requirement' => "Wishlist feature"],
            ['text' => "Will you manually track stock?", 'type' => "irrelevant", 'message' => "Automation is preferred."]
        ],
        4 => [
            ['text' => "Would you consider accepting cryptocurrency?", 'type' => "core", 'message' => "We’d like to offer multiple payment options, including cryptocurrency.", 'requirement' => "Multiple payment options"],
            ['text' => "Are you interested in subscription-based sales?", 'type' => "nonEssential", 'message' => "Subscriptions are something we might add in the future.", 'requirement' => "Subscription-based sales"],
            ['text' => "Do you need a quick checkout feature?", 'type' => "irrelevant", 'message' => "We don’t see quick checkout as a high priority for now."],
            ['text' => "Will you use a third-party payment processor?", 'type' => "irrelevant", 'message' => "We haven’t made a decision on the payment processor yet."]
        ],
        5 => [
            ['text' => "Would you prefer a mobile-friendly design?", 'type' => "core", 'message' => "A clean, mobile-friendly interface is essential for us.", 'requirement' => "Mobile-friendly interface"],
            ['text' => "Would gamification (rewards) be a priority?", 'type' => "nonEssential", 'message' => "Gamification sounds interesting, but it’s a lower priority.", 'requirement' => "Gamification features"],
            ['text' => "Is a simple checkout process critical?", 'type' => "irrelevant", 'message' => "A simple checkout is nice to have, but not essential."],
            ['text' => "Will visual appeal be central to the design?", 'type' => "irrelevant", 'message' => "We want it to look good, but functionality comes first."]
        ],
        6 => [
            ['text' => "Is GDPR compliance necessary?", 'type' => "core", 'message' => "We need GDPR compliance and secure data handling.", 'requirement' => "GDPR compliance and secure data handling"],
            ['text' => "Would you like to add 2FA?", 'type' => "nonEssential", 'message' => "Two-factor authentication is an idea we’re considering.", 'requirement' => "2FA password security"],
            ['text' => "Is user data encryption required?", 'type' => "core", 'message' => "Data encryption and secure handling are must-haves.", 'requirement' => "Secure data handling"],
            ['text' => "Do you want to restrict data access to only registered users?", 'type' => "irrelevant", 'message' => "We haven’t made a decision on access restrictions yet."]
        ]
    ];
    $scenarioText = "We’re looking to create an online store for fashion items, targeting young adults. It should be visually appealing and cater to modern user expectations.";
@endphp

@include('templates.scenario', [
    'initialQuestions' => $initialQuestions,
    'followUpQuestions' => $followUpQuestions,
    'scenarioText' => $scenarioText,
    'maxCoreReqs' => 8
])
