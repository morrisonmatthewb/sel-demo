<?php

namespace App\Http\Controllers\Labs;

class ValidationTestingController extends DefaultController{
    public static $lab = "validation-testing";
    public static $display = "Validation Testing";
    public static $description = "This module will guide you through validation testing, from its importance to examples of application in the real world.";
    public static $pages = [
        "index" => "",
        "pre-survey" => "Pre-Module Survey",
        "topics" => "Types of Tests",
        "pre-activity" => "Budget Tracker Activity Instructions",
        "v1" => "Budget Tracker Version 1 Activity",
        "v1-reflect" => "Budget Tracker Version 1 Reflection",
        "v2" => "Budget Tracker Version 2 Activity",
        "v2-reflect" => "Budget Tracker Version 2 Reflection",
        "post-survey" => "Post-Module Survey",
        "review" => "Complete Page",
    ];
    public static $objectives = [
        "Understand the difference between functional testing and user testing.",
        "Apply user testing principles on existing products to identify user experience flaws.",
        "Evaluate identified user experience flaws and determine their impact on usability, satisfaction, and overall project success.",
        "Design comprehensive validation tests for usability and functionality from a user’s perspective",
    ];
    public static $willlearn = [
        "Different types of Tests",
        "Format of a Test Plan Document",
    ];
}