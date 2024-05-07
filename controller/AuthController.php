<?php
require './database/Database.php';
class AuthController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Displays login index
     * 
     * @return void
     */
    public function loginPage(): void
    {
        require_once './view/login.php';
    }

    /**
     * Gets input from POST and verfies user in db and checks password
     * 
     * @return void
     */
    public function login(): void
    {
        $data = [
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            PASSWORD_DEFAULT,
        ];
        $user = $this->db->get('users', ["email" => $data["email"]], '*');
        if ($user) {
            if (password_verify($data['password'], $user->password)) {
                $_SESSION['user_id'] = $user->id;
                $message = "Login Success";
                require_once './view/login.php';
            } else {
                $error = "Incorrect password";
                require_once './view/login.php';
            }
        } else {
            $error = "User not found";
            require_once './view/login.php';
        }
    }

    /**
     * Destroys session and unsets Session variable
     * 
     * @return void
     */
    public function logout(): void
    {
        session_destroy();
        unset($_SESSION);
    }
}
$init = new AuthController();

//Handle requests with types
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'login': {
            $init->login();
            break;
        }
        case 'logout': {
            $init->logout();
        }
        default: {
            $init->loginPage();
        }
    }
}