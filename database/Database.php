<?php

class Database
{
    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        require './config/config.php';
        $dsn = 'mysql:host=' . host . ';dbname=' . dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        try {
            $this->dbh = new PDO($dsn, user, pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    /**
     *
     *
     * @param mixed $sql
     * @return void
     */
    public function query($sql): void
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Binds parameter according to this data type in query
     *
     * @param mixed $param
     * @param mixed $value
     * @param mixed $type
     * @return void
     */
    public function bind($param, $value, $type = null)
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
     * Performs query execution in DB
     *
     * @return mixed
     */
    public function execute(): mixed
    {
        return $this->stmt->execute();
    }

    /**
     * Return all the rows matches the query
     *
     * @return mixed
     */
    public function resultSet(): mixed
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Return first row which matches the query
     *
     * @return mixed
     */
    public function single(): mixed
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Return number of rows after query execution
     *
     * @return mixed
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    /**
     * Return number of rows affted after sql query execution
     *
     * @return mixed
     */
    public function affected_rows()
    {
        return $this->stmt->rowCount();
    }

    /**
     * Return sql error code
     *
     * @return mixed
     */
    public function errorCode()
    {
        return $this->stmt->errorCode();
    }
}
