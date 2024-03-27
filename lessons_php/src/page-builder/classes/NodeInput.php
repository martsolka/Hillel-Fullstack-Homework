<?php
class NodeInput extends NodeInline
{
  protected ?NodeInputLabel $label = null;
  protected ?NodeBlock $errorMessage = null;

  public function __construct(
    ?string $type = 'text',
    ?string $name = null,
    string $id = null,
    ?string $placeholder = null,
    bool $required = false,
    ?string $value = null,
    ?NodeInputLabel $label = null,
    ?string $errorMessage = null
  ) {
    parent::__construct('input', false, false);

    $this->setAttribute('name', $name);
    $this->setAttribute('id', $id ?? $this->generateId());
    $type && $this->setAttribute('type', $type);
    $placeholder && $this->setAttribute('placeholder', $placeholder);
    $required && $this->setAttribute('required');
    $value && $this->setAttribute('value', $value);

    if ($label) {
      $this->label = $label->setFor($this->attributes['id'])
        ->addChild((new NodeInline('small'))
          ->addChild($required ? '*' : '(optional)')
          ->setClass($required ? 'text-danger' : 'text-secondary', 'ms-1'));
    }

    $errorMessage && $this->setError($errorMessage);
  }

  public function setError(string $message): self
  {
    $this->errorMessage = (new NodeBlock('div'))
      ->setClass('invalid-feedback')
      ->addChild($message);

    return $this;
  }

  protected function generateId(): string
  {
    return substr(md5($this->attributes['name'] ?? uniqid()), 0, 10);
  }

  public function getLabel(): ?NodeInputLabel
  {
    return $this->label;
  }

  public function getErrorMessage(): ?NodeBlock
  {
    return $this->errorMessage;
  }
}
