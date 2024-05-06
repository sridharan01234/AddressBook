<?php
require "../Model/UserModel.php";
require '../Helper/SessionHelper.php';
class EditUserController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Display edit user page
     * 
     * @return void
     */
    public function index(): void
    {
        $user = $this->userModel->get('contacts', ['id' => $_GET['contact_id']], "*");
        require '../View/edituser.php';
    }

    /**
     * Perform db action to update user
     * 
     * @param int $id holds id of contact is changed
     * @return void
     */
    public function update(int $id): void
    {
        $data = [
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'age' => $_POST['age'],
            'country_id' => $_POST['country'],
            'state_id' => $_POST['state'],
            'address' => $_POST['address'],
            'user_id' => $_SESSION['user_id'],
            'pincode' => $_POST['pincode'],
        ];
        if ($this->userModel->update('contacts', $data, ['id' => $id])) {
            header('location: ./ListContactsController.php');
        } else {
            var_dump($_POST);
            echo "Sql Error";
        }
    }
}
$init = new EditUserController();
$id = $_GET['contact_id'];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $init->index();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $init->update($id);
}
