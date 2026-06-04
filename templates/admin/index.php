<?php include __DIR__ . '/../header.php'; ?>
    <h1>Администрирование рецептов</h1>
    <p><a class="btn" href="<?= BASE_PATH ?>/admin/add">+ Добавить рецепт</a></p>

    <table class="grid">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Ккал/порц.</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($recipes as $recipe): ?>
            <tr>
                <td><?= $recipe->getId() ?></td>
                <td><a href="<?= BASE_PATH ?>/recipes/<?= $recipe->getId() ?>"><?= htmlspecialchars($recipe->getName()) ?></a></td>
                <td><?= $recipe->getCaloriesPerServing() ?></td>
                <td>
                    <a href="<?= BASE_PATH ?>/admin/<?= $recipe->getId() ?>/edit">Изменить</a>
                    <a href="<?= BASE_PATH ?>/admin/<?= $recipe->getId() ?>/delete" onclick="return confirm('Удалить рецепт?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php include __DIR__ . '/../footer.php'; ?>
