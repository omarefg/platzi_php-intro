<?php

namespace App\Controllers;
use App\Models\UserModel;
use Respect\Validation\Validator;

class UserController extends BaseController {

    private function createUser ($username, $password) {
        $user = new UserModel();
        $user->username = $username;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();
    }

    public function getAddUserAction($request) {
        $method = $request->getMethod();
        $responseMessage = null;

        if($method == 'POST') {
            $postData = $request->getParsedBody();
            $projectValidator = Validator::key('username', Validator::stringType()->notEmpty())
                  ->key('password', Validator::stringType()->notEmpty());

            try {
                $projectValidator->assert($postData);
                $this->createUser($postData['username'], $postData['password']);
                $responseMessage = 'Saved';
            } catch (\Exception $error) {
                $responseMessage = $error->getMessage();
            }
        }

        return $this->renderHTML('add-user.twig');
    }
}