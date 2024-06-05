<?php

namespace routes;

class Router
{
  public function run(): void
  {
    $routes = $this->getRoutes();
    $path = $this->getPath();

    if (!array_key_exists($path, $routes)) {
      header("HTTP/1.0 404 Not Found");
      echo '404 Not Found';
      return;
    }

    [$controllerClass, $action] = $routes[$path];
    $controller = new $controllerClass;

    if (!method_exists($controller, $action)) {
      throw new \Exception("Action ({$action}) not fount in {$controllerClass} class");
    }

    $controller->$action();
  }

  protected function getPath(): string
  {
    return '/' . trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
  }

  protected function getRoutes(): array
  {
    return include 'web.php';
  }
}