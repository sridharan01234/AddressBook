<?php

/**
 * This file contains user auth database actions
 * 
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 10/5/2024
 */

require "./database/Database.php";

class AuthModel extends Database
{

    /**
     * Verify email is existing or not in db
     * 
     * @param string $email
     * 
     * @return mixed
     */
    public function verifyEmail(string $email): mixed
    {
        return $this->get("users", ['email'=>$email], []);
    }
    
    /**
     * Register user in database
     * 
     * @param array $data
     * 
     * @return mixed
     */
    public function registerUser(array $data): mixed
    {
        return $this->insert("users", $data);
    }
}