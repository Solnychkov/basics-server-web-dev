<?php include __DIR__ . '/../header.php'; ?>
    <h1>Все рецепты</h1>
    <?php if (empty($recipes)): ?>
        <p>Пока нет ни одного рецепта.</p>
    <?php else: ?>
        <div class="cards">
            <?php foreach ($recipes as $recipe): ?>
                <a class="card" href="<?= BASE_PATH ?>/recipes/<?= $recipe->getId() ?>">
                    <h3><?= htmlspecialchars($recipe->getName()) ?></h3>
                    <p class="meta"><?= $recipe->getCaloriesPerServing() ?> ккал/порция · <?= $recipe->getCookTime() ?> мин · <?= $recipe->getServings() ?> порц.</p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php include __DIR__ . '/../footer.php'; ?>
