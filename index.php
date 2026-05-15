 <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello, World!</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>

<header>
    <img src="logo.png" alt="Лого МосПолитех">
    <h1>Лабораторная работа №1. Hello, World!</h1>
</header>

<main>
    <div class="card">
        <h2><?php echo 'Hello, World!'; ?></h2>
        <p>Сегодня: <?php echo date('d.m.Y H:i:s'); ?></p>
    </div>
</main>

<footer>
    <p>Задание для самостоятельной работы</p>
</footer>

</body>
</html>