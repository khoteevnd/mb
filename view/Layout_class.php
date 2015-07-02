<?php
class Layout extends BaseView{

    public function __construct($records){
        parent::__construct($records, PATH_VIEW_LAYOUT,"layout_tpl.php", true);
    }

    public function get(){
        return $this->view->render();
    }
}