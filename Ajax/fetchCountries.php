<?php
require "../Model/UserModel.php";
require '../Helper/SessionHelper.php';

class fetchCounties
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function getCounties(): void
    {
        $result = $this->userModel->getAll('countries',"",'*');
        $countries = array();
        foreach ($result as $row) {
            $countries[] = array(
                'id' => $row->id,
                'name' => $row->name,
            );
        }
        echo json_encode($countries);
    }
}
$init = new fetchCounties();
$init->getCounties();
