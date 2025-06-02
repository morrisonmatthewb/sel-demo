<?php

namespace App\Http\Controllers\Labs;

use Illuminate\Http\Request;
use App\Helpers\FormApi;
use App\Helpers\ChatHandler;

class RequirementsCaptureController extends DefaultController{
    public static $lab = "requirements-capture";
    public static $display = "Requirements Capture";
    public static $description = "This module focuses on the critical skill of gathering and refining requirements from a client. The user will understand how to do this by asking good questions and communicating consistently, over time. Change is inevitable.";
    public static $pages = [
        "index" => "",
        "pre-survey" => "Pre-Module Survey",
        "pre-activity" => "Pre-Activity",
        "introduction" => "Introduction",
        "journey-mode" => "Journey Mode Scenarios",
        "post-mortem" => "Post-Mortem Analysis",
        "conversation" => "Conversation",
        "chat" => "Chat with Your Client",
        "post-survey" => "Post-Module Survey",
        "review" => ""
    ];
    public static $objectives = [
        "Identify incomplete, ambiguous, or evolving requirements provided by clients",
        "Analyze communication gaps that could lead to misaligned expectations or missed requirements",
        "Evaluate multiple approaches for capturing requirements to determine the most effective method in each scenarios",
        "Design an adaptive approach to requirements gathering that ensures effective communication and clear requirements for the project"
    ];
    public static $willlearn = [
        "Common problems that clients deal with",
        "How to elicit requirements from clients",
        "Walk through real-world requirements capture scenarios",
        "How to avoid the most frequent mistakes"
    ];

    public static function nonPage($subPath) {
        $scenarios = [
            "ecommerce" => "E-commerce Platform Scenario",
            "healthcare" => "Healthcare Management System Scenario",
            "education" => "Educational Learning Platform Scenario"
        ];
        if(array_key_exists($subPath, $scenarios)) {
            return view("module-page", [
                'module' => static::$lab,
                'page' => $subPath,
                'moduleDisplay' => static::$display,
                'pageDisplay' => $scenarios[$subPath],
                'locked' => static::isLocked()
            ]);
        } else {
            abort(404);
        }
    }

    public static function post($subPath, Request $request) {
        $user = FormApi::current_user();
        $module = 'requirements-capture';

        FormApi::write_log($user, $module, "RCController: Post request received to $subPath");

        if ($subPath == 'message') {
            return self::message($request);
        }

        if($subPath == 'init') {
            return self::init($request);
        }
    }

    private static function message(Request $request){
        $user = FormApi::current_user();
        $module = 'requirements-capture';
        
        try {
            FormApi::write_log($user, $module, "RCController: attempting to send message to API");
            $result = ChatHandler::sendMessage($user,$module,$request->input('message'));

            if ($request->ajax()) {
                return response()->json($result);
            }

            return redirect()->route('modules.lab', ['lab' => $module, 'subroute' => 'chat']);

            return response()->json($result);
        } catch (Exception $e) {
            return response()->json(['success' => false,'error' => $e->getMessage()], 400);
        }
    }

    private static function init(Request $request){
        $user = FormApi::current_user();
        $module = 'requirements-capture';

        FormApi::write_log($user, $module, "RCController: initialize a new chat");

        $systemPrompt = "You are Sarah Chen a small business owner who runs a local bakery called Sweet Delights. You are seeking to have a software system developed to help manage your growing business. You have some ideas but arent entirely sure what you need. Act as this client with the following characteristics - You sometimes forget to mention important details unless specifically asked, You have a budget of around $10000 but are flexible if the value is justified. Your main problems are Managing inventory of ingredients and finished products, Scheduling and tracking customer orders, Managing staff schedules, Keeping track of popular items and sales trends, Youre not very technical so you prefer explanations in simple terms, You expect the software to be easy to use since your staff varies in technical ability, Engage in a natural conversation with the software engineer responding to their questions and gradually revealing your needs. Dont dump all information at once - let the engineer discover your needs through conversation. Start by briefly introducing yourself and mentioning that you need help with managing your bakery but dont list all your problems immediately.";

        ChatHandler::initializeConversation($user, $module, $systemPrompt);

        return redirect()->route('modules.lab', ['lab' => $module, 'subroute' => 'chat']);
    }
}
