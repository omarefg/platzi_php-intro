<?php

namespace App\Controllers;
use App\Models\JobModel;
use App\Models\ProjectModel;

class IndexController extends BaseController {
    public function indexAction() {
        $jobs = JobModel::all();
        $projects = ProjectModel::all();

        return $this->renderHTML('index.twig', [
            'jobs' => $jobs,
            'projects' => $projects
        ]);
    }
}