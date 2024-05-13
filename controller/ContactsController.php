<?php

require_once "BaseController.php";
require_once "./model/ContactsModel.php";
require_once "./helper/SessionHelper.php";

class ContactsController extends BaseController
{
    private const POST = "POST";
    private const GET = "GET";
    private $contactsModel;

    /**
     * ContactsController constructor.
     */
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
        if ($_SERVER["REQUEST_METHOD"] === self::GET) {
            $contacts = $this->contactsModel->getContacts($_SESSION['user_id']);
            foreach ($contacts as $contact) {
                if (isset($contact->country_id)) {
                    $contact->country = $this->contactsModel->getCountry($contact->country_id)->name;
                } else {
                    $contact->country = "N/A";
                }

                if (isset($contact->state_id)) {
                    $contact->state = $this->contactsModel->getState($contact->state_id)->name;
                } else {
                    $contact->state = "N/A";
                }
            }
            $this->render("listContacts", [
                "contacts" => $contacts
            ]);
        }
    }
}
