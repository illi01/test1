<?php
class DbConnectionWrapper
{
    private $host, $dbName, $user, $pass;
    private $dbType, $port;

    public function __construct($dbType)
    {
        $this->dbType = DB_SETTING[$dbType]['dbType'];
        $this->port = DB_SETTING[$dbType]['port'];
        $this->host = DB_SETTING[$dbType]['host'];
        $this->dbName = DB_SETTING[$dbType]['dbName'];
        $this->user = DB_SETTING[$dbType]['user'];
        $this->pass = DB_SETTING[$dbType]['pass'];
    }

    public function getDbString()
    {
        return $this->dbType.':host='.$this->host.';port='.$this->port.';dbname='.$this->dbName.';user='.$this->user.';password='.$this->pass;
    }
}