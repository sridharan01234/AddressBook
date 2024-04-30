<?php
require "../Model/UserModel.php";
require '../vendor/autoload.php';
require '../Helper/SessionHelper.php';

class ListContactsController
{
    private $userModel;
    public $users;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Display ListContacts page
     *
     * @return void
     */
    public function index(): void
    {
        require_once '../View/listContacts.php';
    }

    /**
     * Get conatcts of an user from DB
     *
     * @return void
     */
    public function listContacts(): void
    {
        $data = [
            'user_id' => $_SESSION['user_id'],
        ];
        $this->users = $this->userModel->getAll('contacts', ['user_id' => $data['user_id']], "*");
        foreach ($this->users as $user) {
            $user->country = $this->userModel->get('countries', ['id' => $user->country_id], 'name')->name;
            $user->state = $this->userModel->get('states', ['id' => $user->state_id], 'name')->name;
        }
        require_once '../View/listContacts.php';
    }

    public function deleteContacts(): void
    {
        foreach ($_POST['delete_users'] as $user) {
            $this->userModel->delete('contacts', ['id' => $user]);
        }
    }
}
if(!isset($_SESSION['user_id']))
{
    header('location: ./LoginController.php');
    exit;
}
$init = new ListContactsController();
if (isset($_POST['delete_users'])) {
    $init->deleteContacts();
}

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    switch($_GET['type']) 
    {
        case 'index':
            $init->listContacts();
            break;
        default:
            header('location: ./LoginController.php');
            exit;
    }
}
