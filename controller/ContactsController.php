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
        //verfies if the user is logged in
        if (!isset($_SESSION['user_id']))
            $this->redirect("login");
        //get all contacts
        $contacts = $this->contactsModel->getAllContacts($_SESSION['user_id']);
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

    /**
     * Add a contact
     * 
     * @return void
     */
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
            $error = $this->validateAddContact($data);
            if ($error) {
                $this->render("addContact", ['error' => $error]);
                return;
            }
            if ($this->contactsModel->createContacts($data))
                $this->render("addContact", ['message' => 'Contact added successfully.']);
            else
                $this->render("addContact", ['error' => 'Contact number aready exists.']);
        } else {
            $this->render("addContact", []);
        }
    }

    /**
     * validate add user entries
     * 
     * @param array $data
     * 
     * @return string
     */
    public function validateAddContact(array $data): string
    {
        if (isset($data["name"]) && !empty($data["name"])) {
            if (isset($data["phone"]) && !empty($data["phone"])) {
                if (isset($data["age"]) && !empty($data["age"])) {
                    if (isset($data["pincode"]) && !empty($data["pincode"])) {
                        if (isset($data["address"]) && !empty($data["address"])) {
                            if (isset($data["country_id"]) && !empty($data["country_id"])) {
                                if (isset($data["state_id"]) && !empty($data["state_id"])) {
                                    return "";
                                } else {
                                    return "Please fill the state field";
                                }
                            } else {
                                return "Please fill the country field";
                            }
                        } else {
                            return "Please fill the address field";
                        }
                    } else {
                        return "Please fill the pincode field";
                    }
                } else {
                    return "Please fill the age field";
                }
            } else {
                return "Please fill the phone field";
            }
        } else {
            return "Please fill the name field";
        }
    }

    /**
     * Edit a contact
     * 
     * @return void
     */
    public function editContact(): void
    {
        $message = "";
        $error = "";
        if (array_key_exists("contact_id", $_GET)) {
            $contact = $this->contactsModel->getContact($_GET['contact_id']);
        }
        if (array_key_exists('id', $_POST)) {
            $contact = $this->contactsModel->getContact($_POST['id']);
        }
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
        if ($_SERVER["REQUEST_METHOD"] == self::GET) {
            $this->render("editContact", [
                'contact_id' => $_GET['contact_id'],
                "contact" => $contact
            ]);
        }
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
            $error = $this->validateEditContact($data);
            if ($error) {
                $this->render("editContact", ['error' => $error]);
                return;
            }
            $this->contactsModel->updateContacts($_POST['id'], $data);
            $message = "Contact updated successfully.";
        }
        $this->render("editContact", ['message' => $message, "contact" => $contact]);
    }

    /**
     * validate edit user entries
     * 
     * @param array $data
     * 
     * @return string
     */
    public function validateEditContact(array $data): string
    {
        if (
            empty($data['name']) || empty($data['phone'])
            || empty($data['age']) || empty($data['pincode'])
            || empty($data['address']) || empty($data['country_id'])
            || empty($data['state_id'])
        ) {
            return "Please fill all the fields";
        }
        return "";

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
            foreach ($users as $userId) {
                $this->contactsModel->deleteContacts($userId);
            }
        }
        $this->listContacts();
    }

    /**
     * Get all countries
     * 
     * @return void
     */
    public function getCounties(): void
    {
        $result = $this->contactsModel->getCounties();
        $countries = array();
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
     * @return void
     */
    public function getStates(): void
    {
        $result = $this->contactsModel->getStates();
        $countries = array();
        foreach ($result as $row) {
            $countries[] = [
                'id' => $row->id,
                'name' => $row->name
            ];
        }
        echo json_encode($countries);
        exit;
    }
}
