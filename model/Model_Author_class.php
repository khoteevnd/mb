<?php

class Author
{
    private $author_id;
    private $name;
    private $login;
    private $pass;
    private $logo;

    public function __construct($params = null)
    {
        $this->setAll($params);
    }

    public function setAll($params)
    {
        if (!empty($params) and is_array($params)) {
            if (isset($params['author_id'])) {
                $this->author_id = $params['author_id'];
            }
            if (isset($params['name'])) {
                $this->name = $params['name'];
            }
            if (isset($params['login'])) {
                $this->login = $params['login'];
            }
            if (isset($params['pass'])) {
                $this->pass = $params['pass'];
            }
            if (isset($params['logo'])) {
                $this->logo = $params['logo'];
            }

            return true;
        }

        return false;
    }

    public function getAll()
    {
        $result = [];
        $result = $this->author_id;
        $result = $this->name;
        $result = $this->login;
        $result = $this->pass;
        $result = $this->logo;

        return $result;
    }

    public function getOneAuthor($login, $pass)
    {
        $loginArr[] = $login;
        $sql = 'SELECT * FROM authors WHERE login = ?';
        $params = DatabaseHandler::GetRow($sql, $loginArr);
        //var_dump($params);exit;
        if ((isset($params['login']) and $params['login'] == $login) and (isset($params['pass']) and $params['pass'] == $pass)) {
            //var_dump($params);exit;
            $this->setAll($params);

            return true;
        }

        return false;
    }

    public function addAuthor($params)
    {
        $paramsExecut = ['login' => '', 'pass' => ''];
        $paramsTemp = [];
        foreach ($params as $param => $value) {
            if (array_key_exists($param, $paramsExecut)) {
                $paramsTemp[$param] = $value;
            }
        }
        if (isset($date)) {
            $paramsExecut['pubdate'] = $date;
            $paramsTemp['pubdate'] = $date;
        }
        $fields = '';
        $values = '';
        $q = '';
        $fieldsValues = '';
        foreach ($paramsTemp as $param => $value) {
            $fields = $fields.$param.',';
            if (strpos($param, '_id') !== false) {
                $values[] = intval($value);
            } else {
                $values[] = $value;
            }
            $q = $q.'?'.',';
        }
        $fields = substr($fields, 0, -1);
        $q = substr($q, 0, -1);

        $sql = "INSERT INTO authors ($fields) VALUES($q)";
        DatabaseHandler::Execute($sql, $values);
    }

    public function editAuthor($params)
    {
        $sql = 'UPDATE authors SET logo = \''.$params['logo'].'\', name = \''.$params['name'].'\', pass = \''.$params['pass'].'\' WHERE author_id = \''.$params['author_id'].'\'';
        //var_dump($sql, $params);exit;
        return DatabaseHandler::Execute($sql);
    }

    public function getAllAuthors()
    {
        return $arr;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPass()
    {
        return $this->pass;
    }
}
