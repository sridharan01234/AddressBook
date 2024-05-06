<?php
require "../Model/UserModel.php";
require '../Helper/SessionHelper.php';

class fetchStates
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function getStates(): void
    {
        $result = $this->userModel->getAll('states', ['country_id' => $_GET['country_id']], "*");
        $states = array();
        foreach ($result as $row) {
            $states[] = array(
                'id' => $row->id,
                'name' => $row->name,
            );
        }
        echo json_encode($states);
    }
}
$init = new fetchStates();
$init->getStates();
