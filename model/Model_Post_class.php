<?php
class Post {
    /**
     * @param mixed $author_id
     */
    public function setauthor_id($author_id){
        $this->author_id = $author_id;
    }
    /**
     * @return mixed
     */
    public function getauthor_id(){
        return $this->author_id;
    }
    /**
     * @param mixed $post_id
     */
    public function setpost_id($post_id){
        $this->post_id = $post_id;
    }
    /**
     * @return mixed
     */
    public function getpost_id(){
        return $this->post_id;
    }
    /**
     * @param mixed $pubdate
     */
    public function setpubdate($pubdate){
        $this->pubdate = $pubdate;
    }
    /**
     * @return mixed
     */
    public function getpubdate(){
        return $this->pubdate;
    }
    /**
     * @param mixed $text
     */
    public function settext($text){
        $this->text = $text;
    }
    /**
     * @return mixed
     */
    public function gettext(){
        return $this->text;
    }
    /**
     * @param mixed $title
     */
    public function settitle($title){
        $this->title = $title;
    }
    /**
     * @return mixed
     */
    public function gettitle(){
        return $this->title;
    }
    /**
     *  @var type int
     */
    private $post_id;
    private $title;
    private $text;
    private $pubdate;
    private $author_id;

    public function __construct($params = null){
        if(!empty($params) and is_array($params)){
            if(isset($params['post_id']))
                $this->post_id = $params['post_id'];
            if(isset($params['title']))
                $this->title = $params['title'];
            if(isset($params['text']))
                $this->text = $params['text'];
            if(isset($params['pubdate']))
                $this->pubdate = $params['pubdate'];
            if(isset($params['author_id']))
                $this->author_id = $params['author_id'];
        }
        // или использовать автоподстановку через метод сет
        //        if(!empty($params) and is_array($params))
        //        {
        //            $vars = self::VarClass();
        //            foreach($vars as $varsKey=>$varsVal)
        //            {
        //                if(array_key_exists($varsKey,$params))
        //                {
        //                    $funcName = "set".$varsKey;
        //                    $this->$funcName($params[$varsKey]);
        //                }
        //            }
        //        }
    }
    private static function VarClass(){
        return get_class_vars(__CLASS__);
    }
    public function GetAllPosts(){
        $sql = 'SELECT posts.*, COUNT(coments.coment_id) as coments, authors.author_id, authors.login, authors.logo, authors.name
                FROM posts
                LEFT JOIN coments ON posts.post_id = coments.post_id
                LEFT JOIN authors ON posts.author_id = authors.author_id
                GROUP BY posts.post_id
                ORDER BY pubdate DESC
                ';
        $arr = DatabaseHandler::GetAll($sql);
        return $arr;
    }
    public function GetOnePost($post_id){
        $params[] = $post_id;
        $sql = 'SELECT * FROM (SELECT * FROM posts WHERE post_id = ?) as t_posts
                LEFT JOIN authors ON t_posts.author_id = authors.author_id;';
        $arr = DatabaseHandler::GetRow($sql,$params);
        return $arr;
    }
    public function GetAllPostByAuthor($author_id){
        $params[] = $author_id;
        $sql = 'SELECT posts.*, COUNT(coments.coment_id) as coments, authors.author_id, authors.login, authors.logo, authors.name
                FROM posts
                LEFT JOIN coments ON posts.post_id = coments.post_id
                LEFT JOIN authors ON posts.author_id = authors.author_id
                WHERE posts.author_id = ?
                GROUP BY posts.post_id
                ORDER BY pubdate DESC;
                ';
        $arr = DatabaseHandler::GetAll($sql,$params);
        return $arr;
    }
    public function DellPost($post_id){
        $params[] = $post_id;
        $sql = 'DELETE FROM posts WHERE post_id= ?';
        DatabaseHandler::Execute($sql,$params);
    }
    public function UpdatePost(){
        $sql = 'UPDATE posts SET title = \''.$this->title.'\', text = \''.$this->text.'\' WHERE post_id = \''.$this->post_id.'\'';
        DatabaseHandler::Execute($sql);
    }
    public function AddPost($params){
        $date = date("Y-m-d H:i:s", time());
        $paramsExecut = array("post_id"=>'',"title"=>'',"text"=>'',"pubdate"=>'',"author_id"=>'');
        $paramsTemp = array();
        foreach($params as $param => $value){
            if(array_key_exists($param, $paramsExecut)){
                $paramsTemp[$param] = $value;
            }
        }
        if(isset($date)){
            $paramsExecut["pubdate"] = $date;
            $paramsTemp["pubdate"] = $date;
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

        $sql = "INSERT INTO posts ($fields) VALUES($q)";
        DatabaseHandler::Execute($sql,$values);
    }
}