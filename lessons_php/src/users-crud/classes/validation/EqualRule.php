<?php
class EqualRule extends AbstractRule
{
  public function __construct(protected string $compareFieldName) {
  }
  public function check(string $fieldName, ?string $value): void
  {
    $compareFieldValue = $_SESSION[FormValidator::$dataKey][$this->compareFieldName] ?? $_POST[$this->compareFieldName];

    if ($compareFieldValue !== $value) {
      $this->errors[$fieldName] = "Field must be equal to {$this->compareFieldName}";
    }
  }
}
