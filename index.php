<?php
    session_start();
    require __DIR__ . '/vendor/autoload.php';
    use Config\Db;
    use Route\Web;

    $controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'index';
    $actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

    $routing = new Web();
    $db = new Db();

    $routing->loadPage($db, $controllerName, $actionName);
