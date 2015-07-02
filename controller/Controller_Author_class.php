<?php
class Controller_Author extends Controller_Base
{
    public function __construct($params)
    {
        parent::__construct($params);
    }
    public function actionLogin()
    {
        if($this->session->isLoging())
        {
            echo "Вы уже авторизированны!";
            exit;

        }
        $this->view = new View($this->params, PATH_VIEW_AUTHOR, "login_tpl.php", false);
        $this->html->add("content", $this->view->render());

        $layout = new Layout($this->html->getArray());
        $layout->get();
    }

    public function actionLogout()
    {
        $this->session->clear();
        $this->util->redirect("?action=index");
    }
    public function actionRegister()
    {
        if($this->session->isLoging())
        {
            echo "Вы уже зарегестрированный пользователь!";
            exit;
        }

        $this->view = new View($this->params, PATH_VIEW_AUTHOR, "register_tpl.php", false);
        $this->html->add("content", $this->view->render());

        $layout = new Layout($this->html->getArray());
        $layout->get();
    }
    public function actionAuhtor()
    {
        if($this->session->isLoging())
        {
            echo "Вы уже авторизированны!";
            exit;
        }

        $Author = new Author();
        if($Author->getOneAuthor($this->params['login'],$this->params['pass']))
        {
            $this->session->set("loging", "loging");
            $this->session->set("author_id", $Author->getAuthorId());
            $this->session->set("login", $Author->getLogin());
            $this->session->set("pass", $Author->getPass());
            $this->session->set("logo", $Author->getLogo());
            $this->session->set("name", $Author->getName());
        }

        $this->view = new View($this->params, PATH_VIEW_MESSAGE, "welcom_tpl.php", false);
        $this->html->add("content", $this->view->render());

        $layout = new Layout($this->html->getArray());
        $layout->get();
    }
    public function actionProfile()
    {
        if(!$this->session->isLoging())
        {
            echo "Для просмотра профиля вы должны быть авторизированы";
            exit;
        }

        $this->view = new View($this->session->getAllParams(), PATH_VIEW_AUTHOR, "profile_tpl.php", false);
        $this->html->add("content", $this->view->render());

        $layout = new Layout($this->html->getArray());
        $layout->get();
    }
    public function actionEditProfile()
    {
        $this->view = new View($this->session->getAllParams(), PATH_VIEW_AUTHOR, "edit-profile_tpl.php", false);
        $this->html->add("content", $this->view->render());

        $layout = new Layout($this->html->getArray());
        $layout->get();
    }
    public function actionApplyEditProfile()
    {
        if(!$this->session->isLoging())
        {
            echo "Для просмотра профиля вы должны быть авторизированы";
            exit;
        }
        if(isset($this->params['pass_old']) and $this->params['pass_old'] === $this->session->get("pass"))
        {
            $this->params['logo'] = "img/logo/".$_FILES["logo"]["name"];
            $this->params['author_id'] = $this->session->get("author_id");
            if($this->params['pass_new'] === $this->params['pass_new_conf'])
            {
                $this->params['pass'] = $this->params['pass_new'];
            }
            else
            {
                echo ("Новые пароли не совпадают");
                exit;
            }
            $Author = new Author();
            $Author->editAuthor($this->params);

            if($_FILES["logo"]["size"] > 0)
            {
                if($_FILES["logo"]["size"] > 1024*3*1024)
                {
                    echo ("Размер файла превышает три мегабайта");
                    exit;
                }
                if(is_uploaded_file($_FILES["logo"]["tmp_name"]))
                {
                    move_uploaded_file($_FILES["logo"]["tmp_name"], __DIR__."/img/logo/".$_FILES["logo"]["name"]);
                }
                else
                {
                    echo("Ошибка загрузки файла");
                    exit;
                }
                $_SESSION['logo'] = "img/logo/".$_FILES["logo"]["name"];
            }
            $util = new Util();
            $util->redirect("?action=profile");
        }
        else
        {
            echo "не совпадают";
            exit;
        }
    }

    public function actionNewRegister()
    {
        $Author = new Author();
        $Author->addAuthor($this->params);
        $this->util->redirect("?action=login");
    }
}
