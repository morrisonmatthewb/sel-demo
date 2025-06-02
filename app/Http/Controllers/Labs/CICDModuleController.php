<?php

namespace App\Http\Controllers\Labs;

class CICDModuleController extends DefaultController{
    public static $lab = "cicd-config-management";
    public static $display = "CI/CD";
    public static $description = "This module will guide you through the creation and management of a code repository and implementation of CICD.";
    public static $pages = [
        "index" => "",
        "pre-survey" => "Pre-Survey",
        "introduction" => "Introduction",
        "activity-1" => "Activity 1: Version Control With Git",
        "activity-2" => "Activity 2: CICD on GitLab",
        "post-survey" => "Post-Survey",
        "review" => ""
    ];
    public static $objectives = [
        "Interpret basic concepts of CI/CD including deployment pipelines and version control uses.",
        "Compare and contrast the advantages and disadvantages of different aspects of CI/CD that will allow for further discussion in a class environment.",
        "Implement CI/CD solutions through the completion of a lab that asks the user to implement a simple CI/CD pipeline and an exercise where the user will create a version control repository, manipulate it using pushes, pulls, commits, and investigate changes using log reviews.",
        "Experiment with good and bad implementations of CICD to discover good practices and potential CICD failings in an educational environment."
    ];
    public static $willlearn = [
        "What is CI/CD? What is it good for?",
        "How to create and manage a repository on GitHub",
        "How to create and manage a repository on GitLab",
        "How to use and configure CICD pipelines on GitLab."
    ];
}