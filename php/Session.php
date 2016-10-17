<?php

class Session // implements ISession
{
    private static $Inst;


    private function __construct()
    {
        $this->setNameSession('myblog');
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public function isLoging()
    {
        if (!($this->get('loging')) and ($this->get('loging') != 'loging')) {
            return false;
        } else {
            return true;
        }
    }

    public static function getInstace()
    {
        if (!isset(self::$Inst)) {
            self::$Inst = new self();
        }

        return self::$Inst;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return false;
    }

    public function getAllParams()
    {
        if (isset($_SESSION) and !empty($_SESSION)) {
            return $_SESSION;
        }

        return false;
    }

    public function clear()
    {
        session_unset();
        session_destroy();
    }

    public function check($key)
    {
        if (!empty($_SESSION) and isset($_SESSION[$key])) {
            return true;
        }

        return false;
    }

    public function setNameSession($name)
    {
        session_name($name);
    }

    public function reid()
    {
        return session_regenerate_id();
    }

    public function getId()
    {
        return SID;
    }

    public function getNameSession()
    {
        return session_name();
    }
}
