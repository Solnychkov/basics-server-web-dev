251-321
Основы серверной веб разработки.
Солнышков Иван Евгеньевич

Лабораторная работа 10. Представление для редактирования статьи (Active Record save).

Задание 10: создать представление для редактирования статьи и обработать
редактирование по маршруту:
  '~^article/(\d)/edit$~' => [MyProject\Controllers\ArticleController::class, 'edit']

Что добавлено по сравнению с Лабой 9:
- templates/articles/edit.php                      — форма редактирования (поля name и text).
- ArticleController::edit()                         — GET показывает форму, POST сохраняет и редиректит на /articles/N.
- ActiveRecordEntity::save()                        — UPDATE через PHP Reflection API (camelCase -> snake_case).
- Article::setName(), Article::setText()            — сеттеры для изменения полей.
- www/index.php                                     — добавлен роут редактирования; URL берётся через ltrim(REQUEST_URI, '/'),
                                                      поэтому шаблон '~^article/(\d)/edit$~' (из задания) совпадает с /article/1/edit.
- templates/articles/view.php                       — добавлена ссылка "Редактировать".

Контроллер один — ArticleController (как указано в задании), содержит show() и edit().

Подготовка БД:
  mysql -u root < schema.sql

Настройки подключения — src/settings.php (127.0.0.1 / root / без пароля / my_blog).

Запуск:
  php -S localhost:8080 -t www www/index.php
Открыть в браузере:
  http://localhost:8080/articles/1        — статья + ссылка "Редактировать"
  http://localhost:8080/article/1/edit    — форма редактирования
После сохранения форма делает редирект обратно на /articles/1 с обновлёнными данными.
