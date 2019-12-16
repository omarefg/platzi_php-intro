<?php

namespace App\Controllers;
use App\Models\ProjectModel;

class ProjectController {

    private function createProject ($title, $description) {
        $project = new ProjectModel();
        $project->title = $title;
        $project->description = $description;
        $project->visible = 1;
        $project->months = 16;
        $project->save();
    }

    public function getAddProjectAction($request) {
        $method = $request->getMethod();

        if($method == 'POST') {
            $postData = $request->getParsedBody();
            $this->createProject($postData['title'], $postData['description']);
        }

        include '../views/add-project.php';
    }
}