<?php

namespace App\Http\Controllers\Labs;

class ModuleCreationController extends DefaultController{
    public static $lab = "module-making";
    public static $display = "Making a Module";
    public static $description = "This is a module that shows you how to add a module";
    public static $pages = [
        "index" => "",
        "create-controller" => "Create a Controller",
        "routing" => "Routing and Assigning",
        "pages" => "Adding Pages",
        "custom-endpoints" => "Custom Backend Endpoints",
        "review" => "Complete Page"
    ];
    public static $objectives = [
        "Learn how to make a module"
    ];
    public static $willlearn = [
        "How to make a module"
    ];
}
