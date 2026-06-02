<?php

class Cat
{
    private $name;
    private $color;

    public function __construct(string $name, string $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function sayHello(): void
    {
        echo 'Мяу! Меня зовут ' . $this->name . '. Я ' . $this->color . ' кошка.' . "\n";
    }
}

$cat1 = new Cat('Мурка', 'рыжая');
$cat2 = new Cat('Барсик', 'серая');

$cat1->sayHello();
$cat2->sayHello();

echo $cat1->getColor() . "\n";
