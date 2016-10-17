<?php

class View
{
    protected $records;
    protected $path;
    protected $fileName;
    protected $render;

    public function __construct($records = null, $path = '', $fileName = '', $render = false)
    {
        $this->records = $records;
        $this->path = $path;
        $this->fileName = $fileName;
        $this->render = $render;
    }

    public function render()
    {
        $records = $this->records;
        $template = $this->path.$this->fileName;
        ob_start();
        if ($records != null) {
            extract($records);
        }
        include $template;
        if (!$this->render) {
            return ob_get_clean();
        } else {
            echo ob_get_clean();
        }
    }
}
