<?php
require "./model/UserModel.php";

class RegisterController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }
    
    /**
     * Displays index function
     * 
     * @return void
     */
    public function index(): void
    {
        require_once "./view/Register.php";
    }

    /**
     * Checks duplicate user and registers using Database class
     * 
     * @return void
     */
    public function register(): void
    {
        $data = [
            "name" => sprintf("%s%s",$_POST["first_name"],$_POST["last_name"]),
            "email" => $_POST["email"],
            "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
            "first_name" => $_POST["first_name"],
            "last_name" => $_POST["last_name"],
        ];
        if (!$this->model->verifyEmail($data['email'])) {
            if ($this->model->registerUser($data)) {
                $message = "Email Successfully Registered";
            }
        } else {
            $error = "Email Already Registered";
        }
        require_once "./view/Register.php";
    }
}

/**
 * For handling requests
 */
$init = new RegisterController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            break;
        default:
            header('location: ./');
    }
}
