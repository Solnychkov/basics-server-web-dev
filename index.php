<?php
$a = isset($_POST['a']) ? (float)$_POST['a'] : 27;
$b = isset($_POST['b']) ? (float)$_POST['b'] : 17;
$x = $a - $b;
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

    <form method="POST">
        <div class="form-group">
            <label>Уравнение: A - X = B</label>
            <div style="display:flex; align-items:center; gap:10px; margin-top:8px;">
                <input type="number" name="a" value="<?= $a ?>" style="width:80px;">
                <span>- X =</span>
                <input type="number" name="b" value="<?= $b ?>" style="width:80px;">
            </div>
        </div>
        <button type="submit" class="btn">Решить</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <div class="result-box">
        <p><b>Уравнение:</b> <?= $a ?> - X = <?= $b ?></p>
        <p><b>Оператор:</b> - (вычитание)</p>
        <p><b>Расположение X:</b> справа от оператора</p>
        <p><b>Формула:</b> X = <?= $a ?> - <?= $b ?></p>
        <p class="answer">X = <?= $x ?></p>
        <p class="check">Проверка: <?= $a ?> - <?= $x ?> = <?= $a - $x ?> ✓</p>
    </div>
    <?php endif; ?>
</main>

<footer>
    <p>Группа 251-321 — Солнышков И.Е.</p>
</footer>

</body>
</html>