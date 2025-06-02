<?php

namespace App\Http\Controllers\Labs;

class InstallersSelfDeploymentModuleController extends DefaultController{
    public static $lab = "installers-self-deployment";
    public static $display = "Installers & Self-Deployment";
    public static $description = "This module will guide you through software deployment from the end-user perspective, focusing on creating accessible and user-friendly installers. By the end of this module, you will have a deeper understanding of common deployment challenges and the skills to create better deployment solutions.";
    public static $pages = [
        "index" => "",
        "pre-survey" => "Pre-Survey",
        "introduction" => "Introduction",
        "installers-demo" => "Installers | Demo",
        "installers-creation" => "Installers | Creation",
        "installers-reflection" => "Installers | Reflection",
        "self-deployment-demo" => "Self-Deployment | Demo",
        "self-deployment-creation" => "Self-Deployment | Creation",
        "self-deployment-reflection" => "Self-Deployment | Reflection",
        "post-survey" => "Post-Survey",
        "review" => ""
    ];
    public static $objectives = [
        "Describe the purpose and components of software installers.",
        "Explain the importance of clear documentation for end-user self-deployment.",
        "Demonstrate how to set up applications using detailed guides.",
        "Apply knowledge by creating software installers.",
        "Analyze how varying levels of documentation impact end-user deployment success."
    ];
    public static $willlearn = [
        "Installer creation for current operating system.",
        "Best practices for writing user-centered README files.",
        "Techniques for guiding users through self-deployment.",
        "Evaluation of deployment documentation effectiveness."
    ];
}