<?php
class AuthManager
{
  protected static string $sessionKey = 'auth_user';

  public static function signIn(array $formData): bool
  {
    $userModel = new UserModel();

    if (!FormValidator::isValid($formData, ['email' => [new RequiredRule, new EmailRule], 'password' => [new RequiredRule]])) {
      return false;
    }

    $user = $userModel->read(where: ['email' => $formData['email'], 'password' => $userModel->hashPassword($formData['password'])], fields: ['id', 'role', 'name'], one: true);

    if (!$user) {
      FormValidator::setData($formData, ['email' => 'User not found or password is wrong.']);
      return false;
    }

    $_SESSION[self::$sessionKey] = $user;

    return true;
  }

  public static function isSignedIn(): bool
  {
    return isset($_SESSION[self::$sessionKey]);
  }

  public static function currentUser(): array
  {
    return self::isSignedIn() ? $_SESSION[self::$sessionKey] : [];
  }

  public static function reAuthUser(int $id): void
  {
    $user = (new UserModel())->read($id, ['id', 'role', 'name']);

    if ($user) {
      if($user['id'] === self::currentUser()['id']) {
        $_SESSION[self::$sessionKey] = $user;
      }
      self::goTo('/users-crud/');
    } else {
      self::goTo('/404.php');
    }
  }

  public static function hasRole(Role ...$roles): bool
  {
    return in_array(self::currentUser()['role'], array_column($roles, 'value'));
  }

  public static function goTo(string $url = '/', bool $condition = true): void
  {
    if ($condition) {
      header("Location: $url");
      exit;
    }
  }

  public static function signOut(): void
  {
    unset($_SESSION[self::$sessionKey]);
    session_destroy();
    self::goTo('/signin.php');
  }

  public static function handleSignOut(): void
  {
    isset($_GET['signout']) && self::signOut();
  }
}
