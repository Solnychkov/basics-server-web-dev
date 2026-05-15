<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма обратной связи</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <img src="logo.png" alt="Лого МосПолитех">
    <h1>Лабораторная работа №2. Feedback Form</h1>
</header>

<main>
    <h2>Форма обратной связи</h2>
    <form action="https://httpbin.org/post" method="POST">
        <div class="form-group">
            <label for="username">Имя пользователя</label>
            <input type="text" id="username" name="username" placeholder="Введите ваше имя">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="example@mail.ru">
        </div>
        <div class="form-group">
            <label for="type">Тип обращения</label>
            <select id="type" name="type">
                <option value="complaint">Жалоба</option>
                <option value="suggestion">Предложение</option>
                <option value="gratitude">Благодарность</option>
            </select>
        </div>
        <div class="form-group">
            <label for="message">Текст обращения</label>
            <textarea id="message" name="message" placeholder="Введите текст обращения"></textarea>
        </div>
        <div class="form-group">
            <label>Вариант ответа</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="response_type[]" value="sms"> СМС</label>
                <label><input type="checkbox" name="response_type[]" value="email"> E-mail</label>
            </div>
        </div>
        <button type="submit" class="btn">Отправить</button>
    </form>
    <a class="page-link" href="page2.php">→ Перейти на страницу 2</a>
</main>

<footer>
    <p>Задание для самостоятельной работы «Feedback form»</p>
</footer>

</body>
</html>
