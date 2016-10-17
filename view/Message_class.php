<?php

class Message extends BaseView
{
    private $message;

    public function __construct($records)
    {
        parent::__construct($records, PATH_VIEW_MESSAGE, 'message_tpl.php', false);
    }

    public function get()
    {
        return $this->view->render();
    }
}
