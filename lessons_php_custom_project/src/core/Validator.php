<?php

namespace core;

class Validator
{
  public function __construct(protected array $rules, protected array $data)
  {
  }

  public static function make(array $rules, array $data): self
  {
    return new static($rules, $data);
  }

  public function validate(): array
  {
    $errors = [];

    foreach ($this->rules as $fieldKey => $ruleGroup) {
      foreach ($ruleGroup as $rule) {
        [$ruleName, $ruleParams] = array_merge(explode(':', $rule), ['']);
        
        ['is_valid' => $isValid, 'error_msg' => $errorMsg] = $this->getRuleHandler($ruleName, $this->data[$fieldKey], $ruleParams, $fieldKey);

        if (!$isValid()) {
          $errors[$fieldKey] = $errorMsg;
          break;
        }
      }
    }

    return array_filter($errors);
  }

  protected function getRuleHandler(string $ruleName, mixed $fieldValue, string $ruleParams = '', ?string $fieldName = null): array
  {
    $handlers = match ($ruleName) {
      'required' => [
        'is_valid' => fn () => !empty($fieldValue),
        'error_msg' => ':field is required',
      ],
      'min' => [
        'is_valid' => fn () => is_string($fieldValue) && mb_strlen($fieldValue) >= (int)$ruleParams,
        'error_msg' => ':field must be at least :param characters long'
      ],
      'max' => [
        'is_valid' => fn () => is_string($fieldValue) && mb_strlen($fieldValue) <= (int)$ruleParams,
        'error_msg' => ':field must be no more than :param characters long'
      ],
      'enum' => [
        'is_valid' => fn () => in_array($fieldValue, explode(',', $ruleParams)),
        'error_msg' => ':field value must be one of the following: :param',
      ],
      'nullable' => [
        'is_valid' => fn () => is_null($fieldValue),
        'error_msg' => '',
      ],
      default => throw new \Exception('Unknown rule: ' . $ruleName),
    };

    $handlers['error_msg'] = str_replace(':field', ucfirst($fieldName) ?? 'This field', $handlers['error_msg']);
    $handlers['error_msg'] = str_replace(':param', $ruleParams, $handlers['error_msg']);

    return $handlers;
  }
}
