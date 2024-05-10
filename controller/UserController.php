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
                $this->render('listContacts', $this->getContacts());
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == self::POST) {
            if ($_POST['type'] == 'delete') {
                $this->deleteContacts();
            }
            $this->render('listContacts', $this->getContacts());
        }
    }

    /**
     * Get all contacts of an user
     * 
     * @return array
     */
    public function getContacts(): array
    {
        $contacts = $this->userModel->getContacts($_SESSION['userId']);
        foreach ($contacts as $user) {
            $user->country = $this->userModel->get('countries', ['id' => $user->country_id], ['name'])->name;
            $user->state = $this->userModel->get('states', ['id' => $user->state_id], ['name'])->name;
        }
        return $contacts;
    }

    /**
     * Delete all the selected contacts
     */
    public function deleteContacts(): void
    {
        foreach ($_POST['delete_users'] as $user) {
            $this->userModel->delete('contacts', ['id' => $user]);
        }
    }
}