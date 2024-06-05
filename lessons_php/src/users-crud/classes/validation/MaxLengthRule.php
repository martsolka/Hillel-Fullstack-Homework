<?php
class MaxLengthRule extends AbstractRule
{
  public function __construct(protected int $maxLength)
  {
  }

  public function check(string $fieldName, ?string $value): void
  {
    if (is_string($value) && mb_strlen($value) > $this->maxLength) {
      $this->errors[$fieldName] = "Field value cannot be longer than {$this->maxLength} characters";
    }
  }
}
