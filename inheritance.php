<?php

class Lesson
{
    private $title;
    private $text;
    private $homeWork;

    public function __construct(string $title, string $text, string $homeWork)
    {
        $this->title = $title;
        $this->text = $text;
        $this->homeWork = $homeWork;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getHomeWork(): string
    {
        return $this->homeWork;
    }

    public function setHomeWork(string $homeWork): void
    {
        $this->homeWork = $homeWork;
    }
}

class PaidLesson extends Lesson
{
    private $price;

    public function __construct(string $title, string $text, string $homeWork, float $price)
    {
        parent::__construct($title, $text, $homeWork);
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}

$lesson = new PaidLesson(
    'Урок о наследовании в PHP',
    'Лол, кек, чебурек',
    'Ложитесь спать, утро вечера мудренее',
    99.90
);

var_dump($lesson);
