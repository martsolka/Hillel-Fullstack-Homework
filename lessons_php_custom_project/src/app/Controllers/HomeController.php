<?php

namespace app\Controllers;

use core\Viewer;

class HomeController
{
  public function index(): void
  {
    (new Viewer('home.index', ['url' => $_SERVER['REQUEST_URI']]))->render();
  }
}
