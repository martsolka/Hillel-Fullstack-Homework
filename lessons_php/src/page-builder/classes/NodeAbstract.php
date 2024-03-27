<?php require_once('Node.php');
abstract class NodeAbstract implements Node
{
  protected string $tag;
  protected array $attributes = [];
  protected array $children = [];
  protected bool $hasClosedTag = true;
  protected bool $canHaveNodeChildren = true;

  public function setId(string $id): self
  {
    $this->attributes['id'] = $id;

    return $this;
  }

  public function setClass(string $name, string ...$names): self
  {

    $this->attributes['class'] = array_merge($this->attributes['class'] ?? [], [$name, ...$names]);

    return $this;
  }

  public function setAttribute(string $name, ?string $value = null): self
  {
    if (!array_key_exists($name, $this->attributes)) {
      $this->attributes[$name] = $value;
    }

    return $this;
  }

  public function getAttributes(): string
  {
    $attrs = [];
    foreach ($this->attributes as $k => $v) {
      $attrs[] = $k . (!is_null($v) ? '="' . (is_array($v) ? implode(' ', $v) : $v) . '"' : '');
    }

    return implode(' ', $attrs);
  }

  public function addChild(Node|string $child): self
  {
    if (!$this->hasClosedTag || ($child instanceof Node && !$this->canHaveNodeChildren)) {
      throw new \Exception('This node cannot have children');
    }
    $this->children[] = $child;

    return $this;
  }

  protected function renderChildren(int $depth = 0): string
  {
    $indent = str_repeat('  ', $depth);
    $result = '';

    foreach ($this->children as $child) {
      if ($child instanceof Node) {
        $result .= PHP_EOL . $indent . $child->render($depth + 1);
      } else {
        $result .= PHP_EOL . $indent . $child;
      }
    }

    return $result;
  }

  public function render(int $depth = 0): string
  {
    $indent = str_repeat('  ', $depth > 0 ? $depth - 1 : 0);
    $openTag = "<{$this->tag} {$this->getAttributes()}>";
    $closeTag = $this->hasClosedTag ? ($this->canHaveNodeChildren ?  PHP_EOL . $indent : PHP_EOL) . "</{$this->tag}>" : '';
    $children = $this->renderChildren($depth + 1);

    return $openTag . $children . $closeTag;
  }
}
