<?php

/**
 * This file contains request handling functionalities
 *
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 8/5/2024
 */

class Router
{
    private $routes = [];

    public function __construct()
    {
        $this->add("/", ['Controller' => 'AuthController', 'action' => 'login']);
        $this->add("/register", ['Controller' => 'AuthController', 'action' => 'register']);
        $this->add('/verifyUser', ['Controller' => 'AuthController', 'action' => 'verifyUser']);
        $this->add("/login", ['Controller' => 'AuthController', 'action' => 'login']);
        $this->add("/listContacts", ['Controller' => 'ContactsController', 'action' => 'listContacts']);
        $this->add("/logout", ['Controller' => 'AuthController', 'action' => 'logout'], );
        $this->add('/getContact', ['Controller' => 'ContactsController', 'action' => 'getContact']);
        $this->add("/addContact", ['Controller' => 'ContactsController', 'action' => 'addContact']);
        $this->add("/deleteContact", ['Controller' => 'ContactsController', 'action' => 'deleteContact']);
        $this->add("/countries", ['Controller' => 'ContactsController', 'action' => 'getCounties']);
        $this->add("/states", ['Controller' => 'ContactsController', 'action' => 'getStates']);
        $this->add('/editContact', ['Controller' => 'ContactsController', 'action' => 'editContact']);
        $this->add('/admin', ['Controller' => 'AdminController', 'action' => 'admin']);
        $this->add('/userAction', ['Controller' => 'AdminController', 'action' => 'blockAndUnblockUser']);
    }

    /**
     * Add application paths
     *
     * @param string $path
     * @param array $param
     *
     * @return void
     */
    public function add(string $path, array $param): void
    {
        $this->routes[] = [
            "path" => $path,
            "params" => $param,
        ];
    }

    /**
     * Search path
     *
     * @param string $uri
     *
     * @return bool|array
     */
    public function findRoute(string $uri): bool | array
    {
        foreach ($this->routes as $path) {
            if ($path['path'] == $uri) {
                return $path['params'];
            }
        }
        return false;
    }
}
