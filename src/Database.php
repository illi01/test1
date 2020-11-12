<?php
class Database
{
    private $connection;

    public function __construct()
    {
        $this->connection = $this->connect();
    }

    public function connect()
    {
        try {
        $wrapper = new DbConnectionWrapper('PostgreSQL');
        $conn = new PDO($wrapper->getDbString());

        return $conn;

        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function exec($query)
    {
        try {
            $res = $this->connection->exec($query);
            if ($res !== false) {
                die("Error executing the query: $query With Error:" . var_export($this->connection->errorInfo(),true));
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function query($query)
    {

        $stmt = $this->connection->query($query);
        if($stmt === false){
            die("Error executing the query: $query With Error:" . var_export($this->connection->errorInfo(),true));
        }
        return $stmt;
    }

    public function selectAll($query)
    {
        $stmt = $this->query($query);
        $data = array();
        $count = 0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($row as $columnName => $columnVal) {
                $data[$count][$columnName] = htmlspecialchars($columnVal);
            }
            $count++;
        }
        return $data;
    }

    public function selectRow($query)
    {
        $stmt = $this->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $data = array();
        foreach ($row as $columnName => $columnVal) {
            $data[$columnName] = htmlspecialchars($columnVal);
        }

        return $data;
    }

    public function __destruct()
    {
        $this->connection = null;
    }   
}