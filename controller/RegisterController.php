<?php
require "./model/UserModel.php";
class RegisterController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        require_once "./view/register.php";
    }

    public function register()
    {
        $data = [
            "name" => $_POST["first_name"] . $_POST['last_name'],
            "email" => $_POST["email"],
            "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
            "first_name" => $_POST["first_name"],
            "last_name" => $_POST["last_name"],
        ];
        if (!$this->userModel->get("users", ["email" => $data["email"]], "*")) {
            if ($this->userModel->insert("users", $data, 1)) {
                $message = "Email Successfully Registered";
                require_once "./view/register.php";
            }
        } else {
            $error = "Email Already Registered";
            require_once "./view/register.php";
        }
    }
}
$init = new RegisterController();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['type'])) {
        switch ($_GET['type']) {
            case 'index':
                $init->index();
                break;
            default:
                header('location: ./');
        }
    }
    else
    {
        $init->index();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            break;
        default:
            header('location: ./');
    }
}