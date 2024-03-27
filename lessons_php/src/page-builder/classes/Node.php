<?php 
interface Node
{
  public function render(int $depth = 0): string;
}
