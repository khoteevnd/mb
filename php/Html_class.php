<?php
class Html {
    private $html = array();

    public function add($key, $value)
    {
        $this->html[$key] = $value;
    }
    public function dell($key)
    {
        unset($this->html[$key]);
    }
    public function get($key)
    {
        return $this->html[$key];
    }
    public function getArray()
    {
        return $this->html;
    }
}