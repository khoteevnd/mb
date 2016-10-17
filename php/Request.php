<?php

class Request
{
    private static $sef_data = [];
    private $data;

    public function __construct()
    {
        $this->data = $this->xss(array_merge($_REQUEST, self::$sef_data));
    }

    public static function addSEFData($sef_data)
    {
        self::$sef_data = $sef_data;
    }

    public function __get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
    }

    private function xss($data)
    {
        if (is_array($data)) {
            $escaped = [];
            foreach ($data as $key => $value) {
                $escaped[$key] = $this->xss($value);
            }

            return $escaped;
        }

        return trim(htmlspecialchars($data));
    }

    public function isPost()
    {
        if (isset($_POST) and !empty($_POST)) {
            return true;
        }

        return false;
    }

    public function isGet()
    {
        if (isset($_GET) and !empty($_GET)) {
            return true;
        }

        return false;
    }

    public function isGetAndPost()
    {
        if ($this->isGet() and $this->isPost()) {
            return true;
        }

        return false;
    }

    public function getParams()
    {
        if ($this->isGetAndPost()) {
            $arr = array_merge($this->xss($_GET), $this->xss($_POST));

            return $arr;
        } elseif ($this->isGet()) {
            return $this->xss($_GET);
        } elseif ($this->isPost()) {
            return $this->xss($_POST);
        }
    }
}
