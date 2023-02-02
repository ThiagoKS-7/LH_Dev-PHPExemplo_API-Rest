<?php

namespace Bee\Libraries;

use Bee\Config\CoreConfig;
use Bee\Config\DatabaseConfig;

class DatabaseLibrary
{
    private static $conn = array();

    private function __construct()
    {
         
    }

    private static function getInstance($connection_name)
    {

        if ( ! isset(self::$conn[$connection_name])) {
            
            $config = DatabaseConfig::getConfig($connection_name);
        
            try {

                self::$conn[$connection_name] = new \PDO(
                    sprintf('mysql:host=%s:%s;dbname=%s;charset=utf8', $config['host'], $config['port'], $config['dbname']), $config['username'], $config['password'],
                    [
                        \PDO::ATTR_EMULATE_PREPARES => true,
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET time_zone = \'-03:00\'',
                        \PDO::MYSQL_ATTR_FOUND_ROWS => true,
                    ]
                );

            } catch (\Exception $e) {
                
                $parameters = [
                    'connection_name' => $connection_name
                    , 'connection_host' => $config['host']
                    , 'connection_port' => $config['port']
                    , 'connection_schema' => $config['dbname']
                ];
                
                CoreConfig::showErrorsIfNotInProd($e);

            }
        }

        return self::$conn[$connection_name];
    }

    public static function insert($connection_name, $sql, $parameters = [])
    {
        try {

            $conn = self::getInstance($connection_name);
            $q = $conn->prepare($sql);
            $q->execute($parameters);
            
            return $conn->lastInsertId();

        } catch (\Exception $e) {
            
            CoreConfig::showErrorsIfNotInProd($e);

        }

        return false;

    }

    public static function update($connection_name, $sql, $parameters = [])
    {
        try {
            
            $conn = self::getInstance($connection_name);
            $q = $conn->prepare($sql);
            $f = $q->execute($parameters);

            return $f;

        } catch (\Exception $e) {

            CoreConfig::showErrorsIfNotInProd($e);

        }

        return false;

    }

    public static function closeConnection($connection_name)
    {
        if (isset(self::$conn[$connection_name])) {
            return self::$conn[$connection_name] = null;
        }

        return false;
    }

    public static function select($connection_name, $sql, $parameters = [])
    {
        try {

            $conn = self::getInstance($connection_name);
            $q = $conn->prepare($sql);
            $q->execute($parameters);
            $ret = $q->fetchAll(\PDO::FETCH_ASSOC);
            
            return count($ret) > 0 ? $ret : false;

        } catch (\Exception $e) {

            CoreConfig::showErrorsIfNotInProd($e);

        }

        return false;
    }
}
