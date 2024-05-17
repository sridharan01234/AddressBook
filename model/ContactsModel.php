<?php

/**
 * This file contains the ContactsModel class responsible for handling contact data operations
 * 
 * Author: Sridharan
 * Email: sridharan01234@gmail.com
 * Last Modified: 13/5/2024
 */

require "./database/Database.php";

class ContactsModel extends Database
{
    private $db;

    /**
     * ContactsModel constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Get the contacts for the current user
     * 
     * @param int $id The ID of the user
     * 
     * @return array An array of contact objects
     */
    public function getContacts(int $id): array
    {
        return $this->db->getAll('contacts', ['user_id' => $id], []);
    }

    /**
     * Delete a contact with the given ID
     * 
     * @param array $id The IDs of the contact to delete
     * 
     * @return bool True if the contact was deleted successfully, false otherwise
     */
    public function deleteContacts(array $ids): bool
    {
        return $this->db->delete('contacts', ['id' => $ids]);
    }
    

    /**
     * Create a new contact with the given data
     * 
     * @param array $data The data for the new contact
     * 
     * @return bool True if the contact was created successfully, false otherwise
     */
    public function createContacts(array $data): bool
    {
        return $this->db->insert('contacts', $data);
    }

    /**
     * Get the country name based on the ID
     * 
     * @param int $id The ID of the country
     * 
     * @return object The name of the country
     */
    public function getCountry(int $id): object
    {
        return $this->db->get('countries', ['id' => $id], ['name']);
    }

    /**
     * Get the state name based on the ID
     * 
     * @param int $id The ID of the state
     * 
     * @return object The name of the state
     */
    public function getState(int $id): object
    {
        return $this->db->get('states', ['id' => $id], ['name']);
    }

    /**
     * Get all countries
     * 
     * @return array An array of country objects
     */
    public function getCounties()
    {
        return $this->db->getAll('countries', [], []);
    }

    /**
     * Get all states
     * 
     * @return array An array of state objects
     */
    public function getStates()
    {
        return $this->db->getAll('states', ['country_id' => $_GET['country_id']], []);
    }
}
