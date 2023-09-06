<?php

class DataBase extends PDO
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = 'root';
    const DB_NAME = 'fpview';

    function __construct()
    {
        //error_log("appel construct DataBase");
        try {
            parent::__construct("mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME, self::DB_USER, self::DB_PASS);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }
}
