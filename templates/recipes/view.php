<?php include __DIR__ . '/../header.php'; ?>
    <article class="recipe">
        <h1><?= htmlspecialchars($recipe->getName()) ?></h1>
        <p class="meta">
            Автор: <?= htmlspecialchars($author->getNickname()) ?> ·
            <?= $recipe->getCookTime() ?> мин ·
            <?= $recipe->getCaloriesPerServing() ?> ккал в одной порции
        </p>

        <h2>Ингредиенты</h2>
        <p class="pre"><?= nl2br(htmlspecialchars($recipe->getIngredients())) ?></p>

        <h2>Приготовление</h2>
        <p class="pre"><?= nl2br(htmlspecialchars($recipe->getText())) ?></p>

        <section class="calc">
            <h2>Калькулятор порций</h2>
            <p>Базовый рецепт рассчитан на <?= $recipe->getServings() ?> порц. Укажите нужное число порций — пересчитаем калорийность.</p>
            <form method="get" action="/recipes/<?= $recipe->getId() ?>">
                <label>Порций:
                    <input type="number" name="servings" id="servings" min="1" value="<?= $servings ?>"
                           data-per="<?= $recipe->getCaloriesPerServing() ?>">
                </label>
                <button type="submit">Пересчитать</button>
            </form>
            <p class="result">Итого: <span id="total"><?= $totalCalories ?></span> ккал</p>
        </section>

        <p><a class="btn" href="/admin/<?= $recipe->getId() ?>/edit">Редактировать</a></p>
    </article>

    <script>
        var input = document.getElementById('servings');
        var total = document.getElementById('total');
        var per = parseInt(input.dataset.per, 10);
        input.addEventListener('input', function () {
            var n = parseInt(input.value, 10);
            if (isNaN(n) || n < 1) { n = 1; }
            total.textContent = n * per;
        });
    </script>
<?php include __DIR__ . '/../footer.php'; ?>
