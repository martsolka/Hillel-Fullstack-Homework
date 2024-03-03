<?php
class SessionManager
{
  protected string $key;

  public function __construct(string $key)
  {
    $this->key = $key;
  }

  protected function save(mixed $value, bool $serialize = true): void
  {
    $_SESSION[$this->key] = $serialize ? serialize($value) : json_encode($value);
  }

  protected function load(bool $unserialize = true): mixed
  {
    if (isset($_SESSION[$this->key])) {
      return $unserialize ? unserialize($_SESSION[$this->key]) : json_decode($_SESSION[$this->key], true);
    }
    return null;
  }

  public function clear(): void
  {
    unset($_SESSION[$this->key]);
  }
}
