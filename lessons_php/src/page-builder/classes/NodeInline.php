<?php
class NodeInline extends NodeAbstract
{
  const INLINE_TAGS = ['span', 'strong', 'small', 'em', 'a', 'b', 'i', 'u', 'sup', 'sub', 'button', 'input', 'label', 'select', 'textarea', 'img',];

  public function __construct(string $tag = 'span', bool $hasClosedTag = true, bool $canHaveNodeChildren = true)
  {
    if (!in_array($tag, self::INLINE_TAGS)) {
      throw new Exception('Inline tag must be one of ' . implode(', ', self::INLINE_TAGS));
    }
    $this->tag = $tag;
    $this->hasClosedTag = $hasClosedTag;
    
  }

  public function addChild(Node|string $node): self
  {
    if ($node instanceof Node && !$node instanceof NodeInline) {
      throw new Exception('Only inline nodes can be added to inline nodes');
    }
    return parent::addChild($node);
  }
}
