<?php

/**
 * This file contains database actions
 * 
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 9/5/2024
 */

require './config/config.php'; // Include the database configuration file

class Database
{
    private $dbh;
    private $stmt;
    private $error;

    /**
     * Constructor method.
     * Initializes the database connection.
     */
    public function __construct()
    {
        $dsn = sprintf("mysql:host=%s;dbname=%s", host, dbname); // Construct the Data Source Name (DSN)
        $options = array(
            PDO::ATTR_PERSISTENT => true, // Enable persistent connections
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Set error mode to exceptions
        );

        try {
            $this->dbh = new PDO($dsn, user, pass, $options); // Create a new PDO instance
        } catch (PDOException $e) {
            error_log($e->getMessage()); //Logs error
        }
    }

    /**
     * Prepare a SQL query.
     *
     * @param string $sql
     * 
     * @return void
     */
    public function query(string $sql): void
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Execute a prepared statement.
     *
     * @return bool
     */
    public function execute(): bool
    {
        return $this->stmt->execute();
    }

    /**
     * Return a result set as an array of objects.
     *
     * @return array|false
     */
    public function resultSet(): array|false
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Return a single row as an object.
     *
     * @return object|false
     */
    public function single(): object|false
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get the number of rows affected by the last SQL statement.
     *
     * @return int
     */
    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Alias of rowCount().
     *
     * @return int
     */
    public function affected_rows(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Get the SQLSTATE error code associated with the last operation on the statement handle.
     *
     * @return string
     */
    public function errorCode(): string
    {
        return $this->stmt->errorCode();
    }

    /**
     * Converts array into sql insert statements
     *
     * @param $data array
     * 
     * @return string
     */
    public function arrayToInsert(array $data): string
    {
        return "(" . implode(",", array_keys($data)) . ") VALUES('" . implode("','", array_values($data)) . "')";
    }

    /**
     * Converts array of column names into sql format column parameter
     *
     * @param array $columns
     * 
     * @return string
     */
    public function arrayToColumns(array $columns): string
    {
        return "(" . implode(",", $columns) . ")";
    }

    /**
     * Converts array into sql set statements
     *
     * @param $data array
     * 
     * @return string
     */
    public function setValues(array $data): string
    {
        $str = "SET ";
        foreach ($data as $key => $value) {
            $str .= $key . "= '" . $value . "' ,";
        }

        return substr($str, 0, strlen($str) - 1);
    }

    /**
     * Converts array into sql conditional statement
     *
     * @param $data array
     * 
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
     * Build delete query
     *
     * @param string $table
     * @param array $condition
     * 
     * @return string
     */
    private function buildDeleteQuery(string $table, array $condition): string
    {
        $sql = "DELETE FROM $table";

        if (!empty($condition)) {
            $conditionString = implode(' AND ', array_map(function ($key, $value) {
                return "$key = ?";
            }, array_keys($condition), $condition));

            $sql .= " WHERE $conditionString";
        }

        return $sql;
    }


    /**
     * Dynamically delete rows from db
     *
     * @param $table string
     * @param $condition array
     * 
     * @return bool
     */
    public function delete(string $table, array $condition): bool
    {
        $sql = $this->buildDeleteQuery($table, $condition);
        $stmt = $this->dbh->prepare($sql);
        if (!empty($condition)) {
            $stmt->execute(array_values($condition));
        } else {
            $stmt->execute();
        }

        return $stmt->rowCount();
    }



    /**
     * Dynamically retrive rows from db
     *
     * @param $table string
     * @param $condition array
     * 
     * @return bool|object
     */
    public function get(string $table, array $condition, array $columns): bool|object
    {
        if (!empty($columns)) {
            $query = "SELECT " . $this->arrayToColumns($columns) . " FROM $table ";
        } else {
            $query = "SELECT * FROM $table ";
        }
        if (is_array($condition)) {
            $query = $query . $this->arrayToCondition($condition);
        } else {
            $query = "SELECT * FROM $table";
        }
        $this->query($query);
        try {
            $this->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return $this->single();
    }

    /**
     * Get all records from a table based on conditions
     *
     * @param string $table The table name
     * @param array $condition The condition to filter the records
     * @param array $columns The columns to be selected
     * 
     * @return array The result set
     */
    public function getAll(string $table, array $condition, array $columns): array
    {
        if (!empty($columns)) {
            $query = "SELECT " . $this->arrayToColumns($columns) . " FROM $table ";
        } else {
            $query = "SELECT * FROM $table ";
        }
        if (is_array($condition)) {
            $query .= $this->arrayToCondition($condition);
        } else {
            $query = "SELECT * FROM $table";
        }
        $this->query($query);

        try {
            $this->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return $this->resultSet();
    }

    /**
     * Dynamically retrive rows from db
     *
     * @param $table string
     * @param $data array
     * 
     * @return bool
     */
    public function insert(string $table, array $data): bool
    {
        $query = "INSERT INTO $table ";
        if (is_array($data)) {
            $query = $query . $this->arrayToInsert($data);
        }
        $this->query($query);
        try {
            $this->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return $this->affected_rows();
    }

    /**
     * Dynamically update rows from db
     *
     * @param $table string
     * @param $condition array
     * @param $data array
     * 
     * @return bool
     */
    public function update(string $table, array $data, array $condition): bool
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
        $this->query($query);
        try {
            $this->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return $this->affected_rows();
    }
}
