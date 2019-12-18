<?php

namespace App\Controllers;
use App\Models\JobModel;
use Respect\Validation\Validator;

class JobController extends BaseController {
    private function createJob($title, $description, $image) {
        $job = new JobModel();
        $job->title = $title;
        $job->description = $description;
        $job->visible = 1;
        $job->months = 16;
        $job->image = $image;
        $job->save();
    }

    public function getAddJobAction($request) {
        $method = $request->getMethod();
        $responseMessage = null;

        if($method == 'POST') {
            $postData = $request->getParsedBody();
            $jobValidator = Validator::key('title', Validator::stringType()->notEmpty())
                  ->key('description', Validator::stringType()->notEmpty());

            try {
                $jobValidator->assert($postData);
                $files = $request->getUploadedFiles();
                $asset = $files['asset'];
                $fileName = null;

                if ($asset->getError() == UPLOAD_ERR_OK) {
                    $fileName = $asset->getClientFileName();
                    $asset->moveTo("uploads/$fileName");
                }
                $this->createJob($postData['title'], $postData['description'], $fileName);
                $responseMessage = 'Saved';
            } catch (\Exception $error) {
                $responseMessage = $error->getMessage();
            }
        }

        return $this->renderHTML('add-job.twig', [
            'responseMessage' => $responseMessage
        ]);
    }
}