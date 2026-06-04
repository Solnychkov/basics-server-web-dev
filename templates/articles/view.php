<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p>Автор: <?= $author->getNickname() ?></p>
    <p><a href="<?= BASE_PATH ?>/article/<?= $article->getId() ?>/edit">Редактировать</a></p>
<?php include __DIR__ . '/../footer.php'; ?>
