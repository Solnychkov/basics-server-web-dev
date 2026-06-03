<?php include __DIR__ . '/../header.php'; ?>
    <h1>Редактирование статьи</h1>
    <form method="post">
        <p>
            <label>Название:<br>
                <input type="text" name="name" value="<?= htmlspecialchars($article->getName()) ?>">
            </label>
        </p>
        <p>
            <label>Текст:<br>
                <textarea name="text" rows="10" cols="60"><?= htmlspecialchars($article->getText()) ?></textarea>
            </label>
        </p>
        <p>
            <button type="submit">Сохранить</button>
        </p>
    </form>
<?php include __DIR__ . '/../footer.php'; ?>
