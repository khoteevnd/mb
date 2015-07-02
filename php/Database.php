<?php

class DatabaseException extends Exception {}

class Database extends PDO
{
    public static $dbh = null;
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
    private $dns;
    /**
     * @return string
     */
    public function getDatabase()
    {
        return $this->database;
    }
    /**
     * @return string
     */
    public function getDns()
    {
        return $this->dns;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    function __construct()
    {
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'myblog';
        $this->user = 'root';
        $this->pass = '';
        $this->dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        parent::__construct($this->getDns(),$this->getUser(),$this->getPass());
    }
}
