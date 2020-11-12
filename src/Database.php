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
        $wrapper = new DbConnectionWrapper(key(DB_SETTING));
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
            if ($res === false)
                die("Error executing the query: $query With Error:" . var_export($this->connection->errorInfo(),true));

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
        if ($row !== false) {
            foreach ($row as $columnName => $columnVal) {
                $data[$columnName] = htmlspecialchars($columnVal);
            }

            return $data;
        } else die("Error executing the query: $query With Error:" . var_export($this->connection->errorInfo(),true));
    }

    public function __destruct()
    {
        $this->connection = null;
    }

    public function escape($string)
    {
        switch (key(DB_SETTING)) {
            case 'PostgreSQL':
            default:
            $string = pg_escape_string($string);
        }
        return $string;
    }

    public function commit()
    {
        $this->connection->commit();
    }

    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }
}