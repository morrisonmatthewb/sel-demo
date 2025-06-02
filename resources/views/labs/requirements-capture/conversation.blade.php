@php
use App\Helpers\FormApi;

$user = FormApi::current_user();
$module = 'requirements-capture';

$formDataJson = FormApi::form_get($user, $module);
$formData = json_decode($formDataJson, true);

$conversation = [
    [
        "role" => "user",
        "content" => "Hi, thanks for meeting with me. My company needs a software solution for a problem we're having, and I’m hoping you can help."
    ],
    [
        "role" => "Consultant",
        "content" => "Of course! I’m happy to help. Let’s start by understanding the problem you’re facing. Could you walk me through what’s happening?"
    ],
    [
        "role" => "user",
        "content" => "Sure. So, we run an e-commerce platform, and we’re having trouble managing customer orders efficiently..."
    ],
    [
        "role" => "Consultant",
        "content" => "Okay, can you describe what you mean by \"not working well\"? Are there specific issues like slow processing, errors, or missing data?"
    ],
    [
        "role" => "user",
        "content" => "Well, it’s just really inefficient. Orders get delayed, and sometimes our team struggles to track them properly. Customers also complain about not receiving updates."
    ],
    [
        "role" => "Consultant",
        "content" => "I see. It sounds like there are multiple pain points—order delays, tracking issues, and customer communication. Let’s break that down a bit. Are the delays due to slow order processing in your current system, or is it more related to the way orders are fulfilled?"
    ],
    [
        "role" => "user",
        "content" => "Hmm, maybe both? I think our system isn’t fast enough, but we also have trouble coordinating with the warehouse team. So… both, I guess."
    ],
    [
        "role" => "Consultant",
        "content" => "Got it. It sounds like there might be both software and operational challenges. How do you currently track the status of an order? Is it through your system or something else?"
    ],
    [
        "role" => "user",
        "content" => "We use our system for that, but honestly, it’s kind of a mix. Sometimes the team uses spreadsheets when the system doesn’t update correctly, and there’s also a lot of manual tracking."
    ],
    [
        "role" => "Consultant",
        "content" => "Manual tracking on top of the system? That can definitely add complexity. What kind of information do you expect the system to provide at each stage of the order process? For example, do you need to know when the order is being prepared, shipped, or delivered?"
    ],
    [
        "role" => "user",
        "content" => "Exactly. We need more visibility. Right now, customers don’t know where their order is until it arrives, and sometimes we don’t even know the status ourselves."
    ],
    [
        "role" => "Consultant",
        "content" => "Understood. So better tracking and transparency for both your team and customers is a priority. Now, how does customer communication happen? Do you send them updates through the system, or is that also manual?"
    ],
    [
        "role" => "user",
        "content" => "It’s mostly manual. Our customer service team emails or calls them. It’s a lot of work, and it takes time away from other tasks."
    ],
    [
        "role" => "Consultant",
        "content" => "So automating customer notifications would help reduce workload and improve response times. Are you looking for real-time updates to be sent, or would something like daily summaries work?"
    ],
    [
        "role" => "user",
        "content" => "Real-time would be ideal. If we could automatically notify customers at each stage, that would save us a lot of time."
    ],
    [
        "role" => "Consultant",
        "content" => "That makes sense. Just to confirm, we’re aiming to improve order tracking, provide real-time updates to customers, and reduce the need for manual intervention. Is there anything else you think the system should address?"
    ],
    [
        "role" => "user",
        "content" => "I think those are the main things, but there’s probably more. Oh, and it needs to be fast. Like, we can’t afford downtime."
    ],
    [
        "role" => "Consultant",
        "content" => "Speed and reliability are crucial—no downtime, fast response times. One last question for now: Do you envision integrating this system with your current platform, or are you open to a complete overhaul?"
    ],
    [
        "role" => "user",
        "content" => "Hmm, I think we want to integrate it with what we have, but I’m not sure. I’ll need to talk to my team about that."
    ],
    [
        "role" => "Consultant",
        "content" => "That’s completely fine. We can explore both options once you have more clarity on what works best for your operations. I’ll also need more details on your current system’s architecture later to see how integration would work."
    ],
    [
        "role" => "user",
        "content" => "Okay, I’ll get that info for you."
    ],
    [
        "role" => "Consultant",
        "content" => "Great! I’ll summarize what we’ve discussed and draft a high-level solution. After that, we can review it together and dive deeper into the technical aspects. Sound good?"
    ],
    [
        "role" => "user",
        "content" => "Sounds good! Thanks, looking forward to it."
    ]
];

@endphp

@include('components.conversation-display', ["conversation" => $conversation])
