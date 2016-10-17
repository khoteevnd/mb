<?php

class Footer extends BaseView
{
    public function __construct($records)
    {
        parent::__construct($records, PATH_VIEW_FOOTER, 'footer_tpl.php', false);
    }

    public function get()
    {
        return $this->view->render();
    }
}
