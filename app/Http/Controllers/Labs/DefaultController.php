<?php

namespace App\Http\Controllers\Labs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Module;
use Illuminate\Support\Carbon;
use App\Helpers\FormApi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\FormController;

class DefaultController extends Controller
{
    public static $lab = "default";
    public static $display = "Default";
    public static $description = "";
    public static $pages = ["index"=>"Index", "review"=>"Review"];
    public static $objectives;
    public static $willlearn;

    private static function updateLastPage($page){
        FormApi::form_update(FormApi::current_user(), static::$lab, "{'currentPage': '$page'}");
    }

    public static function getLastPage(){
        $form = json_decode(FormApi::form_get(FormApi::current_user(), static::$lab), true);
        return $form["currentPage"] ?? "index";
    }

    public static function pageNumber($page){
        return array_search($page,array_keys(static::$pages));
    }

    public static function pageFromNumber($pageNumber){
        return array_keys(static::$pages)[$pageNumber];
    }

    public static function totalPages() {
        return count(static::$pages) - 1;
    }

    public static function isLocked() {
        return FormApi::module_locked(FormApi::current_user(), static::$lab);
    }

    public static function isSubmitted($user, $module) {
        return FormApi::is_completed($user, $module);
    }
    

    public static function nonPage($subPath){
        abort(404);
    }

    public static function loadPage($page){
        if($page == null){
            return redirect()->route('modules.lab', ['lab' => static::$lab, 'subroute' => 'index']);
        }

        if(!isset(static::$pages[$page])){
            return static::nonPage($page);
        }
        $user = FormApi::current_user(); 
        FormController::viewPage($user, static::$lab, $page);

        // TODO: check if page is reached and 403 otherwise
        if($page == "index"){
            $lastPage = static::getLastPage();
            return view("index-page", [
                "last_page" => $lastPage == "index" ? null : static::$pages[$lastPage],
                "lab" => static::$lab,
                "link_to" => route("modules.lab", ["lab" => static::$lab, "subroute" => $lastPage == "index" ? static::pageFromNumber(1) : $lastPage]),
                "display" => static::$display,
                "objectives" => static::$objectives,
                "description" => static::$description,
                "willlearn" => static::$willlearn
            ]);
        }

        // We don't want to update the last page when it's index because then it wouldn't help us get back
        static::updateLastPage($page);
        $currentPageNumber = static::pageNumber($page);
        $totalPageNumber = static::totalPages();

        if ($page == "review") {
            $isSubmitted = FormApi::is_completed($user, static::$lab);
            $cannotSubmit = FormApi::is_force_lock($user, static::$lab) || FormApi::is_late($user, static::$lab);
            $formData = json_decode(FormApi::form_get($user, static::$lab), true) ?? [];
            $unanswered = [];

            foreach ($formData as $page => $pageData) {
                // Find pages with questions on them
                if (isset($pageData['questions']) && is_array($pageData['questions'])) {
                    foreach ($pageData['questions'] as $id => $questionData) {
                        // Find unanswered questions
                        if (!isset($questionData['answer']) || $questionData['answer'] === '') {
                            // Add to $unanswered nested under the page key
                            $unanswered[$page][$id] = $questionData;
                        }
                    }
                }
            }

            $viewedPages = $formData['viewedPages'] ?? [];
            $unviewed = [];
            foreach(static::$pages as $page => $display) {
                if(!in_array($page, $viewedPages) && $page !== "review" && $page !== "index") {
                    $unviewed[$page] = $display;
                }
            }
            
            return view("review-page", [
                    'display' => static::$display,
                    'pages' => static::$pages,
                    'module' => static::$lab,
                    'currentPageNumber' => $currentPageNumber,  // Pass current page number
                    'totalPageNumber' => $totalPageNumber,       // Pass total page number
                    'prevPage' => static::pageFromNumber($currentPageNumber-1),
                    'isSubmitted' => $isSubmitted,
                    'cannotSubmit' => $cannotSubmit,
                    'unanswered' => $unanswered,
                    'unviewed' => $unviewed
                ]);
        }

        return view("module-page", [
            'module' => static::$lab,
            'page' => $page,
            'moduleDisplay' => static::$display,
            'pageDisplay' => static::$pages[$page],
            'currentPageNumber' => $currentPageNumber,
            'totalPageNumber' => $totalPageNumber, 
            'nextPage' => static::pageFromNumber($currentPageNumber+1),
            'prevPage' => static::pageFromNumber($currentPageNumber-1),
            'locked' => static::isLocked()
        ]);
    }

    public static function post($subPath, Request $request){
        abort(404);
    }

}

