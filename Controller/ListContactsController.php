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
        $this->listContacts();
    }
}
if(!isset($_SESSION['user_id']))
{
    header('location: ./LoginController.php');
    exit;
}
$init = new ListContactsController();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    switch ($_POST['type'])
    {
        case 'delete':
            $init->deleteContacts();
            break;
        case 'index':
            $init->listContacts();
            break;
        default:
            $init->listContacts();
            break;
    }
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
