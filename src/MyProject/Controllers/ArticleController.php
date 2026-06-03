<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\View\View;

class ArticleController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function show(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', ['title' => 'Статья не найдена']);
            return;
        }

        $author = User::getById($article->getAuthorId());

        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
            'author' => $author,
        ]);
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', ['title' => 'Статья не найдена']);
            return;
        }

        if (!empty($_POST)) {
            $article->setName($_POST['name']);
            $article->setText($_POST['text']);
            $article->save();

            header('Location: /articles/' . $article->getId());
            return;
        }

        $this->view->renderHtml('articles/edit.php', [
            'article' => $article,
            'title' => 'Редактирование статьи',
        ]);
    }
}
