<?php

interface CalculateSquare
{
    public function getSquare(): float;
}

class Rectangle implements CalculateSquare
{
    private $width;
    private $height;

    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getSquare(): float
    {
        return $this->width * $this->height;
    }
}

class Circle implements CalculateSquare
{
    private $radius;

    public function __construct(float $radius)
    {
        $this->radius = $radius;
    }

    public function getSquare(): float
    {
        return M_PI * $this->radius ** 2;
    }
}

class Cat
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

function printSquare(object $object): void
{
    $className = get_class($object);

    if ($object instanceof CalculateSquare) {
        echo 'Объект класса ' . $className . ', площадь = ' . round($object->getSquare(), 2) . '.' . "\n";
    } else {
        echo 'Объект класса ' . $className . ' не реализует интерфейс CalculateSquare.' . "\n";
    }
}

$objects = [
    new Rectangle(4, 5),
    new Circle(3),
    new Cat('Мурка'),
];

foreach ($objects as $object) {
    printSquare($object);
}
