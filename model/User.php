<?php
class User
{
    private static  $Inst;
    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}
    private function __sleep(){}

    private $user_id;
    private $name;
    private $email;
    private $ban;

    public static function getInstace()
    {
        if(!isset(self::$Inst))
        {
            self::$Inst = new User();
        }
        return self::$Inst;
    }

    public static function GetAllUsers()
    {
        $sql = 'SELECT * FROM users';
        return DatabaseHandler::GetAll($sql);
    }

    public static function GetOneUserById($user_id)
    {
        $sql = 'SELECT * FROM users WHERE user_id = ?';
        return DatabaseHandler::GetRow($sql,$user_id);
    }

    public static function AddUser($params)
    {
        //var_dump($params);die();
        $paramsExecut = array("name"=>'',"email"=>'',"ban"=>'');
        $paramsTemp = array();
        foreach($params as $param => $value)
        {
            if(array_key_exists($param, $paramsExecut))
            {
                $paramsTemp[$param] = $value;
            }
        }
        if(isset($date))
        {
            $paramsExecut["pubdate"] = $date;
            $paramsTemp["pubdate"] = $date;
        }
        $fields = "";
        $values = "";
        $q = "";
        $fieldsValues = "";
        foreach($paramsTemp as $param => $value)
        {

            $fields = $fields.$param.",";
            if(strpos($param, "_id") !== false){
                $values[] = intval($value);
            }
            else {
                $values[] = $value;
            }
            $q = $q."?".",";
        }
        $fields = substr($fields, 0, -1);
        $q = substr($q, 0, -1);

//        var_dump($params,$fields,$q,$values);die();

        $sql = "INSERT INTO posts ($fields) VALUES($q)";
        DatabaseHandler::Execute($sql,$values);
    }
    public static function DellUser($user_id)
    {
        $sql = 'DELETE FROM users WHERE post_id= ?';
        DatabaseHandler::Execute($sql,$user_id);
    }

    public static function UpdateUser($user_id)
    {
        $sql = 'UPDATE posts SET name = \''.$this->name.'\', email = \''.$this->email.'\' WHERE user_id = ?';
        DatabaseHandler::Execute($sql,$user_id);
    }
}