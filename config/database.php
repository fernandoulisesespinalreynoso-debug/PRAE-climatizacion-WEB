<?php

function database_config(): array
{
    return [
        'host' => getenv('PRAE_DB_HOST') ?: '127.0.0.1',
        'port' => getenv('PRAE_DB_PORT') ?: '3306',
        'name' => getenv('PRAE_DB_NAME') ?: 'prae_climatizacion',
        'user' => getenv('PRAE_DB_USER') ?: 'root',
        'password' => getenv('PRAE_DB_PASSWORD') !== false
            ? getenv('PRAE_DB_PASSWORD')
            : '',
    ];
}

function db(): PDO
{
    static $connection = null;

    if ($connection instanceof PDO) {
        return $connection;
    }

    $config = database_config();
    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        $config['host'],
        $config['port'],
        $config['name']
    );

    $connection = new PDO(
        $dsn,
        $config['user'],
        $config['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    return $connection;
}
