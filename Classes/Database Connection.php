<?php
class Database
{
    private static $dbName = 'caltax' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'osama123';
    private static $cont  = null;

    private function __construct() {
        die('Init function is not allowed');
    }

    public static function getConnection()
    {
        // One connection through whole application
        if (null == self::$cont){

            try{
                self::$cont = mysqli_connect(self::$dbHost,self::$dbUsername,self::$dbUserPassword,self::$dbName);
//                self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
//                self::$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//			   echo "Connected successfully";
            }
            catch(PDOException $e){
                die("Oops");
                echo "Connection failed: " . $e->getMessage();
            }

        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>
