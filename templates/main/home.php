<?php include __DIR__ . '/../header.php'; ?>
    <section class="hero">
        <h1>Кулинарная книга</h1>
        <p>Простые домашние рецепты с расчётом калорийности под нужное число порций.</p>
        <a class="btn" href="<?= BASE_PATH ?>/recipes">Смотреть все рецепты</a>
    </section>

    <h2>Последние рецепты</h2>
    <div class="cards">
        <?php foreach (array_slice($recipes, 0, 6) as $recipe): ?>
            <a class="card" href="<?= BASE_PATH ?>/recipes/<?= $recipe->getId() ?>">
                <h3><?= htmlspecialchars($recipe->getName()) ?></h3>
                <p class="meta"><?= $recipe->getCaloriesPerServing() ?> ккал/порция · <?= $recipe->getCookTime() ?> мин</p>
            </a>
        <?php endforeach; ?>
    </div>
<?php include __DIR__ . '/../footer.php'; ?>
