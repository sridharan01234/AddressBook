<?php
require "../Model/UserModel.php";
require '../vendor/autoload.php';
require '../Helper/SessionHelper.php';
class EditUserController {
    private $userModel;
    public function __construct() 
    {
        $this->userModel = new UserModel();
    }
    
}