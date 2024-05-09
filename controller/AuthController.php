<?php

/**
 * This file contains register actions
 * 
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 9/5/2024
 */

require "./model/AuthModel.php";
require_once "BaseController.php";

class AuthController extends BaseController
{
    private const post = 'POST';
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
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === self::post) {
            $message = $this->validateRegisterEntries();
            if (!$message) {
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
            } else {
                $data = ['error' => $message];
            }
        }
        $this->render("Register", $data);
    }

    /**
     * Validate register form entries
     * 
     * @return string
     */
    private function validateRegisterEntries(): string
    {

        if (strlen($_POST['first_name']) == 0) {
            return "please enter first name";
        }

        if (strlen($_POST['last_name']) == 0) {
            return "please enter last name";
        }

        if (strlen($_POST['email']) == 0) {
            return "please enter email";
        }

        if (strlen($_POST['password']) == 0) {
            return "please enter password";
        }

        if (strlen($_POST['repeat_password']) == 0) {
            return "please enter confirm password";
        }

        if ($_POST['password'] !== $_POST['repeat_password']) {
            return "password and confirm password does not match";
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            return "Please enter a valid email";
        }

        if (
            !preg_match(
                '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m',
                $_POST['password']
            )
        ) {
            return "Password should be at least 8 characters in 
            length and should include at least one upper case letter, one number,
             and one special character.";
        }
        return '';
    }
}
