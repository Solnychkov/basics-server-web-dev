<?php

namespace MyProject\Models\Recipes;

use MyProject\Models\ActiveRecordEntity;

class Recipe extends ActiveRecordEntity
{
    protected $name;
    protected $ingredients;
    protected $text;
    protected $servings;
    protected $caloriesPerServing;
    protected $cookTime;
    protected $authorId;
    protected $createdAt;

    public function getName(): string
    {
        return $this->name;
    }

    public function getIngredients(): string
    {
        return $this->ingredients;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getServings(): int
    {
        return (int)$this->servings;
    }

    public function getCaloriesPerServing(): int
    {
        return (int)$this->caloriesPerServing;
    }

    public function getCookTime(): int
    {
        return (int)$this->cookTime;
    }

    public function getAuthorId(): int
    {
        return (int)$this->authorId;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setIngredients(string $ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function setServings(int $servings): void
    {
        $this->servings = $servings;
    }

    public function setCaloriesPerServing(int $calories): void
    {
        $this->caloriesPerServing = $calories;
    }

    public function setCookTime(int $cookTime): void
    {
        $this->cookTime = $cookTime;
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    protected static function getTableName(): string
    {
        return 'recipes';
    }
}
