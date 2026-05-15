<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заголовки сервера</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <img src="logo.png" alt="Лого МосПолитех">
    <h1>Лабораторная работа №2. Feedback Form</h1>
</header>

<main>
    <h2>Заголовки ответа сервера (get_headers)</h2>
    <?php
        $url = 'http://www.example.com';
        $headers = get_headers($url);
        $output = implode("\n", $headers);
    ?>
    <textarea class="headers-out" readonly><?php echo htmlspecialchars($output); ?></textarea>
    <a class="page-link" href="index.php">← Назад к форме</a>
</main>

<footer>
    <p>Задание для самостоятельной работы «Feedback form»</p>
</footer>

</body>
</html>
