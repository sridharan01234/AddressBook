<?php
// Including the Database class file
require_once '../Config/Database.php';

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Converts array into sql insert statements
     *
     * @param data array
     * @return string
     */
    public function arrayToInsert(array $data): string
    {
        $str = "(".implode(",", array_keys($data)).") VALUES('".implode("','", array_values($data))."')";
        return $str;
    }

    public function arrayToColumns($columns)
    {
        return "(".implode(",", $columns).")";
    }

    /**
     * Converts array into sql set statements
     *
     * @param data array
     * @return string
     */
    public function setValues(array $data): string
    {
        $str = "SET ";
        foreach ($data as $key => $value) {
            $str .= $key ."= '". $value ."' ,";
        }
        return substr($str,0,strlen($str) -1);
    }

    /**
     * Converts array into sql conditional statement
     *
     * @param data array
     * @return string
     */
    public function arrayToCondition(array $data): string
    {
        $str = "WHERE ";
        foreach ($data as $key => $value) {
            if ($key == "condition") {
                $str = $str . " $value ";
                continue;
            }
            $str = $str . $key . "=" . "'" . $value . "'";
        }
        return $str;
    }

    /**
     * Dynamically delete rows from db
     *
     * @param table string
     * @param condition array
     * @return mixed
     */
    public function delete(string $table, array $condition): mixed
    {
        $query = "DELETE FROM $table ";
        if (is_array($condition)) {
            $query = $query . $this->arrayToCondition($condition);
        } else {
            $query = "DELETE FROM $table";
        }

        $this->db->query($query);
        try {
            $this->db->execute();
        } catch (Exception $e) {
            var_dump($e->getMessage());
            error_log($e->getMessage());
        }
        return $this->db->affected_rows();
    }
    /**
     * Dynamically retrive rows from db
     *
     * @param table string
     * @param condition array
     * @return mixed
     */
    public function getAll(string $table, array|string $condition, array|string $columns): mixed
    {
        if(is_array($columns)) {
            $query = "SELECT ".$this->arrayToColumns($columns)." FROM $table ";
        }
        else {
            $query = "SELECT $columns FROM $table ";
        }
        if (is_array($condition)) {
            $query = $query . $this->arrayToCondition($condition);
        } else {
            $query = "SELECT * FROM $table";
        }
        $this->db->query($query);
        $row = $this->db->resultSet();
        if ($row) {
            return $row;
        }
        return false;
    }
    /**
     * Dynamically retrive rows from db
     *
     * @param table string
     * @param condition array
     * @return mixed
     */
    public function get(string $table, array $condition, array|string $columns): mixed
    {
        if(is_array($columns)) {
            $query = "SELECT ".$this->arrayToColumns($columns)." FROM $table ";
        }
        else {
            $query = "SELECT $columns FROM $table ";
        }
        if (is_array($condition)) {
            $query = $query . $this->arrayToCondition($condition);
        } else {
            $query = "SELECT * FROM $table";
        }
        $this->db->query($query);
        $row = $this->db->single();
        if ($row) {
            return $row;
        }
        return false;
    }

    /**
     * Dynamically insert rows from db
     *
     * @param table string
     * @param data array
     * @return mixed
     */
    public function insert(string $table, array $data,int $id)
    {
        $data['id'] = $id;
        $query = "INSERT INTO $table ";
        if (is_array($data)) {
            $query = $query . $this->arrayToInsert($data);
        }
        $this->db->query($query);
        try {
            $this->db->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        if($this->db->affected_rows() == 0) {
            if($this->db->errorCode() == 23000) {
                $this->insert($table, $data,++$id);
            }
        }
        return $id;
    }

    /**
     * Dynamically update rows from db
     *
     * @param table string
     * @param condition array
     * @param data array
     * @return mixed
     */
    public function update(string $table, array $data, array $condition): mixed
    {
        $query = "UPDATE $table ";
        if (is_array($data)) {
            $query = $query . $this->setValues($data);
        } else {
            return false;
        }
        if (is_array($condition)) {
            $query = $query . $this->arrayToCondition($condition);
        } 
        $this->db->query($query);
        try {
            $this->db->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $this->db->affected_rows();

    }
}