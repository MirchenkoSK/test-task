<?php

namespace App\Components;

class Database
{
    public static function getConnection()
    {
        $params = [
            'host' => 'localhost',
			'dbname' => 'beejee',
			'user' => 'root',
			'password' => 'wwwrst',
        ];

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new \PDO($dsn, $params['user'], $params['password']);

        return $db;
    }
}