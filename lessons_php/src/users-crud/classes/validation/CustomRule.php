<?php
class CustomRule extends AbstractRule
{
  public function __construct(
    protected Closure $callback, 
    protected string $errorMessage)
  {
  }

  public function check(string $fieldName, ?string $value): void
  {
    if (!call_user_func($this->callback, $value)) {
      $this->errors[$fieldName] = $this->errorMessage;
    }
  }
}
