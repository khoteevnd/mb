<?php
/**
 * Created by PhpStorm.
 * User: Nikolya
 * Date: 03.07.2015
 * Time: 1:00.
 */
abstract class BaseCRUD
{
    private $DBH;


    public function __construct()
    {
        $this->DBH = DatabaseHandler::GetHandler();
    }

    public function __set($name)
    {
    }
}
