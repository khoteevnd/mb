<?php

class Util
{
    public function redirect($url)
    {
        header("location: $url");
        die();
    }

    public function redirectSelf()
    {
        $u = $_SERVER['REQUEST_URI'];
        $this->redirect($u);
    }
}
