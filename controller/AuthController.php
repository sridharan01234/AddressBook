<?php
require "./model/UserModel.php";
require_once "BaseController.php";

class AuthController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    /**
     * Validates register form entries
     * 
     * @return bool
     */
    public function validateRegisterEntries(): bool
    {

        if (strlen($_POST['first_name']) == 0) {
            $error = "please enter first name";
            header_remove();
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($error);
            exit();
        }
        
        if (strlen($_POST['last_name']) == 0) {
            $error = "please enter last name";
            header_remove();
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($error);
            exit();
        }

        if (strlen($_POST['email']) == 0) {
            $error = "please enter email ";
            header_remove();
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($error);
            exit();
        }

        if (strlen($_POST['password']) == 0) {
            $error = "please enter password";
            header_remove();
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($error);
            exit();
        }

        if (strlen($_POST['repeat_password']) == 0) {
            $error = "please enter confirm password";
            header_remove();
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($error);
            exit();
        }

        if (strlen($_POST['password']) != strlen($_POST['repeat_password']) || $_POST['password'] != $_POST['repeat_password']) {
            $error = "password does not match";
            header_remove();
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($error);
            exit();
        }

        if (!strpos($_POST['email'], '@')) {
            $error = "Enter a valid email @ not found";
            header_remove();
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($error);
            exit();
        }

        if (!strpos($_POST['email'], '.')) {
            $error = "Enter a valid email . not found";
            header_remove();
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($error);
            exit();
        }

        if (strpos($_POST['email'], '.') == strlen($_POST['email']) - 1 || strpos($_POST['email'], '.') == 0 || strpos($_POST['email'], '.') < strpos($_POST['email'], '@')) {
            $error = "Enter a valid email";
            header_remove();
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($error);
            exit();
        }

        if (strpos($_POST['email'], '@') == strlen($_POST['email']) - 1 || strpos($_POST['email'], '@') <= 2) {
            $error = "Enter a valid email";
            header_remove();
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($error);
            exit();
        }

        $uppercase = preg_match('@[A-Z]@', $_POST['password']);
        $lowercase = preg_match('@[a-z]@', $_POST['password']);
        $number = preg_match('@[0-9]@', $_POST['password']);
        $specialChars = preg_match('@[^\w]@', $_POST['password']);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['password']) < 8) {
            $error = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            header_remove();
            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($error);
            exit();
        } else {
            return true;
        }
    }

    /**
     * Checks duplicate user and registers using Database class
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
                    $message = "Email Successfully Registered";
                    echo $message;
                }
            } else {
                $error = "Email Already Registered";
                echo $error;
            }
        }
        $this->render("Register");
        exit;
    }
}
