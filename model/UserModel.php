<?php

/**
 * This file contains user db actions
 * 
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 10-5-2024
 */

require "./database/Database.php";

class UserModel extends Database
{

    /**
     * Get all contacts associated with user
     * 
     * @param int $userId
     * 
     * @return array
     */
    public function getContacts(int $userId): array
    {
        return $this->getAll('contacts', ['user_id' => $userId], []);
    }
}