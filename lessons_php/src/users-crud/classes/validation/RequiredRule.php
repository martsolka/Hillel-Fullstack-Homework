<?php
class RequiredRule extends AbstractRule
{
  public function check(string $fieldName, ?string $value): void
  {
    if (empty(trim($value))) {
      $this->errors[$fieldName] = "Field is required";
    }
  }
}
