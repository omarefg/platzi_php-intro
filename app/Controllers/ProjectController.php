<?php

namespace App\Controllers;
use App\Models\ProjectModel;
use Respect\Validation\Validator;

class ProjectController extends BaseController {

    private function createProject ($title, $description, $image) {
        $project = new ProjectModel();
        $project->title = $title;
        $project->description = $description;
        $project->visible = 1;
        $project->months = 16;
        $project->image = $image;
        $project->save();
    }

    public function getAddProjectAction($request) {
        $method = $request->getMethod();
        $responseMessage = null;

        if($method == 'POST') {
            $postData = $request->getParsedBody();
            $projectValidator = Validator::key('title', Validator::stringType()->notEmpty())
                  ->key('description', Validator::stringType()->notEmpty());

            try {
                $projectValidator->assert($postData);
                $files = $request->getUploadedFiles();
                $asset = $files['asset'];
                $fileName = null;

                if ($asset->getError() == UPLOAD_ERR_OK) {
                    $fileName = $asset->getClientFileName();
                    $asset->moveTo("uploads/$fileName");
                }

                $this->createProject($postData['title'], $postData['description'], $fileName);
                $responseMessage = 'Saved';
            } catch (\Exception $error) {
                $responseMessage = $error->getMessage();
            }
        }

        return $this->renderHTML('add-project.twig');
    }
}