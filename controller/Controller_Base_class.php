<?php
class Controller_Base
{
    protected $session;
    protected $params;
    protected $util;
    protected $html;
    protected $view;


    public function __construct($params){
        $this->session = Session::getInstace();
        $this->util = new Util();
        $this->params = $params;
        $this->html = new Html();

        $header = new Header($this->params);
        $this->html->add("header",$header->get());

        $menu = new Menu($this->params);
        $this->html->add("menu", $menu->get());

        $footer = new Footer($this->params);
        $this->html->add("footer", $footer->get());
    }

    public static function action404(){
        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
        die("404 Not Found");
    }
}