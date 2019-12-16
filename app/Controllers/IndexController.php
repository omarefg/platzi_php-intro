<?php

namespace App\Controllers;
use App\Models\JobModel;
use App\Models\ProjectModel;

class IndexController {
    public function indexAction() {
        $jobs = JobModel::all();
        $projects = ProjectModel::all();

        include '../views/index.php';
    }
}