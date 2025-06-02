<?php

namespace App\Http\Controllers\Labs;
use Illuminate\Http\Request;
use App\Helpers\FormApi;

class SecurityModuleController extends DefaultController
{
    public static $lab = "security";
    public static $display = "Security";
    public static $description = "This module will guide you through understanding web security principles and how to build secure applications. You'll learn about common vulnerabilities, analyze security issues, and practice implementing secure solutions.";
    public static $pages = [
        "index" => "",
        "pre-survey" => "Pre-Survey",
        "introduction" => "Introduction to Web Security",
        "activity-1" => "Activity 1: Flags Challenge",
        "tradeoffs" => "Security vs Usability",
        "activity-2" => "Activity 2: Tradeoff Exercise",
        "post-survey" => "Post-Survey",
        "review" => ""
    ];
    public static $objectives = [
        "Identify common web vulnerabilities",
        "Explain how poor coding practices contribute to vulnerabilities",
        "Analyze code for security issues",
        "Weigh security vs. usability trade-offs",
        "Propose secure coding solutions"
    ];
    public static $willlearn = [
        "Common web security threats and vulnerabilities",
        "Secure coding practices",
        "Security vs. usability trade-offs",
        "Real-world security scenarios"
    ];
    private static $securityMeasures = [
        'Basic Requirements (min 8 chars)' => ['security' => 15, 'usability' => -5],
        'Complex Requirements (16+ chars, special chars)' => ['security' => 25, 'usability' => -20],
        'Optional 2FA' => ['security' => 20, 'usability' => -5],
        'Mandatory 2FA' => ['security' => 30, 'usability' => -25],
        'Social Media Login' => ['security' => -5, 'usability' => 25],
        'Guest Checkout' => ['security' => -10, 'usability' => 30],
        'Remember Me Option' => ['security' => -5, 'usability' => 20],
        'HTTPS Encryption' => ['security' => 25, 'usability' => 0],
        'End-to-End Encryption' => ['security' => 30, 'usability' => -10],
        '24-hour Session Timeout' => ['security' => 20, 'usability' => -15],
        '7-day Session with Remember Me' => ['security' => -10, 'usability' => 25],
        'Basic Payment Gateway' => ['security' => 20, 'usability' => 10],
        'PCI Compliant Gateway' => ['security' => 30, 'usability' => -5],
        'Biometric Login Option' => ['security' => 20, 'usability' => 15],
        'Rate Limiting on Login' => ['security' => 15, 'usability' => -5],
        'Password Recovery Email' => ['security' => 10, 'usability' => 20],
        'Security Questions' => ['security' => 15, 'usability' => -10],
        'IP-based Login Alerts' => ['security' => 20, 'usability' => -5],
        'Save Card for Later' => ['security' => -10, 'usability' => 25],
        'One-Click Checkout' => ['security' => -15, 'usability' => 30],
        'Device Fingerprinting' => ['security' => 25, 'usability' => 0]
    ];
    private static $hints_data = [
        1 => [
            "Not everything visible on a webpage is shown in the browser.",
            "Web browsers have tools to inspect the page source.",
            "Look for HTML comments in the source code."
        ],
        2 => [
            "The student search feature accepts any input, including SQL commands.",
            "Try using SQL UNION to combine results from different tables.",
            "Try this search: ' UNION SELECT id, username, flag, flag FROM admin --"
        ],
        3 => [
            "The upload feature only checks file extensions.",
            "A file's extension doesn't always match its content.",
            "Try uploading a PHP file disguised as a PNG."
        ]
    ];

    public static function loadPage($page)
    {
        if ($page === 'activity-1') {
            $user = FormApi::current_user();
            $formData = json_decode(FormApi::form_get($user, self::$lab), true) ?? [];
            
            // Calculate if all flags are found
            $flags = $formData['flags'] ?? [];
            $won = count($flags) >= 3;
            
            // Find the next unsolved flag number
            $nextFlag = 1;
            for ($i = 0; $i < 3; $i++) {
                if (!isset($flags[$i])) {
                    $nextFlag = $i + 1;
                    break;
                }
            }
            
            // Pass data to the view
            view()->share([
                'flags' => $flags,
                'received_hints' => $formData['received_hints'] ?? [],
                'nextFlag' => $nextFlag,
                'won' => $won,
                'hints_data' => self::$hints_data
            ]);
        }
        else if ($page === 'activity-2') {
            $user = FormApi::current_user();
            $formData = json_decode(FormApi::form_get($user, self::$lab), true) ?? [];
            
            // Get the most recent attempt if any exists
            $lastAttempt = null;
            if (isset($formData['balance_challenge']['attempts']) && 
                count($formData['balance_challenge']['attempts']) > 0) {
                $lastAttempt = end($formData['balance_challenge']['attempts']);
            }
            
            // Pass data to the view
            view()->share([
                'lastAttempt' => $lastAttempt
            ]);
        }
        return parent::loadPage($page);
    }

    public static function nonPage($subPath)
    {
        abort(404);
    }

    public static function post($subPath, Request $request) {
        // Debug logging
        FormApi::write_log(FormApi::current_user(), self::$lab, "Post request received: $subPath");
        FormApi::write_log(FormApi::current_user(), self::$lab, "Request data: " . json_encode($request->all()));
        
        switch ($subPath) {
            case 'submit-flag':
                FormApi::write_log(FormApi::current_user(), self::$lab, "Handling submit-flag");
                return self::handleFlagSubmission($request);
            case 'hint':
                return self::handleHintRequest();
            case 'search':
                return self::handleStudentSearch($request);
            case 'upload':
                return self::handleImageUpload($request);
            case 'balance-challenge-handler':
                return self::handleBalanceChallenge($request);
            case 'tradeoffs':
                return self::handleTradeoffsUpdate($request);
            default:
                abort(404);
        }
    }

    private static function handleFlagSubmission(Request $request) {
        $user = FormApi::current_user();
        $flagNumber = $request->input('flag_number');
        $flagValue = $request->input('flag');
        
        // Log the attempt
        FormApi::write_log($user, self::$lab, "Flag submission attempt - Number: $flagNumber, Value: $flagValue");

        // Validate input
        if (!$flagNumber || !$flagValue || $flagNumber > 3) {
            return response()->json(['success' => false, 'message' => 'Missing flag data']);
        }

        // Get user's form data
        $formData = json_decode(FormApi::form_get($user, self::$lab), true) ?? [];
        
        // Define correct flags
        $correctFlags = [
            1 => 'CMSC435{hidden_admin_panel_found}',
            2 => 'CMSC435{sql_injection_master}',
            3 => 'CMSC435{upload_bypass_success}'
        ];

        // Check if flag is correct
        if (isset($correctFlags[$flagNumber]) && $flagValue === $correctFlags[$flagNumber]) {
            $flags = $formData['flags'] ?? [];
            $flags[$flagNumber - 1] = $flagValue;
            FormApi::form_update($user, self::$lab, json_encode(['flags' => $flags]));
            
            FormApi::write_log($user, self::$lab, "Flag $flagNumber submitted successfully");
            return response()->json(['success' => true]);
        }

        FormApi::write_log($user, self::$lab, "Invalid flag submission");
        return response()->json(['success' => false, 'message' => 'Invalid flag']);
    }

    private static function handleHintRequest() {
        $user = FormApi::current_user();
        $formData = json_decode(FormApi::form_get($user, self::$lab), true) ?? [];
        
        try {
            // Get current flag number from request instead of calculating
            $currentFlag = request('flagNumber', 1);
            
            // Only provide hints for flags 1-3
            if ($currentFlag > 3) {
                return response()->json([
                    'success' => false, 
                    'message' => 'All flags have been found!'
                ]);
            }

            // Get the current hint index from the request
            $hintIndex = request('hintIndex', 0);
            
            // Check if we have more hints available for this flag
            if (!isset(self::$hints_data[$currentFlag][$hintIndex])) {
                return response()->json([
                    'success' => false,
                    'message' => 'No more hints available for this flag'
                ]);
            }

            // Store received hints in form data
            $formData['received_hints'] = $formData['received_hints'] ?? [];
            if (!isset($formData['received_hints'][$currentFlag])) {
                $formData['received_hints'][$currentFlag] = [];
            }
            if (!in_array($hintIndex, $formData['received_hints'][$currentFlag])) {
                $formData['received_hints'][$currentFlag][] = $hintIndex;
            }
            
            // Update total hints used count
            $formData['hints_used'] = ($formData['hints_used'] ?? 0) + 1;
            FormApi::form_update($user, self::$lab, json_encode($formData));

            return response()->json([
                'success' => true,
                'hint' => self::$hints_data[$currentFlag][$hintIndex],
                'hasMore' => isset(self::$hints_data[$currentFlag][$hintIndex + 1]),
                'currentFlag' => $currentFlag
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Error retrieving hint'
            ]);
        }
    }

    private static function handleStudentSearch(Request $request) {
        $user = FormApi::current_user();
        $search = $request->input('name');
        
        FormApi::write_log($user, self::$lab, "Search request received with term: " . $search);
        
        if (empty($search)) {
            FormApi::write_log($user, self::$lab, "Empty search term rejected");
            return response()->json(['error' => 'Search term required']);
        }

        // Get the user's database file path
        $dbPath = storage_path("labs/security/{$user}/fromDefaults/flags_db.sqlite");
        
        // Log database path
        FormApi::write_log($user, self::$lab, "Attempting to access database at: " . $dbPath);
        
        // Check if database file exists
        if (!file_exists($dbPath)) {
            FormApi::write_log($user, self::$lab, "ERROR: Database file not found at: " . $dbPath);
            return response()->json([
                'success' => false,
                'error' => 'Database not found'
            ]);
        }
        
        try {
            // Connect to SQLite database
            $pdo = new \PDO("sqlite:{$dbPath}");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            FormApi::write_log($user, self::$lab, "Database connection established");
            
            // Intentionally vulnerable SQL query
            $query = "SELECT * FROM students WHERE name LIKE '%{$search}%' OR class LIKE '%{$search}%' OR major LIKE '%{$search}%'";
            FormApi::write_log($user, self::$lab, "Executing query: " . $query);
            
            // Execute query
            $stmt = $pdo->query($query);
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            // Log results
            $resultCount = count($results);
            FormApi::write_log($user, self::$lab, "Query successful. Found {$resultCount} results");
            
            return response()->json([
                'success' => true,
                'results' => $results
            ]);
            
        } catch (\PDOException $e) {
            FormApi::write_log($user, self::$lab, "PDO ERROR: " . $e->getMessage());
            FormApi::write_log($user, self::$lab, "Error Code: " . $e->getCode());
            FormApi::write_log($user, self::$lab, "Error Trace: " . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while searching'
            ]);
        }
    }

    private static function handleImageUpload(Request $request) {
        $user = FormApi::current_user();
        if (!$request->hasFile('image')) {
            return redirect()->back()->with('error', 'No image uploaded');
        }
        
        $file = $request->file('image');
        
        // Vulnerable file type validation - only checks extension
        $extension = strtolower($file->getClientOriginalExtension());
        if ($extension !== 'png') {
            return redirect()->back()->with('error', 'Only PNG files are allowed');
        }
        
        // Create new file using FormApi
        $fileId = FormApi::file_create($user, self::$lab);
        $filePath = FormApi::get_file_path($fileId);
        
        // Save the uploaded file
        $file->move(dirname($filePath), basename($filePath));
        
        // If PHP file is uploaded successfully, reveal flag
        if (self::is_php_file($filePath)) {
            $formData = json_decode(FormApi::form_get($user, self::$lab), true) ?? [];
            $flags = $formData['flags'] ?? [];
            $flags[2] = 'CMSC435{upload_bypass_success}';
            FormApi::form_update($user, self::$lab, json_encode(['flags' => $flags]));
        }
        
        // Delete the uploaded file
        unlink($filePath);
        
        return redirect()->back()->with('success', 'Image uploaded successfully');
    }

    private static function is_php_file($filepath) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $filepath);
        finfo_close($finfo);
        
        // Check if file contains PHP code
        $content = file_get_contents($filepath);
        return strpos($content, '<?php') !== false || $mime_type === 'application/x-httpd-php';
    }

    private static function handleBalanceChallenge(Request $request) {
        $user = FormApi::current_user();
        
        // Get the submitted options
        $selectedOptions = $request->input('selected_options', []);
        
        // Calculate scores
        $securityScore = 0;
        $usabilityScore = 0;
        
        foreach ($selectedOptions as $option => $selected) {
            if ($selected && isset(self::$securityMeasures[$option])) {
                $securityScore += self::$securityMeasures[$option]['security'];
                $usabilityScore += self::$securityMeasures[$option]['usability'];
            }
        }
        
        // Ensure scores are within valid range
        $securityScore = max(0, min(100, $securityScore));
        $usabilityScore = max(0, min(100, $usabilityScore));
        
        // Get existing form data
        $formData = json_decode(FormApi::form_get($user, self::$lab), true) ?? [];
        
        // Initialize balance_challenge if not exists
        if (!isset($formData['balance_challenge'])) {
            $formData['balance_challenge'] = [
                'attempts' => [],
                'completed' => false,
                'completion_time' => null
            ];
        }
        
        // Add this attempt to the attempts array
        $formData['balance_challenge']['attempts'][] = [
            'timestamp' => now()->toDateTimeString(),
            'selected_options' => $selectedOptions,
            'security_score' => $securityScore,
            'usability_score' => $usabilityScore
        ];
        
        // Update completion status if challenge is solved
        $challengeCompleted = ($securityScore >= 70 && $usabilityScore >= 70);
        if ($challengeCompleted && !$formData['balance_challenge']['completed']) {
            $formData['balance_challenge']['completed'] = true;
            $formData['balance_challenge']['completion_time'] = now()->toDateTimeString();
        }
        
        // Log the attempt
        FormApi::write_log($user, self::$lab, "Balance challenge attempt - Security: $securityScore, Usability: $usabilityScore, Completed: " . ($challengeCompleted ? 'Yes' : 'No'));
        
        // Save updated form data
        FormApi::form_update($user, self::$lab, json_encode($formData));

        return response()->json([
            'success' => true,
            'security_score' => $securityScore,
            'usability_score' => $usabilityScore,
            'challenge_completed' => $challengeCompleted
        ]);
    }

    private static function handleTradeoffsUpdate(Request $request) {
        $user = FormApi::current_user();
        $formData = json_decode(FormApi::form_get($user, self::$lab), true) ?? [];
        
        // Update learn_more_clicked data
        if ($request->has('learn_more_clicked')) {
            $formData['learn_more_clicked'] = json_decode($request->input('learn_more_clicked'), true);
            
            // Log which approach was clicked
            $clickedApproach = array_key_last($formData['learn_more_clicked']);
            FormApi::write_log($user, self::$lab, "User clicked 'Learn More' for: $clickedApproach approach");
        }
        
        // Save all updates
        FormApi::form_update($user, self::$lab, json_encode($formData));
        
        return response()->json(['success' => true]);
    }
}
