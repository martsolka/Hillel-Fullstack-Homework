<?php
class EmailRule extends AbstractRule
{
  public function check(string $fieldName, ?string $value): void
  {
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $this->errors[$fieldName] = "Email must have a valid format";
    }
  }
}
