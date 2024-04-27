<?php
require "../Model/UserModel.php";
require '../vendor/autoload.php';

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
            'user_id'=> $_SESSION['user_id']
        ];
        $this->users = $this->userModel->getAll('contacts',['user_id'=>1],"*");
        require_once '../View/listContacts.php';
    }
}

$init = new ListContactsController();
$init->listContacts();