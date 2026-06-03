<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\View\View;

class ArticlesController
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
}
