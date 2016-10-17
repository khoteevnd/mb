<?php

class Header extends BaseView
{
    public function __construct($records)
    {
        parent::__construct($records, PATH_VIEW_HEADER, 'header_tpl.php', false);
    }

    public function get()
    {
        return $this->view->render();
    }
}
