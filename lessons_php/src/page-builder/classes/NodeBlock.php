<?php 
class NodeBlock extends NodeAbstract
{
  const BLOCK_TAGS = ['div', 'p', 'footer', 'header', 'nav', 'main', 'section', 'ul', 'ol', 'li', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'form',];

  public function __construct(string $tag = 'div')
  {
    if (!in_array($tag, self::BLOCK_TAGS)) {
      throw new Exception('Block tag must be one of ' . implode(', ', self::BLOCK_TAGS));
    }
    $this->tag = $tag;
  }
}
