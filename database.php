<?php
class Database

{
    // db info
    private static $dbName = 'Amber';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'Amber';
    private static $dbUserPassword = 'fencys-qeGvus-zegfo4';

    private static $cont = null;

    public function __construct() {
        die("Init function is not allowed");
    }

    public static function connect() {
        //One connection through whole application
        if (null == self::$cont)
        {
            try {
                // a connection to the database is created via the PDO interface
                self::$cont = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername,
                self::$dbUserPassword);
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect() {
        self::$cont = null;
    }

}


?>