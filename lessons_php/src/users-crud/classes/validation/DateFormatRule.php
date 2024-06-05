<?php
class DateFormatRule extends AbstractRule
{
  public function __construct(protected string $format = 'Y-m-d')
  {
  }
  
  public function check(string $fieldName, ?string $value): void
  {
    if (!DateTime::createFromFormat($this->format, $value)) {
      $this->errors[$fieldName] = 'Invalid date format';
    }
  }
}
