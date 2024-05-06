<?php
require "./model/UserModel.php";
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
        require_once './view/listContacts.php';
    }
}
$init = new ListContactsController();