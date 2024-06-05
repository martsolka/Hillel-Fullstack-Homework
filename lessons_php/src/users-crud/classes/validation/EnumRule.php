<?php
class EnumRule extends AbstractRule
{
  public function __construct(
    protected array $allowedValues, 
    protected ?string $errorMessage = null)
  {
  }
  
  public function check(string $fieldName, ?string $value): void
  {
    if (!in_array($value, $this->allowedValues)) {
      $this->errors[$fieldName] = $this->errorMessage ?? "Field value must be one of the following: " . implode(', ', $this->allowedValues);
    }
  }
}
