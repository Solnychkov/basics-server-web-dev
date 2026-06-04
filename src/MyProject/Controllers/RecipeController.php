<?php

namespace MyProject\Controllers;

use MyProject\Models\Recipes\Recipe;
use MyProject\Models\Users\User;
use MyProject\View\View;

class RecipeController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function index(): void
    {
        $recipes = Recipe::findAll();

        $this->view->renderHtml('recipes/list.php', [
            'recipes' => $recipes,
            'title' => 'Все рецепты',
        ]);
    }

    public function show(int $recipeId): void
    {
        $recipe = Recipe::getById($recipeId);

        if ($recipe === null) {
            $this->view->renderHtml('errors/404.php', ['title' => 'Рецепт не найден']);
            return;
        }

        $author = User::getById($recipe->getAuthorId());

        $servings = isset($_GET['servings']) ? max(1, (int)$_GET['servings']) : $recipe->getServings();
        $totalCalories = $servings * $recipe->getCaloriesPerServing();

        $this->view->renderHtml('recipes/view.php', [
            'recipe' => $recipe,
            'author' => $author,
            'servings' => $servings,
            'totalCalories' => $totalCalories,
            'title' => $recipe->getName(),
        ]);
    }

    public function admin(): void
    {
        $recipes = Recipe::findAll();

        $this->view->renderHtml('admin/index.php', [
            'recipes' => $recipes,
            'title' => 'Администрирование',
        ]);
    }

    public function add(): void
    {
        if (!empty($_POST)) {
            $recipe = new Recipe();
            $this->fillFromPost($recipe);
            $recipe->setAuthorId(1);
            $recipe->save();

            header('Location: ' . BASE_PATH . '/admin');
            return;
        }

        $this->view->renderHtml('admin/add.php', [
            'title' => 'Новый рецепт',
        ]);
    }

    public function edit(int $recipeId): void
    {
        $recipe = Recipe::getById($recipeId);

        if ($recipe === null) {
            $this->view->renderHtml('errors/404.php', ['title' => 'Рецепт не найден']);
            return;
        }

        if (!empty($_POST)) {
            $this->fillFromPost($recipe);
            $recipe->save();

            header('Location: ' . BASE_PATH . '/recipes/' . $recipe->getId());
            return;
        }

        $this->view->renderHtml('admin/edit.php', [
            'recipe' => $recipe,
            'title' => 'Редактирование рецепта',
        ]);
    }

    public function delete(int $recipeId): void
    {
        $recipe = Recipe::getById($recipeId);

        if ($recipe !== null) {
            $recipe->delete();
        }

        header('Location: ' . BASE_PATH . '/admin');
    }

    private function fillFromPost(Recipe $recipe): void
    {
        $recipe->setName($_POST['name']);
        $recipe->setIngredients($_POST['ingredients']);
        $recipe->setText($_POST['text']);
        $recipe->setServings((int)$_POST['servings']);
        $recipe->setCaloriesPerServing((int)$_POST['calories_per_serving']);
        $recipe->setCookTime((int)$_POST['cook_time']);
    }
}
