<?php
class MinLengthRule extends AbstractRule
{
  public function __construct(protected int $minLength)
  {
  }

  public function check(string $fieldName, ?string $value): void
  {
    if (is_string($value) && mb_strlen($value) < $this->minLength) {
      $this->errors[$fieldName] = "Field value must be at least {$this->minLength} characters long";
    }
  }
}
