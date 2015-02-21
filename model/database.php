<?php
class Database {
	
    private static $dsn = 'mysql:host=jibe.wikiplay.ca;dbname=jibe';
    private static $username = 'jibeuser';
    private static $password = 'jibe2015';
   //reference to db connection
    private static $db;

    
    private function __construct() {}

    //return reference to pdo object
    public static function getDB () {
    	
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('../errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }
}
?>