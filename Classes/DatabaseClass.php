<?php

class Database {

    public static $conn;

    public static function connect ($host, $database, $user, $pass, $charset = 'utf8') {
            self::$conn = new \PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=' . $charset, $user, $pass);
            self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 
    }

}