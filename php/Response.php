<?php

class Response
{
    public function render($path, $records = null)
    {
        ob_start();
        if ($records != null) {
            extract($records);
        }
        include $path;
        $html = ob_get_clean();

        return $html;
    }
}
