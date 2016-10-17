<?php

mb_internal_encoding('UTF-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'include.php';
$session = Session::getInstace();

$request = new Request();
$params = $request->getParams();

//Route::start();

$action = isset($params['action']) ? $params['action'] : 'index';

switch ($action) {
//START POSTS////////////////////////////////////////////////////////////////////////////////////////////////
    case 'index':
        $controller = new Controller_Post($params);
        $controller->actionIndex();
        break;
    case 'view-post':
        $controller = new Controller_Post($params);
        $controller->actionViewPost();
        break;
    case 'add-post':
        $controller = new Controller_Post($params);
        $controller->actionAddPost();
        break;
    case 'do-new-post':
        $controller = new Controller_Post($params);
        $controller->actionDoNewPost();
        break;
    case 'dell-post':
        $controller = new Controller_Post($params);
        $controller->actionDellPost();
        break;
    case 'edit-post':
        $controller = new Controller_Post($params);
        $controller->actionEditPost();
        break;
    case 'apply-edit-post':
        $controller = new Controller_Post($params);
        $controller->actionApplyEditPost();
        break;
    case 'view-author-posts':
        $controller = new Controller_Post($params);
        $controller->actionViewAuthorPost();
        break;
    case 'your-posts':
        $controller = new Controller_Post($params);
        $controller->actionYourPosts();
        break;
//STOP POSTS////////////////////////////////////////////////////////////////////////////////////////////////

//START COMENTS////////////////////////////////////////////////////////////////////////////////////////////////
    case 'add-coment':
        $controller = new Controller_Coment($params);
        $controller->actionAddComent();
        break;
    case 'do-new-coment':
        $controller = new Controller_Coment($params);
        $controller->actionDoNewComent();
        break;
//END COMENTS////////////////////////////////////////////////////////////////////////////////////////////////

//START LOGIN REGISTRATION////////////////////////////////////////////////////////////////////////////////////////////////
    case 'login':
        $controller = new Controller_Author($params);
        $controller->actionLogin();
        break;
    case 'author':
        $controller = new Controller_Author($params);
        $controller->actionAuhtor();
        break;
    case 'logout':
        $controller = new Controller_Author($params);
        $controller->actionLogout();
        break;
    case 'register':
        $controller = new Controller_Author($params);
        $controller->actionRegister();
        break;
    case 'new-register':
        $controller = new Controller_Author($params);
        $controller->actionNewRegister();
        break;
    case 'profile':
        $controller = new Controller_Author($params);
        $controller->actionProfile();
        break;
    case 'edit-profile':
        $controller = new Controller_Author($params);
        $controller->actionEditProfile();
        break;
    case 'apply-edit-profile':
        $controller = new Controller_Author($params);
        $controller->actionApplyEditProfile();
        break;
    default:
        Controller_Base::action404();
}
