<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use App\Helpers\FormApi;
use Illuminate\Http\Request;
use Exception;
use OpenAI;
use App\Http\Controllers\FormController;

class ChatHandler
{
    private const MAX_CONVERSATION_LENGTH = 20; // Prevent conversations from growing too large
    private const DEFAULT_MODEL = 'gpt-4o-mini';
    private const INITIAL_PROMPT = "You are Sarah Chen a small business owner who runs a local bakery called Sweet Delights. You are seeking to have a software system developed to help manage your growing business. You have some ideas but arent entirely sure what you need. Act as this client with the following characteristics You sometimes forget to mention important details unless specifically asked, You have a budget of around $10000 but are flexible if the value is justified. Your main problems are Managing inventory of ingredients and finished products, Scheduling and tracking customer orders, Managing staff schedules, Keeping track of popular items and sales trends, Youre not very technical so you prefer explanations in simple terms, You expect the software to be easy to use since your staff varies in technical ability, Engage in a natural conversation with the software engineer responding to their questions and gradually revealing your needs. Dont dump all information at once - let the engineer discover your needs through conversation. Start by briefly introducing yourself and mentioning that you need help with managing your bakery but dont list all your problems immediately.";

    private static function validateApiConfig() {
        if (!getenv('OPENAI_API_KEY')) {
            throw new Exception('OpenAI API key not configured');
        }
    }
    
    public static function sendMessage($user, $module, $userInput)
    {
        self::validateApiConfig();

        try {
            FormApi::write_log($user, $module, "Chat Handler: Input received");
            
            $formData = json_decode(FormApi::form_get($user, $module), true);
            
            // Initialize chat structure if not exists
            if (!isset($formData['chat']) || !is_array($formData['chat'])) {
                $formData['chat'] = [];
            }
            
            // Initialize conversation with prompt if not exists
            if (!isset($formData['chat']['conversation']) || !is_array($formData['chat']['conversation'])) {
                $formData['chat']['conversation'] = [
                    [
                        "role" => "system",
                        "content" => self::sanitizeForJson(self::INITIAL_PROMPT)
                    ]
                ];
            }
            
            // Validate user input
            if (!is_string($userInput)) {
                throw new Exception('User input must be a string, received: ' . gettype($userInput));
            }
            if (empty(trim($userInput))) {
                throw new Exception('User input cannot be empty');
            }
            
            // Add user message
            $formData['chat']['conversation'][] = [
                "role" => "user",
                "content" => self::sanitizeForJson($userInput)
            ];
            
            // Get response from API
            $response = self::getResponse($formData['chat']['conversation']);
            
            // Add assistant response
            $formData['chat']['conversation'][] = [
                "role" => "assistant",
                "content" => self::sanitizeForJson($response)
            ];
            
            // Save updated conversation
            FormApi::form_update($user, $module, json_encode($formData));
            
            return [
                'success' => true,
                'last_message' => $response
            ];
            
        } catch (Exception $e) {
            FormApi::write_log($user, $module, "Chat Handler: Error details: " . $e->getMessage() . "\nTrace: " . $e->getTraceAsString());
            
            return [
                'success' => false,
                'error' => 'An error occurred while processing your message.',
                'debug_message' => $e->getMessage()
            ];
        }
    }

    private static function getResponse(array $conversation)
    {
        $lastError = null;

        try {
            return self::getResponseFromModel($conversation);
        } catch (Exception $e) {
            $lastError = $e;
            Log::warning("API call attempt failed: " . $e->getMessage());
        }

        throw new Exception("Failed to get response. Last error: " . $lastError->getMessage());
    }

    private static function getResponseFromModel(array $conversation)
    {
        $client = OpenAI::client(getenv('OPENAI_API_KEY'));

        $response = $client->chat()->create([
            'model' => self::DEFAULT_MODEL,
            'messages' => $conversation,
            'temperature' => 0.7,
            'max_tokens' => 1000,
            'presence_penalty' => 0.6,
            'frequency_penalty' => 0.6,
        ]);

        return $response['choices'][0]['message']['content'];
    }

    public static function initializeConversation($user, $module, $systemPrompt = INITIAL_PROMPT)
    {
        FormApi::write_log(FormApi::current_user(), $module, "Chat Handler: initialize a new conversation, prompt: " . $systemPrompt);

        $conversation = [[
            'role' => 'system',
            'content' => self::sanitizeForJson($systemPrompt)
        ]];
        
        $formData = json_decode(FormApi::form_get($user, $module), true);
        $formData['chat']['conversation'] = $conversation;

        FormApi::form_set($user, $module, json_encode($formData));
        return $formData;
    }

    public static function clearConversation($user, $module)
    {
        // form
        return self::initializeConversation($user, $module);
    }

    // to implement...
    public static function sanitizeForJson($string) {
        $string = str_replace("'", "", $string);
        return trim($string);
    }
}