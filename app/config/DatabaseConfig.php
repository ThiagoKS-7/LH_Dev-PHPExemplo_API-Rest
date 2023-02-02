<?php

namespace Bee\Config;

class DatabaseConfig
{
    public static function getConfig($dbname)
    {
        $config = [];

        switch ($dbname) {
            
            case('bee'):
                $config = [
                    'host'     => getenv('DB_HOST'),
                    'port'     => getenv('DB_PORT'),
                    'dbname'   => getenv('DB_DATABASE'),
                    'username' => getenv('DB_USERNAME'),
                    'password' => getenv('DB_PASSWORD'),
                ];
                break;           
        }

        return $config;
    }
}