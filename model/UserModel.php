<?php
require "./database/Database.php";

class UserModel extends Database
{

    /**
     * Verifies email is existing or not in db
     * 
     * @param string $email
     * 
     * @return mixed
     */
    public function verifyEmail(string $email): mixed
    {
        return $this->get("users",['email'=>$email], []);
    }
    
    /**
     * Registers user in database
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