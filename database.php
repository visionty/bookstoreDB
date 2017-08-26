<?php
class Database
{
    private static $dbName = 'bookstore';
    private static $dbHost = 'localhost';
    private static $dbUsername = '';
    private static $dbUserPassword = '';
  //  pricate static $port = 1433;

    private static $cont = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect() {
        if (null === self::$cont) {
            try {
                self::$cont =  new PDO('mssql:host='.self::$dbHost.'; dbname='.self::$dbName, self::$dbUsername, self::$dbUserPassword);
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect() {
        self::$cont = null;
    }
}