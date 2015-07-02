<?php
//Validation rules
define("NO_CHAR", '~`!@#$%^&*()+={}[]\|/<>?,.":;№');
define("MIN_LEN", 3);

//Database
define('DB_PERSISTENCY', 'true');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'myblog');
define('PDO_DSN', 'mysql:host=' . DB_SERVER . ';dbname=' . DB_DATABASE);

// Задаем константы:
define('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
$sitePath = realpath(dirname(__FILE__) . DS);
define('SITE_PATH', $sitePath); // путь к корневой папке сайта
define('PATH_VIEW', "view/");
define('PATH_VIEW_POSTS', "view/posts/");
define('PATH_VIEW_HEADER', "view/header/");
define('PATH_VIEW_FOOTER', "view/footer/");
define('PATH_VIEW_AUTHOR', "view/authors/");
define('PATH_VIEW_COMENT', "view/coments/");
define('PATH_VIEW_MENU', "view/menu/");
define('PATH_VIEW_TAG', "view/tags/");
define('PATH_VIEW_USERS', "view/user/");
define('PATH_VIEW_MESSAGE', "view/message/");
define('PATH_VIEW_LAYOUT', "view/layout/");



