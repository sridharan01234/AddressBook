<?php
require "../Model/UserModel.php";
require '../vendor/autoload.php';
class RegisterController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        require_once "../View/register.php";
    }

    public function register()
    {
        var_dump($_POST);
        $data = [
            "name" => $_POST["name"],
            "email" => $_POST["email"],
            "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
            "first_name" => $_POST["first_name"],
            "last_name" => $_POST["last_name"],
            "name"=> $_POST["first_name"].$_POST["last_name"]
        ];
        if (!$this->userModel->get("users", ["email" => $data["email"]], "*")) {
            if($this->userModel->insert("users", $data, 1))
            {
                echo"Email Successfully Registered";
            }
        } else {
            echo "Email Already Registered";
        }
    }
}

$init = new RegisterController();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    switch ($_GET['type']) {
        case 'index':
            $init->index();
            break;
        default:
            header('location: ../');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            break;
        default:
            header('location: ../');
    }
}
