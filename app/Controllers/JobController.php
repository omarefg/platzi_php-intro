<?php

namespace App\Controllers;
use App\Models\JobModel;

class JobController {
    private function createJob($title, $description) {
        $job = new JobModel();
        $job->title = $title;
        $job->description = $description;
        $job->visible = 1;
        $job->months = 16;
        $job->save();
    }

    public function getAddJobAction($request) {
        $method = $request->getMethod();

        if($method == 'POST') {
            $postData = $request->getParsedBody();
            $this->createJob($postData['title'], $postData['description']);
        }

        include '../views/add-job.php';
    }
}