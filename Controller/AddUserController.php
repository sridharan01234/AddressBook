<?php
require "../Model/UserModel.php";
require '../vendor/autoload.php';
require '../Helper/SessionHelper.php';

class AddUserController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        require '../View/adduser.php';
    }
    public function create()
    {
        $data = [
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'age' => $_POST['age'],
            'country_id' => $_POST['country'],
            'state_id' => $_POST['state'],
            'address' => $_POST['address'],
            'user_id' => $_SESSION['user_id'],
            'pincode' => $_POST['pincode'],
        ];
        if ($this->userModel->get('contacts', ['phone' => $data['phone']], '*')) {
            $error = sprintf("contact already exist in name of %s", $data['name']);
            require '../View/adduser.php';
        } else {
            $this->userModel->insert('contacts', $data, 1);
            $message = sprintf("contact %s added successfully", $data['name']);
            require '../View/adduser.php';
        }
    }
}

$init = new AddUserController();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    switch ($_GET['type']) {
        case 'index':
            $init->index();
            break;
        default:
            $init->index();
            break;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $init->create();
}
