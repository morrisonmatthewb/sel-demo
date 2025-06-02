<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FormApi;

class FormController extends Controller
{
    // Handle form updates.
    public function formUpdate(Request $request)
    {
        $validated = $request->validate([
            'module' => 'required|string',
            'page' => 'required|string',
            'field' => 'required|string',
            'value' => 'nullable',
            'logMsg' => 'nullable|string',
        ]);

        $user = FormApi::current_user();

        if ($this->isModuleLocked($user, $validated['module'])) {
            return response()->json(['success' => false, 'message' => 'Module is locked']);
        }
        $validated['value'] = isset($validated['value']) ? $validated['value'] : null;
        $formData = isset($validated['value']) ? [$validated['page'] => [$validated['field'] => $validated['value']]] : [$validated['page'] => $validated['field']];
        FormApi::form_update($user, $validated['module'], json_encode($formData));

        return response()->json(['success' => true]);
    }

    // Handle writing logs
    public function writeLog(Request $request) {
        $validated = $request->validate([
            'module' => 'required|string',
            'logMsg' => 'required|string',
        ]);
        $user = FormApi::current_user();
        $this->storeLog($user, $validated['module'], $validated['logMsg']);
        return response()->json(['success' => true]);
    }

     public function submitModule(Request $request) {
        $user = FormApi::current_user();
        
        $validated = $request->validate([
            'module' => 'required|string',
            'done'  =>  'required|boolean',
        ]);    
        // Update the module submission status
        FormApi::mark_completed($user, $validated['module'], $validated['done']);

        $submitStatus = FormApi::is_completed($user, $validated['module']);  

        $log = $submitStatus ? "submitted" : "unsubmitted";
        $this->storeLog($user, $validated['module'], "User has $log module");
        
        // Redirect with success message
        return response()->json(['success' => true]);
    }

    // Add page to viewed page
    public static function viewPage($user, $module, $page) {
        $formData = json_decode($formDataJson = FormApi::form_get($user, $module), true);
        $viewedPages = $formData['viewedPages'] ?? [];
        if(!in_array($page, $viewedPages)) {
            $viewedPages[] = $page;
            FormApi::form_update($user, $module, json_encode(['viewedPages' => $viewedPages]));
            FormApi::write_log($user, $module, "Viewed $page");
        }
    }

    // Check if a module is locked
    private function isModuleLocked($user, $module)
    {
        return FormApi::module_locked($user, $module);
    }

    // Make a log entry for form updates
    private function logUpdate($user, $module, $field, $value, $page = null, $logMsg = null)
    {
        $valueString = is_array($value) ? json_encode($value) : $value;
        $log = $logMsg ?? ($value ? "$page: Updated \"$field\" to $valueString" : "Set $page page to $field");
        $this->storeLog($user, $module, $log);
    }

    // Write a log entry
    private function storeLog($user, $module, $log)
    {
        FormApi::write_log($user, $module, $log);
    }

    // Get the current form data
    private function getForm($user, $module)
    {
        $formDataJson = FormApi::form_get($user, $module);
        return json_decode($formDataJson, true);
    }
}
