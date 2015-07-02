<?php
class Controller_Post extends Controller_Base{
    public function __construct($params){
        parent::__construct($params);
    }

    public function actionIndex()
    {
        $post = new Post();
        $records = $post->GetAllPosts();

        $this->view = new View($records, PATH_VIEW_POSTS, "index_tpl.php", false);
        $this->html->add("content", $this->view->render());

        $layout = new Layout($this->html->getArray());
        $layout->get();
    }
    public function actionViewPost()
    {
        $records_posts_coments = array();
        $records_posts = array();
        $records_coments = array();

        $post = new Post();
        $records_posts = $post->GetOnePost($this->params['id']);

        $coment = new Coment();
        $records_coments = $coment->GetAllComentsByPost($this->params["id"]);
        $records_coments = $coment->SortParentComentsByPost($this->params["id"],$records_coments);

        $records_posts_coments['records_posts'] = $records_posts;
        $records_posts_coments['records_coments'] = $records_coments;

        $this->view = new View($records_posts_coments, PATH_VIEW_POSTS, "post_tpl.php", false);
        $this->html->add("content", $this->view->render());

        $layout = new Layout($this->html->getArray());
        $layout->get();

    }
    public function actionYourPosts()
    {
        if($this->session->get("author_id"))
        {

            $post = new Post();
            $records = $post->GetAllPostByAuthor($this->session->get("author_id"));

            if(empty($records))
            {
                $message = new Message("У вас пока нет постов!");
                $this->html->add("content", $message->get());

                $layout = new Layout($this->html->getArray());
                $layout->get();
            }
            else
            {
                $this->view = new View($records, PATH_VIEW_POSTS, "index_tpl.php", false);
                $this->html->add("content", $this->view->render());

                $layout = new Layout($this->html->getArray());
                $layout->get();
            }
        }
    }

    public function actionViewAuthorPost()
    {
        if(isset($this->params["id"]) and !empty($this->params["id"]))
        {
            $post = new Post();
            $records = $post->GetAllPostByAuthor($this->params["id"]);

            $this->view = new View($records, PATH_VIEW_POSTS, "index_tpl.php", false);
            $this->html->add("content", $this->view->render());

            $layout = new Layout($this->html->getArray());
            $layout->get();
        }
    }

    public function actionAddPost()
    {
        $this->view = new View(null, PATH_VIEW_POSTS, "add-post_tpl.php", false);
        $this->html->add("content", $this->view->render());

        $layout = new Layout($this->html->getArray());
        $layout->get();
    }

    public function actionDoNewPost()
    {
        $post = new Post();
        $post->AddPost($this->params);
        $this->util->redirect($_SERVER["SCRIPT_NAME"]);
    }

    public function actionDellPost()
    {
        $coment = new Coment();
        $coment->DellAllComentsByPost($this->params['id']);

        $post = new Post();
        $post->DellPost($this->params['id']);

        $this->util->redirect($_SERVER["SCRIPT_NAME"]);
    }
    public function actionEditPost()
    {
        $post = new Post();
        $records = $post->GetOnePost($this->params['id']);

        $this->view = new View($records, PATH_VIEW_POSTS, "edit-post_tpl.php", false);
        $this->html->add("content", $this->view->render());

        $layout = new Layout($this->html->getArray());
        $layout->get();
    }

    public function actionApplyEditPost()
    {
        $post = new Post($this->params);
        $post->UpdatePost();

        $this->util->redirect(".");
    }
}