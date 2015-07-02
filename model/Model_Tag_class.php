<?php
class Tag {
    private $tag_id;
    private $name;
    private $table_name;

    public function __construct($params){
        if(!empty($params) and is_array($params)){
            if(isset($params['tag_id']))
                $this->post_id = $params['tag_id'];
            if(isset($params['name']))
                $this->title = $params['name'];
        }
        $this->table_name = "tags";
    }
    public function getAllTag(){
        $sql = 'SELECT $this->table_name.*
                FROM $this->table_name
                ORDER BY pubdate DESC
                ';
        $arr = DatabaseHandler::GetAll($sql);
        return $arr;
    }
    public function getTagById($tag_id){
        $params[] = $tag_id;
        $sql = 'SELECT $this->table_name.*
                FROM $this->table_name
                WHERE tag_id = ?
                ';
        $arr = DatabaseHandler::GetRow($sql, $params);
        return $arr;
    }
    public function addTag($params){
        $date = date("Y-m-d H:i:s", time());
        $paramsExecut = array("tag_id"=>'',"name"=>'');
        $paramsTemp = array();
        foreach($params as $param => $value){
            if(array_key_exists($param, $paramsExecut)){
                $paramsTemp[$param] = $value;
            }
        }
        $fields = "";
        $values = "";
        $q = "";
        $fieldsValues = "";
        foreach($paramsTemp as $param => $value){
            $fields = $fields.$param.",";
            if(strpos($param, "_id") !== false){
                $values[] = intval($value);
            }else{
                $values[] = $value;
            }
            $q = $q."?".",";
        }
        $fields = substr($fields, 0, -1);
        $q = substr($q, 0, -1);
        $sql = "INSERT INTO $this->table_name ($fields) VALUES($q)";
        DatabaseHandler::Execute($sql,$values);
    }
    public function dellTag($tag_id){
        $params[] = $tag_id;
        $sql = "DELETE FROM $this->tags WHERE tag_id= ?";
        DatabaseHandler::Execute($sql,$params);
    }
    public function updateTag($tag_id, $name){
        $params[] = $name;
        $params[] = $post_id;
        $sql = "UPDATE $this->tags SET name = ? WHERE post_id = ?";
        DatabaseHandler::Execute($sql, $params);
    }
}