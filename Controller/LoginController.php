<?php
require "../Model/UserModel.php";
require '../vendor/autoload.php';
require '../Helper/SessionHelper.php';
class LoginController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Displays login Page
     */
    public function index(): void
    {
        require_once '../View/login.php';
    }
    /**
     * Login controller verifies user and password from db using userModel
     */
    public function login(): void
    {
        $data = [
            'email' => $_POST['email'],
            'password' => $_POST['password'], PASSWORD_DEFAULT,
        ];
        $user = $this->userModel->get('users', ["email" => $data["email"]], '*');
        if ($user) {
            if (password_verify($data['password'], $user->password)) {
                $_SESSION['user_id'] = $user->id;
                header('location: ListContactsController.php?type=index');
                exit;
            } else {
                $message = "incorrect password";
                require_once '../View/login.php';
            }
        } else {
            $message = "User not found";
            require_once '../View/login.php';
        }
    }
}
$init = new LoginController();

/**
 * Handles POST Request and redirects specific actions
 */
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $init->login();
}

/**
 * Handles GET Request and redirects specific actions
 */
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    switch ($_GET['type']) {
        case 'value':
            $init->index();
            break;
        default:
            $init->index();
            break;
    }
}
