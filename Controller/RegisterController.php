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

    /**
     * Displays register page
     */
    public function index(): void
    {
        require_once "../View/register.php";
    }

    /**
     * Gets values in post request and checks user in db and enters data in DB
     */
    public function register(): void
    {
        $data = [
            "name" => $_POST["name"],
            "email" => $_POST["email"],
            "password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
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
            var_dump($data);
            echo "Email Already Registered";
        }
    }
}

$init = new RegisterController();

/**
 * Handles POST Request and redirects specific actions
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    switch ($_GET['type']) {
        case 'index':
            $init->index();
            break;
        default:
            header('location: ../');
    }
}

/**
 * Handles GET Request and redirects specific actions
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            break;
        default:
            header('location: ../');
    }
}
