<?php
function resetFormFields(array $validationRules): array
{
  $fields = array_fill_keys(array_keys($validationRules), null);
  $errors = array_fill_keys(array_keys($validationRules), null);
  return [$fields, $errors];
}

function validateField(string $value, array $rules): ?string
{
  foreach ($rules as $rule) {
    if ($rule['check']($value)) {
      return $rule['error_msg'];
    }
  }
  return null;
}

function validateForm(array $validationRules, array &$fields, array &$errors): void
{
  foreach ($validationRules as $field => $rules) {
    $value = trim($_POST[$field] ?? '');
    $errors[$field] = validateField($value, $rules);
    $fields[$field] = $value;
  }
}

function displayError(string $field, array $errors): string
{
  return !empty($errors[$field]) ? '<div class="invalid-feedback">' . $errors[$field] . '</div>' : '';
}

function validationClass(string $field, array $errors): string
{
  return !empty($errors[$field]) ? 'is-invalid' : '';
}

function redirect(string $path = '/'): void
{
  header("Location: {$path}");
  exit();
}

function checkAuth()
{
  if (!isset($_SESSION['is_auth'])) {
    redirect('/signin.php');
  }
}

function handleSignout()
{
  if (isset($_GET['signout'])) {
    unset($_SESSION['is_auth']);
    redirect('/signin.php');
  }
}