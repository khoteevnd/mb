<?php
class Controller_Coment extends Controller_Base{
    public function __construct($params){
        parent::__construct($params);

    }

    public function actionAddComent()
    {
        $this->view = new View($this->params, PATH_VIEW_COMENT, "add-coment_tpl.php", false);
        $html = $html.$this->view->render();

        $layout = new Layout($this->html->getArray());
        $layout->get();
    }

    public function actionDoNewComent()
    {
        $html = "";

        $coment = new Coment();
        $coment->AddComent($this->params);

        $this->util->redirect("?action=view-post&id=".intval($params['post_id']));

    }

    public function actionDellComent()
    {

    }

    public function actionEditComent()
    {

    }
}