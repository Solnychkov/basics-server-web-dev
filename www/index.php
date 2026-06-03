<?php

require_once __DIR__ . '/../src/autoload.php';

use MyProject\Controllers\MainController;

$url = $_SERVER['REQUEST_URI'];

$routes = [
    '~^/hello/(.+)$~' => [MainController::class, 'sayHello'],
    '~^/bye/(.+)$~' => [MainController::class, 'sayBye'],
];

foreach ($routes as $pattern => $controllerAndAction) {
    if (preg_match($pattern, $url, $matches)) {
        $controllerName = $controllerAndAction[0];
        $actionName = $controllerAndAction[1];

        $controller = new $controllerName();
        $controller->$actionName($matches[1]);
        break;
    }
}
