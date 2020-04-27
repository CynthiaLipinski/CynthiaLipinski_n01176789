<?php

class Database {
    private static $username = 'root';
    private static $password = 'root';
    private static $dbname = 'bitewave';
    private static $dsn = 'mysql:host=localhost;dbname=bitewave';
    private static $dbcon;


    private function __construct()
    {
    }

    //static fucntion so that a database conntection can be created
    public static function GetDb(){
        try{
            if (!isset(self::$dbcon)) {
                self::$dbcon = new PDO(self::$dsn, self::$username, self::$password);
            }
        }
        catch (PDOException $e) {
            $msg = $e->getMessage();
            exit();
        }
        return self::$dbcon;
    }
}
?>
