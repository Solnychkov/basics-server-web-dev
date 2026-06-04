<?php $title = $title ?? 'Страница не найдена'; ?>
<?php include __DIR__ . '/../header.php'; ?>
    <h1>404 — страница не найдена</h1>
    <p>Запрошенная страница или рецепт не существует.</p>
    <p><a href="<?= BASE_PATH ?>/recipes">Вернуться к списку рецептов</a></p>
<?php include __DIR__ . '/../footer.php'; ?>
