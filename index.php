<?php
require 'vendor\autoload.php';
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

include 'config.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$env = new Env($action);

echo $env->createWebPage();
