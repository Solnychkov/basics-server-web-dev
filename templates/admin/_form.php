<?php
$r = $recipe ?? null;
$val = function (string $method, $default = '') use ($r) {
    return $r === null ? $default : htmlspecialchars((string)$r->$method());
};
?>
<form method="post" class="form">
    <p>
        <label>Название<br>
            <input type="text" name="name" value="<?= $val('getName') ?>" required>
        </label>
    </p>
    <p>
        <label>Ингредиенты (по одному в строке)<br>
            <textarea name="ingredients" rows="5" required><?= $val('getIngredients') ?></textarea>
        </label>
    </p>
    <p>
        <label>Приготовление<br>
            <textarea name="text" rows="8" required><?= $val('getText') ?></textarea>
        </label>
    </p>
    <p>
        <label>Порций
            <input type="number" name="servings" min="1" value="<?= $val('getServings', '1') ?>" required>
        </label>
    </p>
    <p>
        <label>Калорий в одной порции
            <input type="number" name="calories_per_serving" min="0" value="<?= $val('getCaloriesPerServing', '0') ?>" required>
        </label>
    </p>
    <p>
        <label>Время приготовления, мин
            <input type="number" name="cook_time" min="0" value="<?= $val('getCookTime', '0') ?>" required>
        </label>
    </p>
    <p><button type="submit">Сохранить</button></p>
</form>
