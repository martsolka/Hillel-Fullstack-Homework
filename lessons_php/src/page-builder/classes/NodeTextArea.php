<?php
class NodeTextArea extends NodeInput
{
  public function __construct(
    ?string $name = null,
    string $id = null,
    ?string $placeholder = null,
    bool $required = false,
    ?string $value = null,
    ?NodeInputLabel $label = null,
    ?string $errorMessage = null
  ) {
    parent::__construct(name: $name, id: $id, placeholder: $placeholder, required: $required, label: $label, errorMessage: $errorMessage, value: $value);
    $this->tag = 'textarea';
    $this->hasClosedTag = true;
    $this->canHaveNodeChildren = false;
    $value && $this->addChild($value);
  }
}
