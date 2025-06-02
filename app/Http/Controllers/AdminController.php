<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Module;
use Illuminate\Support\Carbon;
use App\Helpers\FormApi;
use App\Http\Controllers\StudentController;

class AdminController extends Controller
{
    public function loadConsole(){
        return view("admin.console");
    }

    public function loadSummary($lab, $student){
        return view("admin.summary", [
            "lab" => $lab,
            "display" => StudentController::$labControllers[$lab]::$display,
            "student" => $student,
            "formData" => json_decode(FormApi::form_get($student, $lab), true),
            "submitted" => FormApi::is_completed($student, $lab)
        ]);
    }


    public function loadLabOverview($lab){
        return view("admin.overview", ["lab" => $lab]);
    }

    public function postUpdate(Request $request){
        // Decode JSON input
        $data = $request->input('data');

        // Extract "where" conditions and new values
        $whereConditions = $data['where'] ?? [];
        $newValues = $data['values'] ?? [];

        $query = Module::query();
        // Add each "where" condition to the query
        foreach ($whereConditions as $column => $condition) {
            if (is_array($condition)) {
                // When an operation is specified, e.g., "column": ["<operation>", "<value>"]
                [$operator, $value] = $condition;
                $query->where($column, $operator, $value);
            } else {
                // Default to "=" if only a value is provided, e.g., "column": "<value>"
                $query->where($column, '=', $condition);
            }
        }
        $query->update($newValues);

        // Return a response
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function postAssign(Request $request){
        // Decode the incoming JSON
        $data = $request->input('data');

        // Ensure that the required fields are present
        if (empty($data['module'])) {
            return response()->json(['error' => 'Module is required'], 400);
        }

        // Check for existing entry
        $existingEntry = Module::where('module', $data['module'])
                                    ->whereNull('user')
                                    ->first();
        if ($existingEntry) {
            return response()->json(['error' => 'Entry for this module and user already exists'], 409);
        }

        // Create a new entry using the provided data
        $newEntry = Module::create([
            'module' => $data['module'],
            'user' => null,
            'form_path' => null,
            'log_path' => null,
            'locked' => $data['locked'] ?? 0,
            'submitted' => 0,
            'open' => now(),
            'due' => $data['due'] ?? null,
        ]);

        // Return a success response with the newly created entry
        return response()->json([
            'status' => 'success',
            'entry' => $newEntry
        ], 201);
    }
}
