<?php
class NodeList extends NodeBlock
{
  public function __construct(string $tag = 'ul')
  {
    if (!in_array($tag, ['ul', 'ol'])) {
      throw new Exception('List type must be ul or ol');
    }
    parent::__construct($tag);
  }

  public function addChild(Node|string $node): self
  {
    if ($node instanceof NodeListItem) {
      parent::addChild($node);
      return $this;
    } else {
      throw new Exception('Only list items can be added to list nodes');
    }
  }
}
