<?php

namespace App\Http\Controllers\Labs;

class CostEstimationModuleController extends DefaultController{
    public static $lab = "cost-estimation";
    public static $display = "Cost Estimation";
    public static $description = "This module will guide you through understanding the importance of cost estimation in software projects. You'll learn how to perform Function Point Analysis (FPA) to estimate project effort and resources.";
    public static $pages = [
        "index" => "",
        "pre-survey" => "Pre-Survey",
        "topics" => "Function Point Analysis",
        "exercise" => "Function Point Analysis Demo",
        "live-demo" => "Cost Estimation Live Demo Before Coding",
        "live-demo-2" => "Cost Estimation Live Demo After Coding",
        "review" => ""
    ];
    public static $objectives = [
        "Recognize why cost estimation is important for software engineering.",
        "Examine the concept of function point analysis, why it is important, and how it is used.",
        "Perform cost estimation for software they build.",
        "Interpret and employ function point analysis by analyzing a given software engineering problem."
    ];
    public static $willlearn = [
        "Importance of cost estimation in software project.",
        "Function Point Analysis (FPA) and its application.",
        "Estimating project effort, time, and resources.",
        "Analyzing software components to determine complexity."
    ];
}