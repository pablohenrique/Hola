<?php

namespace Hola\DAO\postgresql;

class Connection {
    
    /*
    private static $DSN = 'pgsql:dbname=holadatabase;host=54.232.93.172';
    private static $USERNAME = 'root';
    private static $PASSWORD = '7V6EbwVC7F42984';
    */
    private static $DSN = 'pgsql:dbname=holadatabase;host=localhost';
    private static $USERNAME = 'postgres';
    private static $PASSWORD = 'postgres';
    private static $instance = null;
    private $con = null;

    private function __construct() {
        $this->con = new PDO(self::$DSN, self::$USERNAME, self::$PASSWORD);
    }

    public static function Instance() {
        if (self::$instance == null)
            self::$instance = new Connection();
        return self::$instance;
    }

    public function get() { return $this->con; }

}

?>
