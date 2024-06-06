<?php
session_start();
define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'ferreteria');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_PORT', '3306');


class Config
{
    function getImageSize()
    {
        return 1024000;
    }

    function getImageType()
    {
        return array('image/png', 'image/jpeg');
    }

    function getUploadsPath()
    {
        return __DIR__ . '/uploads/';
    }

    function getDBDriver()
    {
        return DB_DRIVER;
    }

    function getDBHost()
    {
        return DB_HOST;
    }

    function getDBName()
    {
        return DB_NAME;
    }

    function getDBUser()
    {
        return DB_USER;
    }

    function getDBPassword()
    {
        return DB_PASSWORD;
    }

    function getDBPort()
    {
        return DB_PORT;
    }

    function getConn()
    {
        return new PDO($this->getDBDriver() . ':port=' . $this->getDBPort() . ';host=' . $this->getDBHost() . ';dbname=' . $this->getDBName(), $this->getDBUser(), $this->getDBPassword());
    }
}
