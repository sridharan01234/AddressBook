<?php

/**
 *
 */

require "./database/Database.php";

class AdminModel extends Database
{

    private $db;

    /**
     * ContactsModel constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll(string $table, array $condition, array $columns): array
    {
        return $this->db->getAll($table, $condition, $columns);
    }

    /**
     * @param string $table
     * @param array $condition
     * @param array $columns
     */
    public function getOne(int $id)
    {
        return $this->db->get('users', ['id' => $id], []);
    }

    /**
     * Updates user status
     *
     * @param int $id
     * @param int $data
     *
     * @return bool
     */
    public function updateStatus(int $id, int $data): bool
    {
        return $this->db->update('users', ['is_blocked' => $data], ['id' => $id]);
    }

    /**
     * Gets user status
     *
     * @param int $id
     *
     * @return bool
     */
    public function getStatus(int $id): bool
    {
        return $this->db->get('users', ['id' => $id], ['is_blocked'])->is_blocked;
    }
}
