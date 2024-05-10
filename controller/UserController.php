<?php

/**
 * This file contains user actions
 * 
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last Modified : 10-5-2024
 */

require_once "./model/UserModel.php";
require_once "BaseController.php";
require_once "./helper/SessionHelper.php";
require_once "./interface/PageInterface.php";

class UserController extends BaseController implements PageInterface
{

    private $path;
    private $userModel;
    private const POST = 'POST';
    private const GET = 'GET';

    public function __construct($path)
    {
        $this->userModel = new UserModel();
        $this->path = $path;
    }

    /**
     * Displays all contatcts
     * 
     * @return void
     */
    public function index(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == self::GET) {
            if ($this->path == 'listcontacts') {
                $data = $this->userModel->getContacts($_SESSION['userId']);
                $this->render('ListContacts', $data);
            }
        }
    }
}