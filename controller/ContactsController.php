<?php

/**
 * ContactsController class
 * 
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 15/5/2024
 */

require_once "BaseController.php";
require_once "./model/ContactsModel.php";
require_once "./helper/SessionHelper.php";

class ContactsController extends BaseController
{

    private const POST = "POST";
    private const GET = "GET";
    private $contactsModel;

    public function __construct()
    {
        $this->contactsModel = new ContactsModel();
    }

    /**
     * List all contacts
     * 
     * @return void
     */
    public function listContacts(): void
    {
        //verfies if the user is logged in
        if (!isset($_SESSION['user_id']))
            $this->redirect("login");
        //get all contacts
        $contacts = $this->contactsModel->getContacts($_SESSION['user_id']);
        foreach ($contacts as $contact) {
            $contact->country = isset($contact->country_id) ? $this->contactsModel->getCountry($contact->country_id)->name : "N/A";
            $contact->state = isset($contact->state_id) ? $this->contactsModel->getState($contact->state_id)->name : "N/A";
        }

        $this->render("listContacts", [
            "contacts" => $contacts
        ]);
    }

    /**
     * Delete a contact
     * 
     * @return void
     */
    public function deleteContact(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == self::POST && isset($_POST['delete_users'])) {
            $users = $_POST['delete_users'];
            $this->contactsModel->deleteContacts($users);
        }
        $this->listContacts();
    }
}
