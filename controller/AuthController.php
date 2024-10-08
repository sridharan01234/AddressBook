<?php

/**
 * This file contains auth actions
 *
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 13/5/2024
 */

require_once "./model/AuthModel.php";
require_once "BaseController.php";
require_once "./helper/SessionHelper.php";

class AuthController extends BaseController
{
    private const POST = 'POST';
    private const GET = 'GET';
    private $model;

    /**
     * @param string $path
     */
    public function __construct(private string $path)
    {
        $this->model = new AuthModel();
    }

    /**
     * Handles login post request
     *
     * @return void
     */
    public function login(): void
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === self::POST) {
            $message = $this->validateLoginEntries();
            if (!$message) {
                $data = [
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    PASSWORD_DEFAULT,
                ];
                $user = $this->model->verifyEmail($data['email']);
                if ($user) {
                    if (password_verify($data['password'], $user->password)) {
                        $_SESSION['user_id'] = $user->id;
                        $_SESSION['user_name'] = $user->name;
                        $this->redirect('contacts');
                    } else {
                        $data = ['error' => 'Incorrect password'];
                    }
                } else {
                    $data = ['error' => 'User not found'];
                }
            } else {
                $data = ['error' => $message];
            }
        }
        $this->render("login", $data);
    }

    /**
     * Handles register post request for user add
     *
     * @return void
     */
    public function register(): void
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === self::POST) {
            $message = $this->validateRegisterEntries();
            if (!$message) {
                $data = [
                    "name" => sprintf("%s%s", $_POST["first_name"], $_POST["last_name"]),
                    "email" => $_POST["email"],
                    "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
                    "firstname" => $_POST["first_name"],
                    "lastname" => $_POST["last_name"],
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
        $this->render("register", $data);
    }

    /**
     * Verify user exists
     *
     * @return void
     */
    public function verifyUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === self::GET) {
            if ($this->model->verifyEmail($_GET['email'])) {
                echo "exists";
            } else {
                echo "not exists";
            }
            exit;
        }
    }

    /**
     * Validate login form entries
     *
     * @return string
     */
    private function validateLoginEntries(): string
    {
        if (!strlen($_POST['email'])) {
            return "Please enter email";
        }
        if (!strlen($_POST['password'])) {
            return "Please enter password";
        }
        return "";
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

    /**
     * Handles logout request
     *
     * @return void
     */
    public function logout(): void
    {
        session_destroy();
        $this->redirect('login');
    }
}
