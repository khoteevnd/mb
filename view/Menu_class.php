<?php

class Menu extends BaseView
{
    public function __construct($records)
    {
        parent::__construct($records, PATH_VIEW_MENU, 'menu_tpl.php', false);
    }

    public function get()
    {
        return $this->view->render();
    }
}
