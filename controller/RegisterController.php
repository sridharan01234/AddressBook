<?php
require "./model/UserModel.php";
class RegisterController
{
    private $db;

    public function __construct()
    {
        $this->db = new UserModel();
    }
    
    /**
     * Displays index function
     * 
     * @return void
     */
    public function index(): void
    {
        require_once "./view/register.php";
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
        if (!$this->db->get("users", ["email" => $data["email"]], "*")) {
            if ($this->db->insert("users", $data, 1)) {
                $message = "Email Successfully Registered";
            }
        } else {
            $error = "Email Already Registered";
        }
        require_once "./view/register.php";
    }
}
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
