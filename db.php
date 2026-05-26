<?php
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'notebook');

$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()) {
    die('Ошибка подключения к БД: ' . mysqli_connect_error());
}

mysqli_set_charset($mysqli, 'utf8');
?>
