<?php
$equation = "27 - X = 17";

$operator = "-";
$x_position = "справа от оператора";
$x = 27 - 17;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ДЗ. Решение уравнения</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <img src="logo.png" alt="МосПолитех">
    <h1>Домашнее задание. Решение уравнения</h1>
</header>

<main>
    <h2>Вариант 2</h2>

    <p><b>Уравнение:</b> <?= $equation ?></p>
    <p><b>Оператор:</b> <?= $operator ?> (вычитание)</p>
    <p><b>Расположение X:</b> <?= $x_position ?></p>
    <p><b>Формула:</b> X = 27 - 17</p>
    <p><b>Ответ: X = <?= $x ?></b></p>
    <p>Проверка: 27 - <?= $x ?> = <?= 27 - $x ?> ✓</p>
</main>

<footer>
    <p>Группа 251-321 — Солнышков И.Е.</p>
</footer>

</body>
</html>
