<?php

/**
 * ContactsController class
 *
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 17/5/2024
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
        if (!isset($_SESSION['user_id'])) {
            $this->redirect("login");
        }

        //get all contacts
        $contacts = $this->contactsModel->getContacts($_SESSION['user_id']);

        $this->render("listContacts", [
            "contacts" => $contacts,
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

    /**
     * Add a contact
     *
     * @return void
     */
    public function addContact(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == self::POST) {
            $data = [
                "name" => $_POST["name"],
                "phone" => $_POST["phone"],
                "age" => $_POST["age"],
                "pincode" => $_POST["pincode"],
                "address" => $_POST["address"],
                "country_id" => $_POST["country"],
                "state_id" => $_POST["state"],
                "user_id" => $_SESSION['user_id'],
            ];
            $error = $this->validateContact($data);
            if ($error) {
                $this->render("addContact", ['error' => $error]);
                return;
            }
            if ($this->contactsModel->contactExists($data['phone'], $data['user_id'])) {
                $this->render("addContact", ['error' => 'Contact number already exists.']);
                return;
            }
            $this->contactsModel->createContacts($data);
            $this->render("addContact", ['message' => 'Contact added successfully.']);
            return;
        }
        $this->render("addContact", []);
    }

    /**
     * validate add user entries
     *
     * @param array $data
     *
     * @return string
     */
    public function validateContact(array $data): string
    {
        $errors = [];
        $fields = [
            "name" => "Please fill the name field",
            "address" => "Please fill the address field",
            "state_id" => "Please fill the state field",
            "country_id" => "Please fill the country field",
            "pincode" => "Please fill the pincode field",
            "phone" => "Please fill the phone field",
            "age" => "Please fill the age field",
        ];

        foreach ($fields as $field => $errorMessage) {
            if (!isset($data[$field]) || empty($data[$field])) {
                $errors[] = $errorMessage;
            }
        }

        if (empty($errors)) {
            return "";
        }

        return implode("<br>", $errors);
    }

    /**
     * Edit a contact
     *
     * @return void
     */
    public function editContact(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == self::POST) {
            $data = [
                "id" => $_POST["id"],
                "name" => $_POST["name"],
                "address" => $_POST["address"],
                "phone" => $_POST["phone"],
                "age" => $_POST["age"],
                "state_id" => $_POST["state"],
                "country_id" => $_POST["country"],
                "pincode" => $_POST["pincode"],
            ];
            $error = $this->validateContact($data);
            if ($error) {
                $contact = $this->contactsModel->getContact($data['id']);
                $this->render("editContact", ['contact' => $contact, 'error' => $error]);
                exit;
            }
            $this->contactsModel->editContacts($data);
            $contact = $this->contactsModel->getContact($data['id']);
            $this->render("editContact", ['contact' => $contact, 'message' => 'Contact updated successfully.']);
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == self::GET) {
            $id = $_GET['id'];
            $contact = $this->contactsModel->getContact($id);
            $this->render("editContact", ['contact' => $contact]);
            exit;
        }
    }

    /**
     * Get all countries
     *
     * @return mixed
     */
    public function getCounties(): mixed
    {
        $result = $this->contactsModel->getCounties();
        $countries = [];
        foreach ($result as $row) {
            $countries[] = array(
                'id' => $row->id,
                'name' => $row->name,
            );
        }

        echo json_encode($countries);
        exit;
    }

    /**
     * Get all states
     *
     * @return mixed
     */
    public function getStates(): mixed
    {
        $result = $this->contactsModel->getStates();
        $countries = array();
        foreach ($result as $row) {
            $countries[] = [
                'id' => $row->id,
                'name' => $row->name,
            ];
        }

        echo json_encode($countries);
        exit;
    }

    /**
     * Get contact details
     *
     * @return mixed
     */
    public function getContact(): mixed
    {
        if (!isset($_GET['id'])) {
            $this->redirect("contacts");
        }
        $id = (int)$_GET['id'];
        $result = $this->contactsModel->getContact($id);
        echo json_encode($result);
        exit;
    }
}
