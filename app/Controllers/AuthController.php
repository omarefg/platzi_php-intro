<?php

namespace App\Controllers;
use App\Models\UserModel;
use Zend\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController {

    public function getLogin() {
        return $this->renderHTML('login.twig');
    }

    public function postLogin($request) {
        $postData = $request->getParsedBody();
        $user = UserModel::where('username', $postData['username'])->first();
        $responseMessage = null;

        if ($user) {
            if (password_verify($postData['password'], $user->password)) {
                $_SESSION['userId'] = $user->id;
                return new RedirectResponse('/php-intro/admin/');
            } else {
                $responseMessage = 'Bad credentials';
            }
        } else {
            $responseMessage = 'Bad credentials';
        }

        return $this->renderHTML('login.twig', [
            'responseMessage' => $responseMessage
        ]);
    }

    public function getLogout() {
        unset($_SESSION['userId']);
        return new RedirectResponse('/php-intro/login/');
    }
}