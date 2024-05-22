<?php

/**
 * This file contains admin controller class
 *
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 13/5/2024
 */

require_once "./model/AdminModel.php";
require_once "BaseController.php";
require_once "./helper/SessionHelper.php";

class AdminController extends BaseController
{

    /**
     * @var AdminModel
     */
    private $model;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new AdminModel();
    }

    /**
     * Admin page
     *
     * @return void
     */
    public function admin(): void
    {
        $data['users'] = $this->getAllUsers();
        $this->render("admin", $data);
    }

    /**
     * Handles list contacts request
     *
     * @return void
     */
    public function getAllUsers(): array
    {
        return $this->model->getAll('users', [], []);
    }

    /**
     * Handles block user request
     *
     * @param int $id
     */
    public function blockAndUnblockUser()
    {
        $id = $_GET['id'];
        if ($this->model->getStatus($id)) {
            $this->model->updateStatus($id, 0);
        } else {
            $this->model->updateStatus($id, 1);
        }

        $this->redirect("admin");
    }
}
