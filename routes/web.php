<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Middleware\CheckAdmin;
// Acceptance testing
use App\Models\Linkuser;
use Illuminate\Http\Request;

// Teacher Routes
Route::prefix('labs/teacher-view')->middleware(CheckAdmin::class)->group(function() {
    Route::get('/', [AdminController::class, 'loadConsole'])->name('admin.console');
    Route::get('/{lab}', [AdminController::class, 'loadLabOverview'])->name('admin.laboverview');
    Route::get('/{lab}/{student}', [AdminController::class, 'loadSummary'])->name('admin.summary');
    Route::post('/update', [AdminController::class, 'postUpdate'])->name("admin.update");
    Route::post('/assign', [AdminController::class, 'postAssign'])->name("admin.assign");

    // Acceptance testing stuff
    Route::post('/invite', function(Request $request){
        //print_r($request->all());
        Linkuser::create($request->all());
    });
});

// Lab Routes
Route::prefix('labs')->group(function () {

    // Submit Route
    Route::post('/submit', [FormController::class, 'submitModule'])->name('modules.submit');

    // Form Routes
    Route::prefix('form')->group(function () {
        Route::post('/write-log', [FormController::class, 'writeLog'])->name('form.log');
        Route::post('/form-update', [FormController::class, 'formUpdate'])->name('form.update');
    });

    Route::get('/', [StudentController::class, 'loadLabList'])->name('modules');
    Route::get('/{lab}/{subroute?}', [StudentController::class, 'loadLab'])->name('modules.lab');
    Route::post('/{lab}/{subroute?}', [StudentController::class, 'postLab'])->name('modules.labpost');
});

// Public routes
Route::get('/', function () {
    return redirect()->route('modules');
});

// Begin Acceptance testing login system
Route::any('/invite/{code}', function($code){
    $entry = Linkuser::where('code', $code)->first();
    if(!is_null($entry)){
        session(['userid' => $entry->userid]);
    }
    return redirect()->route('modules');
});

Route::any('/logout', function(){
    session()->forget('userid');
    return redirect()->route('modules');
});
