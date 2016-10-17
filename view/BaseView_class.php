<?php

class BaseView
{
    protected $view;

    public function __construct($records, $path, $fileName, $render)
    {
        $this->view = new View($records, $path, $fileName, $render);
    }

    public function get()
    {
        return $this->view->render();
    }
}
