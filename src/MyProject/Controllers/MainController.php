<?php

namespace MyProject\Controllers;

use MyProject\Models\Recipes\Recipe;
use MyProject\View\View;

class MainController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function home(): void
    {
        $recipes = Recipe::findAll();

        $this->view->renderHtml('main/home.php', [
            'recipes' => $recipes,
            'title' => 'Кулинарная книга — главная',
        ]);
    }
}
