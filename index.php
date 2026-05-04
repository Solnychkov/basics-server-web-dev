 <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello, World!</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; display: flex; flex-direction: column; min-height: 100vh; }

        header {
            display: flex;
            align-items: center;
            padding: 16px 32px;
            background: #1a3c6e;
            color: white;
        }
        header img { height: 50px; }
        header h1 { flex: 1; text-align: center; font-size: 1.2rem; }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            text-align: center;
            padding: 40px 60px;
            border: 2px solid #1a3c6e;
            border-radius: 12px;
        }
        .card p { font-size: 1rem; color: #555; margin-top: 8px; }

        footer {
            text-align: center;
            padding: 16px;
            background: #f0f0f0;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>

<header>
    <img src="https://mospolytech.ru/img/logo-new.svg" alt="Лого МосПолитех">
    <h1>Лабораторная работа №2. Hello, World!</h1>
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