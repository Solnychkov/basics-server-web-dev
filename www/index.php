<?php

require_once __DIR__ . '/../src/autoload.php';

use MyProject\Controllers\ArticlesController;

$url = $_SERVER['REQUEST_URI'];

$routes = [
    '~^/articles/(\d+)$~' => [ArticlesController::class, 'show'],
];

foreach ($routes as $pattern => $controllerAndAction) {
    if (preg_match($pattern, $url, $matches)) {
        $controllerName = $controllerAndAction[0];
        $actionName = $controllerAndAction[1];

        $controller = new $controllerName();
        $controller->$actionName((int)$matches[1]);
        break;
    }
}
