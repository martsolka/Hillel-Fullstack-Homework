<?php

namespace core;

class Viewer
{
  public function __construct(
    protected string $view,
    protected array $args = []
  ) {
  }

  public function render(): void
  {
    extract($this->args);

    include __DIR__ . '/../views/' . str_replace('.', '/', $this->view) . '.php';
  }
}
