<?php
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
        $dsn =  sprintf("mysql:host=%s;dbname=%s",host,dbname); // Construct the Data Source Name (DSN)
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
     * @param string $sql The SQL query to prepare.
     * @return void
     */
    public function query(string $sql): void
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Bind a parameter to the specified value and type.
     *
     * @param mixed $param The parameter identifier.
     * @param mixed $value The value to bind to the parameter.
     * @param int $type (optional) The PDO parameter type.
     *
     * @return void
     */
    public function bind(mixed $param, mixed $value, $type = null): void
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Execute a prepared statement.
     *
     * @return bool True on success, false on failure.
     */
    public function execute(): bool
    {
        return $this->stmt->execute();
    }

    /**
     * Return a result set as an array of objects.
     *
     * @return array|false An array of objects representing the result set, or false on failure.
     */
    public function resultSet(): array|false
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Return a single row as an object.
     *
     * @return object|false The next row from the result set, or false if no rows are left.
     */
    public function single(): object|false 
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get the number of rows affected by the last SQL statement.
     *
     * @return int The number of rows affected.
     */
    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Alias of rowCount().
     *
     * @return int The number of rows affected.
     */
    public function affected_rows(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Get the SQLSTATE error code associated with the last operation on the statement handle.
     *
     * @return string The SQLSTATE error code.
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
        $str = "(" . implode(",", array_keys($data)) . ") VALUES('" . implode("','", array_values($data)) . "')";
        return $str;
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
     * Dynamically delete rows from db
     *
     * @param $table string
     * @param $condition array
     * 
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

        $this->query($query);
        try {
            $this->execute();
        } catch (Exception $e) {
            var_dump($e->getMessage());
            error_log($e->getMessage());
        }
        return $this->affected_rows();
    }

    /**
     * Dynamically retrive rows from db
     *
     * @param $table string
     * @param $condition array
     * 
     * @return mixed
     */
    public function get(string $table, array $condition, array $columns): mixed
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
        $row = $this->single();
        if ($row) {
            return $row;
        }
        return false;
    }

    /**
     * Dynamically retrive rows from db
     *
     * @param $table string
     * @param $data array
     * 
     * @return mixed
     */
    public function insert(string $table, array $data): mixed
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
        if ($this->affected_rows() == 0) {
            return false;
        }
        return true;

    }

    /**
     * Dynamically update rows from db
     *
     * @param $table string
     * @param $condition array
     * @param $data array
     * 
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
        $this->query($query);
        try {
            $this->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $this->affected_rows();

    }
}
