<?php
require_once 'db.php';
require_once 'menu.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'view';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lemonada&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <img src="logo.webp" alt="МосПолитех">
    <a href="index.php?action=view" class="<?= $action==='view'?'select':'' ?>">Просмотр</a>
    <a href="index.php?action=add"  class="<?= $action==='add' ?'select':'' ?>">Добавление записи</a>
    <a href="index.php?action=edit" class="<?= $action==='edit'?'select':'' ?>">Редактирование записи</a>
    <a href="index.php?action=delete" class="<?= $action==='delete'?'select':'' ?>">Удаление записи</a>
</header>

<?php
if ($action === 'view') {
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    echo getSubmenu($sort);
}
?>

<main>
<?php
if ($action === 'view') {
    require_once 'viewer.php';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    echo getViewer($mysqli, $sort, $page);
} elseif ($action === 'add') {
    require_once 'add.php';
} elseif ($action === 'edit') {
    require_once 'edit.php';
} elseif ($action === 'delete') {
    require_once 'delete.php';
} else {
    require_once 'viewer.php';
    echo getViewer($mysqli, 'id', 1);
}
?>
</main>

<footer></footer>

<?php mysqli_close($mysqli); ?>
</body>
</html>
