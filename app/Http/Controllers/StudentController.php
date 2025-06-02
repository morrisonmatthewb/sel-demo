<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Module;
use Illuminate\Support\Carbon;
use App\Helpers\FormApi;
use App\Http\Controllers\Labs as LabsController;

class StudentController extends Controller
{
    public static $labControllers = [
        'module-making' => LabsController\ModuleCreationController::class,
        'cicd-config-management' => LabsController\CICDModuleController::class,
        'security' => LabsController\SecurityModuleController::class,
        'cost-estimation' => LabsController\CostEstimationModuleController::class,
        'validation-testing' => LabsController\ValidationTestingController::class,
        'installers-self-deployment' => LabsController\InstallersSelfDeploymentModuleController::class,
        'requirements-capture' => LabsController\RequirementsCaptureController::class
    ];

    public function index()
    {
        return view('main');
    }

    public function loadLab($lab, $subroute = null)
    {
        if (!isset(self::$labControllers[$lab])) {
            abort(404); // Return a 404 error if the lab does not exist
        }

        if($subroute == "teacher-view"){
            abort(404); // don't load the teacher-view view, it's for /teacher-view/$lab/$student
        }

        if(!$this->isAssigned($lab)){
            abort(403);
        }

        return self::$labControllers[$lab]::loadPage($subroute);
    }

    public function postLab(Request $request, $lab, $subroute = null){
        if (!isset(self::$labControllers[$lab])) {
            abort(404); // Return a 404 error if the lab does not exist
        }

        if(!$this->isAssigned($lab)){
            abort(403);
        }

        return self::$labControllers[$lab]::post($subroute, $request);
    }

    private function isAssigned($module){
        return Module::where('module', $module)->where('user', FormApi::current_user())->exists() or Module::where('module', $module)->whereNull('user')->exists();
    }

    private static function rankScore($listitem){
        if($listitem->status == 1) return 1;
        if(!$listitem->assigned) return 2;
        return 0;
    }

    public static function getLabList(){
        $list_items = [];
        foreach(array_keys(self::$labControllers) as $lab){
            $matching_user = Module::where('module', $lab)->where('user', FormApi::current_user())->first();
            $matching_nulluser = Module::where('module', $lab)->whereNull('user')->first();
            if($matching_user){
                $list_items[] = new moduleListItem($lab, $matching_user->due ? Carbon::parse($matching_user->due) : null, $matching_user->submitted, true);
            }elseif($matching_nulluser){
                $list_items[] = new moduleListItem($lab, $matching_nulluser->due ? Carbon::parse($matching_nulluser->due) : null, false, true);
            }else{
                $list_items[] = new moduleListItem($lab, "Unassigned", false, false);
            }
        }
        usort($list_items, function($a, $b) {
            $ar = self::rankScore($a);
            $br = self::rankScore($b);
            $cmp = $ar - $br;
            if($cmp == 0){
                if(is_null($a->dueTime)){
                    if(!is_null($b->dueTime)){
                        $cmp = 1;
                    }
                }elseif(is_null($b->dueTime)){
                    $cmp = -1;
                }else{
                    $cmp = $a->dueTime <=> $b->dueTime;
                }
            }
            if($cmp == 0){
                $cmp = $a->name <=> $b->name;
            }
            return $cmp;
        });
        return $list_items;
    }

    public function loadLabList()
    {
        $list_items = self::getLabList();
        return view('lab-list', ['module_items' => $list_items]);
    }
}

class moduleListItem {
    public $name;
    public $due;
    public $dueTime;
    public $status;
    public $assigned;

    public function __construct($name, $due, $status, $assigned) {
        $this->name = $name;
        if($due instanceof \DateTime){
            $this->dueTime = $due;
            $this->due = $due->format("D M d, Y h:ia");
        }else{
            $this->due = !empty($due) ? $due : "No Due Date";;
        }
        $this->status = $status;
        $this->assigned = $assigned;
    }

    public function displayName(){
        return StudentController::$labControllers[$this->name]::$display;
    }

    public function description(){
        return StudentController::$labControllers[$this->name]::$description;
    }
}

