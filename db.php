<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'notebook');

$mysqli = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$mysqli || mysqli_connect_errno()) {
    die('Ошибка подключения к БД: ' . mysqli_connect_error());
}

if (!mysqli_set_charset($mysqli, 'utf8mb4')) {
    mysqli_set_charset($mysqli, 'utf8');
}
mysqli_query($mysqli, "SET NAMES utf8mb4");
