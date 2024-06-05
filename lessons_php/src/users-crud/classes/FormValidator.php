<?php
class FormValidator
{
  public static string $dataKey = 'user_form_data';
  public static string $errorKey = 'user_form_errors';
  public static string $alertKey = 'alert';

  public static function isValid(array $data, array $rules): bool
  {
    $formData = $data;
    $errors = [];

    foreach ($rules as $fieldName => $fieldRules) {
      $hasRequiredRule = array_filter($fieldRules, fn ($rule) => $rule instanceof RequiredRule);
      $fieldValue = $data[$fieldName] ?? '';

      foreach ($fieldRules as $rule) {
        if (!$rule instanceof AbstractRule || (!$hasRequiredRule && $fieldValue === '')) {
          continue;
        }

        $rule->check($fieldName, $fieldValue);
        $formData[$fieldName] = htmlspecialchars($fieldValue);

        if ($fieldError = $rule->getError($fieldName)) {
          $errors[$fieldName] = $fieldError;
          break;
        }
      }
    }

    if (empty($errors)) {
      return true;
    }

    $_SESSION[static::$alertKey] = ['type' => 'danger', 'content' => '😕 Form submission failed. Please check the errors below.'];
    self::setData($formData, $errors);

    return false;
  }

  public static function setData(array $data, array $errors = [])
  {
    $_SESSION[static::$dataKey] = $data;
    $_SESSION[static::$errorKey] = $errors;
  }

  public static function hasError(?string $fieldName = null): bool
  {
    return $fieldName ? !empty($_SESSION[static::$errorKey][$fieldName]) : !empty($_SESSION[static::$errorKey]);
  }

  public static function error(string $fieldName): string
  {
    return $_SESSION[static::$errorKey][$fieldName] ?? '';
  }

  public static function value(string $fieldName): string
  {
    return $_SESSION[static::$dataKey][$fieldName] ?? '';
  }

  public static function clearErrors()
  {
    unset($_SESSION[static::$errorKey], $_SESSION[static::$dataKey], $_SESSION[static::$alertKey]);
  }
}
