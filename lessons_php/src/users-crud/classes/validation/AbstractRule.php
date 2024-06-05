<?php
abstract class AbstractRule
{
  protected array $errors = [];

  public abstract function check(string $fieldName, ?string $value): void;

  public function getError(string $fieldName): ?string
  {
    return $this->errors[$fieldName] ?? null;
  }
}
