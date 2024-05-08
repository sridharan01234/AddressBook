<?php

/**
 * This file contains register actions
 * 
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 8/5/2024
 */

require "./model/AuthModel.php";
require_once "BaseController.php";

class AuthController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new AuthModel();
    }

    /**
     * Validate duplicate user and add user
     * 
     * @return void
     */
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->validateRegisterEntries();
            $data = [
                "name" => sprintf("%s%s", $_POST["first_name"], $_POST["last_name"]),
                "email" => $_POST["email"],
                "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
                "first_name" => $_POST["first_name"],
                "last_name" => $_POST["last_name"],
            ];
            if (!$this->model->verifyEmail($data['email'])) {
                if ($this->model->registerUser($data)) {
                    $data = ['message' => 'Email Successfully Registered'];
                }
            } else {
                $data = ['error' => 'Email Already Registered'];
            }
        }
        $this->render("Register", $data);
    }

    /**
     * Send error to view page
     * 
     * @param string $error
     * 
     * @return void
     */
    private function errorResponse(string $error): void
    {
        $this->render("Register", ['error' => $error]);
        exit;
    }

    /**
     * Validate register form entries
     * 
     * @return void
     */
    private function validateRegisterEntries(): void
    {

        if (strlen($_POST['first_name']) == 0) {
            $this->errorResponse("please enter first name");
        }

        if (strlen($_POST['last_name']) == 0) {
            $this->errorResponse("please enter last name");
        }

        if (strlen($_POST['email']) == 0) {
            $this->errorResponse("please enter email");
        }

        if (strlen($_POST['password']) == 0) {
            $this->errorResponse("please enter password");
        }

        if (strlen($_POST['repeat_password']) == 0) {
            $this->errorResponse("please enter confirm password");
        }

        if ($_POST['password'] != $_POST['repeat_password']) {
            $this->errorResponse("password and confirm password does not match");
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errorResponse("Please enter a valid email");
        }

        if (
            !preg_match(
                '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m',
                $_POST['password']
            )
        ) {
            $this->errorResponse('Password should be at least 8 characters in 
            length and should include at least one upper case letter, one number,
             and one special character.');
        }
    }
}
