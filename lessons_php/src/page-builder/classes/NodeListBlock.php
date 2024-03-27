<?php
class NodeListBlock extends NodeBlock
{
  public function __construct(string $rootClass = 'list-group')
  {
    parent::__construct();
    $this->setClass($rootClass);
  }

  public function addChild(Node|string $node): self
  {
    if ($node instanceof Node) {
      parent::addChild($node)->setClass('list-group-item');
    }
    return $this;
  }
}
