<?php

namespace MyProject\Controllers;

use MyProject\View\View;

class MainController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function sayHello(string $name): void
    {
        $this->view->renderHtml('hello.php', ['name' => $name, 'title' => 'Страница приветствия']);
    }

    public function sayBye(string $name): void
    {
        $this->view->renderHtml('bye.php', ['name' => $name]);
    }
}
