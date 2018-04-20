<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 20/4/2018
 * Time: 2:18 AM
 */
require __DIR__ . '/Config.php';

class PdoFactory
{
    public static function build()
    {
        try {
            $dbConfig = self::getConfig();
            return new PDO(self::getDsn(), $dbConfig->username, $dbConfig->password);
        } catch (PDOException $e) {
            echo "Error PDOException: " . $e->getMessage();
            die();
        }
    }

    private static function getConfig()
    {
        return (new Config())->db;
    }

    private static function getDsn()
    {
        $dbConfig = self::getConfig();
        return "pgsql:host=" . $dbConfig->host . ";dbname=" . $dbConfig->databasename;
    }
}