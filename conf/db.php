<?php

/**
 * Configuration class of Data Base
 */

class DB {
    const USER = "root";
    const PASS = "";
    const HOST = "localhost";
    const DB = "pollDB";

    public static function connToDB() {
        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db = self::DB;

        $conn = new PDO("mysql:host=$host; dbname=$db; charset=UTF8", $user, $pass);
        return $conn;
    }
}