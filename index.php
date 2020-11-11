<?php
require 'vendor\autoload.php';
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

include 'config.php';

$env = new Env($_GET['action']);
echo $env->createWebPage();
