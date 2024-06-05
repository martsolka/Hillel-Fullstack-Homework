<?php
class RegexRule extends AbstractRule
{
  public function __construct(
    protected string $regex = '/^[A-Za-z0-9]+$/',
    protected ?string $errorMessage = null
  ) {
  }

  public function check(string $fieldName, ?string $value): void
  {
    if (!preg_match($this->regex, $value)) {
      $this->errors[$fieldName] = $this->errorMessage ?? "Field value is invalid";
    }
  }
}
