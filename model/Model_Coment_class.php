<?php
class Coment {
    private $coment_id;
    private $parent;
    private $user_id;
    private $text;
    private $date;
    private $active;
    private $post_id;

    public function SortParentComentsByPost($post_id,$result)
    {
        if(empty($result))
        {
            return null;
        }
        $temp = array();
        $getCountAllLevel = $this->GetCountAllLevel($post_id);
        $countResult = count($result);
        $arr = $result;
        //var_dump($result);

        for($i = 0; $i <= $getCountAllLevel; $i++)
        {
            foreach($result as $key => $coment)
            {
                if($coment["levl"] == $i)
                {
                    $temp[$i][] = $coment;
                    unset($result[$key]);
                }
            }
        }

        //$arr = $temp;
//        echo "<pre>";
//            print_r($temp);
//        echo "</pre>";
        $countTemp = count($temp);

        for($i = $countTemp; $i>=0; $i--)
        {
            if($i >= 2)
            {
                foreach($temp[$i-1] as $key1 => $coment1)
                {
                    foreach($temp[($i-2)] as $key2 => $coment2)
                    {
                        if($coment1["parent"] == $coment2["coment_id"])
                        {
                            if(isset($coment1))
                            {
                                $temp[$i-2][$key2]["coments"][] = $coment1;
                            }
                        }
                    }
                }
            }
        }

        $temp2 = array_shift($temp);
        $countTemp2 = count($temp2);
        $map = "";

        $map = $this->RecursionByMap($temp2);
        $map = rtrim($map,",");
        $map = explode(",",$map);
        //var_dump($map,$temp2);die();

        $temp2 = $this->Sort($arr,$map);

        return $temp2;
    }
    public function Sort($arr,$map)
    {

        $map2 = array_flip($map);
        $a = 0;
        $b = 0;
        foreach($arr as $key1 => $val1)
        {
            foreach($map2 as $key2 => $val2)
            {
                if(intval($val1["coment_id"]) == $key2)
                {
                    $map2[$key2] = $val1;
                }
            }
        }
        return $map2;
    }
    public function RecursionByMap($arr)
    {
        $map2 = "";
            foreach($arr as $key => $value)
            {
                if($key === "coment_id")
                {
                   $map2 .= $value.",";
                }
                if(is_array($value))
                {
                    $map2 .= $this->RecursionByMap($value);
                }
            }
        return $map2;
    }
    public function GetCountOneLevel($post_id, $numberLevel)
    {
        $params[]= intval($post_id);
        $params[]= intval($numberLevel);

        $sql = 'SELECT count(levl)
                FROM coments
                WHERE post_id = ? and levl = ?';
        $arr = DatabaseHandler::GetOne($sql,$params);
        return $arr;
    }
    public function GetCountAllLevel($post_id)
    {
        $params[]= intval($post_id);
        $sql = 'SELECT MAX(levl)
        FROM coments
        WHERE post_id = ?';
        $arr = DatabaseHandler::GetOne($sql,$params);
        return $arr;
    }
    public function GetAllComentsByPost($post_id)
    {
        $params[]= intval($post_id);
        $sql = 'SELECT *
                FROM coments
                WHERE post_id = ?';
        $arr = DatabaseHandler::GetAll($sql,$params);

        $arr = $this->SortParentComentsByPost($post_id,$arr);
        return $arr;
    }
    public function GetAllComentsByField($fieldName,$fieldValue)
    {
        $sql = "SELECT *
                FROM coments
                WHERE $fieldName = ?";
        $arr = DatabaseHandler::GetAll($sql,$fieldValue);
        return $arr;
    }

    public function GetAllComentsByUser($user_id)
    {
        $params[]= intval($user_id);
        $sql = 'SELECT *
                FROM coments
                WHERE user_id = ?';
        $arr = DatabaseHandler::GetAll($sql, $params);
        return $arr;
    }
    public function GetOneComentsByUser($coment_id, $user_id)
    {
        $params[]= intval($coment_id);
        $params[]= intval($user_id);

        $sql = 'SELECT *
                FROM coments
                WHERE coment_id = ? AND $user_id = ?';
        $params[] = intval($coment_id);
        $params[] = intval($user_id);
        $arr = DatabaseHandler::GetRow($sql, $params);
        return $arr;
    }
    public function DellAllComentsByPost($post_id)
    {
        $params[]= intval($post_id);
        $sql = "DELETE FROM coments WHERE post_id= ?";
        DatabaseHandler::Execute($sql, $params);
    }
    public function AddComent($params)
    {
        $paramsExecut = array("parent"=>'',"user_id"=>'',"text"=>'',"date"=>'',"active"=>'',"post_id"=>'', "coment_id"=>'');
        $paramsTemp = array();
        $date = time();

        //var_dump($params);die();

        if(!empty($params['coment_id']))
        {

            foreach($params as $param => $value)
            {
                if(array_key_exists($param, $paramsExecut))
                {
                    $paramsTemp[$param] = $value;
                }
            }
            if(isset($date))
            {
                $paramsExecut["date"] = $date;
                $paramsTemp["date"] = $date;
            }
            if(!empty($paramsTemp["coment_id"]))
            {
                $paramsExecut["parent"] = $params["coment_id"];
                $paramsTemp["parent"] = $params["coment_id"];
                unset($paramsTemp["coment_id"]);
                //var_dump($paramsTemp);die();
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

            $sql = "INSERT INTO coments ($fields) VALUES($q)";
            DatabaseHandler::Execute($sql,$values);
        }
        else
        {
            foreach($params as $param => $value)
            {
                if(array_key_exists($param, $paramsExecut))
                {
                    $paramsTemp[$param] = $value;
                }
            }
            if(isset($date))
            {
                $paramsExecut["date"] = $date;
                $paramsTemp["date"] = $date;
            }
            $fields = "";
            $values = "";
            $q = "";
            $fieldsValues = "";
            foreach($paramsTemp as $param => $value)
            {

                $fields = $fields.$param.",";
                $values[] = $value;
                $q = $q."?".",";
            }
            $fields = substr($fields, 0, -1);
            $q = substr($q, 0, -1);

            $sql = "INSERT INTO coments ($fields) VALUES($q)";
            DatabaseHandler::Execute($sql,$values);
        }
    }
}