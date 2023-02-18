<?php
require_once __DIR__ . '/config.php';

class Koneksi {

    public static $connection;

    public static function getConnection() {
        if (self::$connection == null) {
            self::$connection = new \PDO("mysql:host=" . Config::$host . ";dbname=" . Config::$database, Config::$username, Config::$password);
        }
        return self::$connection;
    }
}