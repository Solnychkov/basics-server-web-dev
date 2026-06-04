<?php

if (PHP_SAPI === 'cli-server') {
    $file = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($file)) {
        return false;
    }
}

require_once __DIR__ . '/../src/autoload.php';

use MyProject\Controllers\MainController;
use MyProject\Controllers\RecipeController;


$basePath = '';
if (!empty($_SERVER['DOCUMENT_ROOT'])) {
    $appDir = basename(dirname($_SERVER['DOCUMENT_ROOT']));
    if (preg_match('~^(lab\d+|course-work)$~', $appDir)) {
        $basePath = '/' . $appDir;
    }
}
define('BASE_PATH', $basePath);

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($basePath !== '' && strpos($url, $basePath) === 0) {
    $url = substr($url, strlen($basePath));
}
$url = trim($url, '/');

$routes = [
    '~^$~' => [MainController::class, 'home'],
    '~^recipes$~' => [RecipeController::class, 'index'],
    '~^recipes/(\d+)$~' => [RecipeController::class, 'show'],
    '~^admin$~' => [RecipeController::class, 'admin'],
    '~^admin/add$~' => [RecipeController::class, 'add'],
    '~^admin/(\d+)/edit$~' => [RecipeController::class, 'edit'],
    '~^admin/(\d+)/delete$~' => [RecipeController::class, 'delete'],
];

$found = false;
foreach ($routes as $pattern => $controllerAndAction) {
    if (preg_match($pattern, $url, $matches)) {
        $found = true;
        $controllerName = $controllerAndAction[0];
        $actionName = $controllerAndAction[1];

        $controller = new $controllerName();
        if (isset($matches[1])) {
            $controller->$actionName((int)$matches[1]);
        } else {
            $controller->$actionName();
        }
        break;
    }
}

if (!$found) {
    require_once __DIR__ . '/../templates/errors/404.php';
}
