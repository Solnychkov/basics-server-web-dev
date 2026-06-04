<?php

require_once __DIR__ . '/../src/autoload.php';

use MyProject\Controllers\ArticleController;


$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
define('BASE_PATH', $basePath);

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($basePath !== '' && strpos($url, $basePath) === 0) {
    $url = substr($url, strlen($basePath));
}
$url = ltrim($url, '/');

$routes = [
    '~^articles/(\d+)$~' => [ArticleController::class, 'show'],
    '~^article/(\d+)/edit$~' => [ArticleController::class, 'edit'],
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
