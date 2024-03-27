<?php
class NodeInputLabel extends NodeInline
{
  public function __construct(?string $for = null, string $text = '')
  {
    parent::__construct('label');
    $for && $this->setAttribute('for', $for);
    $this->addChild($text);
  }

  public function setFor(string $id): self
  {
    $this->attributes['for'] = $id;
    return $this;
  }

  public function setClass(string $name, string ...$names): self
  {

    parent::setClass($name, ...$names);
    return $this;
  }
}
