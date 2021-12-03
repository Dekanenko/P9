<?php

namespace route;

use App\Controllers\UsersController;
use App\Controllers\IndexController;
use App\Controllers\RolesController;

class Web{
   function loadPage($db, $controllerName, $actionName = 'index'){
       switch ($controllerName) {
            case 'users':
                $controller = new UsersController($db);
                break;
            case 'roles':
                $controller = new RolesController($db);
                break;
            default:
                $controller = new IndexController($db);
       }
       $controller->$actionName();
   }
}
