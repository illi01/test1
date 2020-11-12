<?php
define('DIR_ROOT', __DIR__);
define('DIR_TEMPLATES', __DIR__ . '\templates\\');
define('DB_SETTING', array(
    'PostgreSQL' => array(
        'dbType' => 'pgsql',
        'port' => '5432',
        'dbName' => 'articledb',
        'user' => 'postgres',
        'pass' => 'postgres',
        'host' => 'localhost'
        )
    )
);